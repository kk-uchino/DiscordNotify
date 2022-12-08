<?php
class DiscordNotifyControllerEventListener extends BcControllerEventListener
{

	public $events = [
		'Mail.Mail.afterSendEmail',
	];

	public function __construct()
	{
	}

	/**
	 * mailMailAfterSendEmail
	 *
	 * @param CakeEvent $event
	 * @return boolean
	 */
	public function mailMailAfterSendEmail(CakeEvent $event)
	{
		$Controller = $event->subject();

		$DiscordNotify = ClassRegistry::init('DiscordNotify.DiscordNotify');
		$discordNotifies = $DiscordNotify->find('all');
		if (empty($discordNotifies)) {
			return true;
		}
		$discordNotifies = Hash::combine($discordNotifies, '{n}.DiscordNotify.mail_content_id', '{n}.DiscordNotify');

		$entityId = $Controller->request->params['Content']['entity_id'];

		if (
			!empty($discordNotifies[$entityId]['status']) &&
			!empty($discordNotifies[$entityId]['webhook_url']) &&
			!empty($discordNotifies[$entityId]['user_name']) &&
			!empty($discordNotifies[$entityId]['message'])
		) {
			$webhookUrl = $discordNotifies[$entityId]['webhook_url'];
			$userName = $discordNotifies[$entityId]['user_name'];
			$message = $this->replaceMessage($discordNotifies[$entityId]['message'], $Controller->request->data['MailMessage']);
			DiscordNotifyUtil::sendDiscordMessage($webhookUrl, $userName, $message);
		}

		return true;
	}

	private function replaceMessage($message, $mailMessage) {
		foreach ($mailMessage as $filedName => $value) {
			$message = str_replace('{{' . $filedName . '}}', $value, $message);
		}
		$message = preg_replace('/\{\{.+\}\}/', '', $message);
		return $message;
	}
}
