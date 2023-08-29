<?php

namespace DiscordNotify\Event;

use BaserCore\Event\BcControllerEventListener;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use DiscordNotify\Utility\DiscordNotifyUtil;

/**
 * DiscordNotifyControllerEventListener
 */
class DiscordNotifyControllerEventListener extends BcControllerEventListener
{
    public $events = [
        'BcMail.Mail.afterSendEmail',
    ];

    public function bcMailMailAfterSendEmail(EventInterface $event)
    {
        $controller = $event->getSubject();

        $discordNotifiesTable = TableRegistry::getTableLocator()->get('DiscordNotify.DiscordNotifies');
        $discordNotifies = $discordNotifiesTable->find()->toArray();
        if (!$discordNotifies) {
            return true;
        }
        $discordNotifies = Hash::combine($discordNotifies, '{n}.mail_content_id', '{n}');

        $entityId = $controller->getRequest()->getParam('entityId');

        if (
            !empty($discordNotifies[$entityId]['status']) &&
            !empty($discordNotifies[$entityId]['webhook_url']) &&
            !empty($discordNotifies[$entityId]['user_name']) &&
            !empty($discordNotifies[$entityId]['message'])
        ) {
            $webhookUrl = $discordNotifies[$entityId]['webhook_url'];
            $userName = $discordNotifies[$entityId]['user_name'];
            $message = $this->replaceMessage($discordNotifies[$entityId]['message'], $controller->getRequest()->getData());
            DiscordNotifyUtil::sendDiscordMessage($webhookUrl, $userName, $message);
        }

        return true;
    }

    private function replaceMessage($message, $mailMessage)
    {
        foreach ($mailMessage as $filedName => $value) {
            $message = str_replace('{{' . $filedName . '}}', $value, $message);
        }
        $message = preg_replace('/\{\{.+\}\}/', '', $message);
        return $message;
    }
}
