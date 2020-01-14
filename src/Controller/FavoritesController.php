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
    public function add()
    {
        $favorite = $this->Favorites->newEntity();
        if ($this->request->is('post')) {
            $favorite = $this->Favorites->patchEntity($favorite, $this->request->getData());
            $favorite->favorite_score = 1;
            if ($this->Favorites->save($favorite)) {
                $this->Flash->success(__('The favorite has been saved.'));

                return $this->redirect([
                    'controller' => 'Posts',
                    'action' => 'index',
                ]);
            }
            $this->Flash->error(__('The favorite could not be saved. Please, try again.'));
        }
        $this->set(compact('favorite'));
    }

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
