<?php
class DiscordNotify extends AppModel
{
	public function __construct($id = false, $table = null, $ds = null)
	{
		parent::__construct($id, $table, $ds);

		$this->validate = [
			'webhook_url' => [
				['rule' => ['maxLength', 255], 'message' =>  __d('baser', 'Webhook URLは255文字以内で入力してください。')],
			],
			'user_name' => [
				['rule' => ['maxLength', 255], 'message' =>  __d('baser', 'ユーザー名は255文字以内で入力してください。')],
			],
		];
	}
}
