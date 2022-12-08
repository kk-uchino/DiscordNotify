<?php
class DiscordNotifiesSchema extends CakeSchema
{

	public $name = 'DiscordNotifies';
	public $file = 'discord_notifies.php';

	public function before($event = [])
	{
		return true;
	}

	public function after($event = [])
	{
	}

	public $discord_notifies = [
		'id' => ['type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'],
		'mail_content_id' => ['type' => 'integer', 'null' => false, 'length' => 11],
		'status' => ['type' => 'tinyinteger', 'null' => true, 'default' => 0, 'length' => 1],
		'webhook_url' => ['type' => 'string', 'null' => true, 'default' => NULL, 'length' => 255],
		'user_name' => ['type' => 'string', 'null' => true, 'default' => NULL, 'length' => 255],
		'message' => ['type' => 'text', 'null' => true, 'default' => NULL],
		'created' => ['type' => 'datetime', 'null' => true, 'default' => NULL],
		'modified' => ['type' => 'datetime', 'null' => true, 'default' => NULL],
		'indexes' => ['PRIMARY' => ['column' => 'id', 'unique' => 1]],
	];
}
