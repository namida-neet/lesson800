<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ReplyMessagesTable&\Cake\ORM\Association\BelongsTo $ReplyMessages
 * @property \App\Model\Table\RepostMessagesTable&\Cake\ORM\Association\BelongsTo $RepostMessages
 * @property \App\Model\Table\FavoritesTable&\Cake\ORM\Association\HasMany $Favorites
 * @property \App\Model\Table\StarsTable&\Cake\ORM\Association\HasMany $Stars
 *
 * @method \App\Model\Entity\Post get($primaryKey, $options = [])
 * @method \App\Model\Entity\Post newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Post[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Post|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Post[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Post findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PostsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('posts'); // 使用されるテーブル名
        $this->setDisplayField('id'); // list形式でデータ取得する際に使用されるカラム名
        $this->setPrimaryKey('id'); // プライマリーキーとなるカラム名

        $this->addBehavior('Timestamp'); // createdおよびmodifiedカラムを自動設定する

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('ReplyMessages', [
            'className' => 'Posts',
        ])
        ->setProperty('replyMessage')
        ->setJoinType('INNER');

        $this->hasOne('RepostMessages', [
            'className' => 'Posts',
        ])
        ->setProperty('repostMessage')
        ->setJoinType('INNER');

        $this->hasMany('Favorites', [
            'foreignKey' => 'post_id',
        ]);

        $this->hasMany('Stars', [
            'foreignKey' => 'post_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('messages')
            ->maxLength('messages', 255)
            ->requirePresence('messages', 'create')
            ->notEmptyString('messages');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    /**
     * 投稿の一覧を取得する（＋いいね）
     *
     * @param
     * @return 投稿一覧（＋いいね）クエリ
     */
    public function findMinibbsPosts()
    {
        $query = $this->find();
        $query
            ->contain(['Users', 'Favorites'])
            ->select(['favorites_count' => $query->func()->sum('Favorites.favorite_score')])
            ->leftJoinWith('Favorites')
            ->group(['Posts.id'])
            ->enableAutoFields(true);

        return $query;
    }

}
