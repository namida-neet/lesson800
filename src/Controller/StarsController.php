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
    // public function beforeFilter(Event $event)
    // {
    //     parent::beforeFilter($event);
    //     $this->request->allowMethod(['post']);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->autoRender = false;

        $star = $this->Stars->newEntity();

        if ($this->request->is('post')) {
            $star->user_id = $this->request->getData('user_id');
            $star->post_id = $this->request->getData('post_id');

            if (isset($this->request->data['one'])) {
                $star->star_score = 1;
            } elseif (isset($this->request->data['two'])) {
                $star->star_score = 2;
            } elseif (isset($this->request->data['three'])) {
                $star->star_score = 3;
            }

            if ($this->Stars->save($star)) {
                $this->Flash->success(__('The star has been saved.'));

                return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
            }
            $this->Flash->error(__('The star could not be saved. Please, try again.'));
        }
    }

    /**
     * Edit method
     *
     * @param
     * @return \Cake\Http\Response|null
     */
    public function edit()
    {
        $this->autoRednder = false;

        $authuserId = $this->request->getData('user_id');
        $postId = $this->request->getData('post_id');

        $star = $this->Stars->findStar($authuserId, $postId)
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (isset($this->request->data['one'])) {
                $this->Stars->updateAll([
                    'star_score' => 1,
                ], [
                    'user_id' => $authuserId,
                    'post_id' => $postId,
                ]);
            } elseif (isset($this->request->data['two'])) {
                $this->Stars->updateAll([
                    'star_score' => 2,
                ], [
                    'user_id' => $authuserId,
                    'post_id' => $postId,
                ]);
            } elseif (isset($this->request->data['three'])) {
                $this->Stars->updateAll([
                    'star_score' => 3,
                ], [
                    'user_id' => $authuserId,
                    'post_id' => $postId,
                ]);
            } elseif (isset($this->request->data['zero'])) {
                $this->Stars->updateAll([
                    'star_score' => 0,
                ], [
                    'user_id' => $authuserId,
                    'post_id' => $postId,
                ]);
            }
            return $this->redirect([
                'controller' => 'Posts',
                'action' => 'index',
            ]);
        }
    }

}
