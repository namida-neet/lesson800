<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property string $messages
 * @property int $user_id
 * @property int $reply_message_id
 * @property int $repost_message_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ReplyMessage $reply_message
 * @property \App\Model\Entity\RepostMessage $repost_message
 * @property \App\Model\Entity\Favorite[] $favorites
 * @property \App\Model\Entity\Star[] $stars
 */
class Post extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array // 各プロパティが一括代入できるかどうかの情報
     */
    protected $_accessible = [
        'messages' => true,
        'user_id' => true,
        'reply_message_id' => true,
        'repost_message_id' => true,
        'created' => true,
        'modified' => true,
        'users' => true,
        'favorites' => true,
        'stars' => true,
    ];
}
