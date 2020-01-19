<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

/**
 * Stars Controller
 *
 * @property \App\Model\Table\StarsTable $Stars
 *
 * @method \App\Model\Entity\Star[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StarsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->request->allowMethod(['post']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Posts'],
        ];
        $stars = $this->paginate($this->Stars);

        $this->set(compact('stars'));
    }

    /**
     * View method
     *
     * @param string|null $id Star id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $star = $this->Stars->get($id, [
            'contain' => ['Users', 'Posts'],
        ]);

        $this->set('star', $star);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $star = $this->Stars->newEntity();
        if ($this->request->is('post')) {
            $star = $this->Stars->patchEntity($star, $this->request->getData());
            if ($this->Stars->save($star)) {
                $this->Flash->success(__('The star has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The star could not be saved. Please, try again.'));
        }
        $users = $this->Stars->Users->find('list', ['limit' => 200]);
        $posts = $this->Stars->Posts->find('list', ['limit' => 200]);
        $this->set(compact('star', 'users', 'posts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Star id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $star = $this->Stars->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $star = $this->Stars->patchEntity($star, $this->request->getData());
            if ($this->Stars->save($star)) {
                $this->Flash->success(__('The star has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The star could not be saved. Please, try again.'));
        }
        $users = $this->Stars->Users->find('list', ['limit' => 200]);
        $posts = $this->Stars->Posts->find('list', ['limit' => 200]);
        $this->set(compact('star', 'users', 'posts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Star id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $star = $this->Stars->get($id);
        if ($this->Stars->delete($star)) {
            $this->Flash->success(__('The star has been deleted.'));
        } else {
            $this->Flash->error(__('The star could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
