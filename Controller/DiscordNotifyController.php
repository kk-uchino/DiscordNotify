<?php
class DiscordNotifyController extends AppController
{
	public $components = ['BcAuth', 'BcAuthConfigure'];
	public $uses = [
		'Mail.MailContent',
		'DiscordNotify.DiscordNotify',
	];

	/**
	 * 設定
	 */
	public function admin_config()
	{
		$this->pageTitle = 'Discord通知プラグイン設定';

		$mailContents = $this->MailContent->find('all');
		$this->set('mailContents', $mailContents);

		if (!empty($this->request->data)) {
			if (!$this->DiscordNotify->saveAll($this->request->data['DiscordNotify'])) {
				$this->BcMessage->setError(__d('baser', '入力エラーです。内容を修正してください。'));
			} else {
				$this->BcMessage->setSuccess(__d('baser', '設定を保存しました。'));
			}
		} else {
			$discordNotifies = $this->DiscordNotify->find('all');
			if ($discordNotifies) {
				$this->request->data['DiscordNotify'] = Hash::combine($discordNotifies, '{n}.DiscordNotify.mail_content_id', '{n}.DiscordNotify');
			}
		}
	}
}
