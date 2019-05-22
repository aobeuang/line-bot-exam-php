<?php



require "vendor/autoload.php";

$access_token = 'xBbo2kYd5sOVIQ1f082vd75ZKZtHdXcZ7OnRyb/Q1+HGhgZhKWiWFZwM8wSZwCQhNLwhfA1tq+65ifktQKg4D3W94GA1oKhS8vxAgKK3jROA7ec+iu4IV0xcJZTUiZh9l0ch6Zx4CTwKSzfKDTfOnwdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'd84fff03224711f0454750bf81bbfd91';

$pushID = 'U6e89ee65c131d0f0db2a0b1644a319c8';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world เสร็จ');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







