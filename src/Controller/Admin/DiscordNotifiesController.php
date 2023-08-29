<?php

namespace DiscordNotify\Controller\Admin;

use BaserCore\Controller\Admin\BcAdminAppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

class DiscordNotifiesController extends BcAdminAppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->DiscordNotifies = TableRegistry::getTableLocator()->get('DiscordNotify.DiscordNotifies');
        $this->MailContents = TableRegistry::getTableLocator()->get('BcMail.MailContents');
    }

    public function config()
    {
        $mailContents = $this->MailContents->find()->contain(['Contents'])->all();
        $this->set('mailContents', $mailContents);

        $entities = $this->DiscordNotifies->find()->all();

        if ($this->request->is(['patch', 'post', 'put'])) {
            try {
                $requestData = $this->getRequest()->getData();
                $this->DiscordNotifies->patchEntities($entities, $requestData);
                $this->DiscordNotifies->saveManyOrFail($entities);
                $this->BcMessage->setSuccess(__d('baser_core', '設定を保存しました。'));
                return $this->redirect(['action' => 'config']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
            } catch (\Throwable $e) {
                $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。' . $e->getMessage()));
            }
        }

        $discordNotifies = $entities->toArray();
        $discordNotifies = Hash::combine($discordNotifies, '{n}.mail_content_id', '{n}');
        $this->set('discordNotifies', $discordNotifies);
    }
}
