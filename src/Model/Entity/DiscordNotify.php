<?php
declare(strict_types=1);

namespace DiscordNotify\Model\Entity;

use Cake\ORM\Entity;

/**
 * DiscordNotify Entity
 *
 * @property int $id
 * @property int $mail_content_id
 * @property int $status
 * @property string|null $webhook_url
 * @property string|null $user_name
 * @property string|null $message
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \DiscordNotify\Model\Entity\MailContent $mail_content
 */
class DiscordNotify extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'mail_content_id' => true,
        'status' => true,
        'webhook_url' => true,
        'user_name' => true,
        'message' => true,
        'created' => true,
        'modified' => true,
        'mail_content' => true,
    ];
}
