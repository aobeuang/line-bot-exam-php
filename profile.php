<?php


$access_token = 'xBbo2kYd5sOVIQ1f082vd75ZKZtHdXcZ7OnRyb/Q1+HGhgZhKWiWFZwM8wSZwCQhNLwhfA1tq+65ifktQKg4D3W94GA1oKhS8vxAgKK3jROA7ec+iu4IV0xcJZTUiZh9l0ch6Zx4CTwKSzfKDTfOnwdB04t89/1O/w1cDnyilFU=';

$userId = 'Uffa138efe037e6e889d0b0f4a871c005';

$url = 'https://api.line.me/v2/bot/profile/'.$userId;

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

