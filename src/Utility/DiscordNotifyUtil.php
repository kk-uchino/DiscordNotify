<?php

namespace DiscordNotify\Utility;

class DiscordNotifyUtil
{
    // Discordにメッセージを送信
    public static function sendDiscordMessage($webhookUrl, $userName, $content)
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
