<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Favorites Controller
 *
 * @property \App\Model\Table\FavoritesTable $Favorites
 *
 * @method \App\Model\Entity\Favorite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FavoritesController extends AppController
{
    /**
     * いいねを追加
     *
     * @param 
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $this->autoRender = false;

        $favorite = $this->Favorites->newEntity();

        if ($this->request->is('ajax')) {
            $received_data = $this->request->getData();

            $favorite->user_id = $this->request->getData('user_id');
            $favorite->post_id = $this->request->getData('post_id');
            $favorite->favorite_score = 1;

            if ($this->Favorites->save($favorite)) {
                $count = $this->Favorites->countFavorite($favorite->post_id)->count();
                $this->response->body(json_encode(['received_data' => $received_data, 'count' => $count]));
                return;
            }
            $this->Flash->error(__('The favorite could not be saved. Please, try again.'));
        }
    }

    /**
     * いいねを取り消し
     *
     * @param 
     * @return \Cake\Http\Response
     */
    public function delete()
    {
        $this->autoRender = false;

        if ($this->request->is('ajax')) {
            $received_data = $this->request->getData();

            $param = [
                'user_id' => $this->request->getData('user_id'),
                'post_id' => $this->request->getData('post_id'),
            ];

            if ($this->Favorites->deleteAll($param)) {
                $count = $this->Favorites->countFavorite($this->request->getData('post_id'))->count();
                $this->response->body(json_encode(['received_data' => $received_data, 'count' => $count]));
                return;
            } else {
                $this->Flash->error(__('The favorite could not be deleted. Please, try again.'));
            }
        }
    }

    // 使わないことにした
    public function edit()
    {
        $authuserId = $this->request->getData('user_id');
        $postId = $this->request->getData('post_id');

        $findFavorite = $this->Favorites->find()
            ->where(['user_id' => $authuserId])
            ->andWhere(['post_id' => $postId])
            ->first();
        if ($findFavorite->favorite_score === 1) {
            if ($this->Favorites->updateAll([
                'favorite_score' => 0,
            ], [
                'user_id' => $authuserId,
                'post_id' => $postId
            ])) {
                $this->Flash->success(__('The favorite has been saved.'));

                return $this->redirect([
                    'controller' => 'Posts',
                    'action' => 'index',
                ]);
            }
            $this->Flash->error(__('The favorite could not be saved. Please, try again.'));

        } elseif ($findFavorite->favorite_score === 0) {
            if ($this->Favorites->updateAll([
                'favorite_score' => 1,
            ], [
                'user_id' => $authuserId,
                'post_id' => $postId
            ])) {
                $this->Flash->success(__('The favorite has been saved.'));

                return $this->redirect([
                    'controller' => 'Posts',
                    'action' => 'index',
                ]);
            }
            $this->Flash->error(__('The favorite could not be saved. Please, try again.'));
        }
    }
}
