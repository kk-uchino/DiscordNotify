<?php
class DiscordNotifyUtil extends CakeObject
{
	// Discordにメッセージを送信
	static public function sendDiscordMessage($webhookUrl, $userName, $content)
	{
		$data = [
			'username' => $userName,
			'content' => $content,
		];

		$context = [
			'http' => [
				'method'  => 'POST',
				'header'  => 'Content-Type: application/json',
				'content' => json_encode($data),
			]
		];

		return json_decode(file_get_contents($webhookUrl, false, stream_context_create($context)), true);
	}
}
