<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

include_once 'fc/bot.php';



$baseurl = "https://" . $_SERVER['SERVER_NAME'];

    $accessToken = "xBbo2kYd5sOVIQ1f082vd75ZKZtHdXcZ7OnRyb/Q1+HGhgZhKWiWFZwM8wSZwCQhNLwhfA1tq+65ifktQKg4D3W94GA1oKhS8vxAgKK3jROA7ec+iu4IV0xcJZTUiZh9l0ch6Zx4CTwKSzfKDTfOnwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
#ตัวอย่าง Message Type "Text"
    // if(strpos($message, 'ไอ้บอท') !== false){
    //config bot
    $botname = "นุ้งบอท";
    if(strpos($message, $botname) !== false){
	    if(strpos($message, 'สวัสดี') || strpos($message, 'ดีจ้า') || strpos($message, 'หวัดดี') !== false){
	        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
	        $arrayPostData['messages'][0]['type'] = "text";
	        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
	        replyMsg($arrayHeader,$arrayPostData);
	    }
	    #ตัวอย่าง Message Type "Sticker"
	    else if(strpos($message, 'ฝันดี')){
	    // else if($message == "ฝันดี"){
	        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
	        $arrayPostData['messages'][0]['type'] = "sticker";
	        $arrayPostData['messages'][0]['packageId'] = "2";
	        $arrayPostData['messages'][0]['stickerId'] = "46";
	        replyMsg($arrayHeader,$arrayPostData);
	    }
	    #ตัวอย่าง Message Type "Image"
	    else if(strpos($message, 'รูปน้องแมว') !== false){
	        $image_url = $baseurl.'/img/cats/'.rand(1,11).'.jpg';
	        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
	        $arrayPostData['messages'][0]['type'] = "image";
	        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
	        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
	        replyMsg($arrayHeader,$arrayPostData);
	    }
	    #ตัวอย่าง Message Type "Location"
	    else if($message == "พิกัดสยามพารากอน"){
	        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
	        $arrayPostData['messages'][0]['type'] = "location";
	        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
	        $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
	        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
	        $arrayPostData['messages'][0]['longitude'] = "100.532752";
	        replyMsg($arrayHeader,$arrayPostData);
	    }
	    #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
	    else if(strpos($message, 'ลาก่อน') !== false){
	        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
	        $arrayPostData['messages'][0] = array (
								  'type' => 'flex',
								  'altText' => 'Flex Message',
								  'contents' => 
								  array (
								    'type' => 'bubble',
								    'hero' => 
								    array (
								      'type' => 'image',
								      'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_1_cafe.png',
								      'size' => 'full',
								      'aspectRatio' => '20:13',
								      'aspectMode' => 'cover',
								      'action' => 
								      array (
								        'type' => 'uri',
								        'label' => 'Line',
								        'uri' => 'https://linecorp.com/',
								      ),
								    ),
								    'body' => 
								    array (
								      'type' => 'box',
								      'layout' => 'vertical',
								      'contents' => 
								      array (
								        0 => 
								        array (
								          'type' => 'text',
								          'text' => 'Brown Cafe',
								          'size' => 'xl',
								          'weight' => 'bold',
								        ),
								        1 => 
								        array (
								          'type' => 'box',
								          'layout' => 'baseline',
								          'margin' => 'md',
								          'contents' => 
								          array (
								            0 => 
								            array (
								              'type' => 'icon',
								              'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png',
								              'size' => 'sm',
								            ),
								            1 => 
								            array (
								              'type' => 'icon',
								              'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png',
								              'size' => 'sm',
								            ),
								            2 => 
								            array (
								              'type' => 'icon',
								              'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png',
								              'size' => 'sm',
								            ),
								            3 => 
								            array (
								              'type' => 'icon',
								              'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png',
								              'size' => 'sm',
								            ),
								            4 => 
								            array (
								              'type' => 'icon',
								              'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gray_star_28.png',
								              'size' => 'sm',
								            ),
								            5 => 
								            array (
								              'type' => 'text',
								              'text' => '4.0',
								              'flex' => 0,
								              'margin' => 'md',
								              'size' => 'sm',
								              'color' => '#999999',
								            ),
								          ),
								        ),
								        2 => 
								        array (
								          'type' => 'box',
								          'layout' => 'vertical',
								          'spacing' => 'sm',
								          'margin' => 'lg',
								          'contents' => 
								          array (
								            0 => 
								            array (
								              'type' => 'box',
								              'layout' => 'baseline',
								              'spacing' => 'sm',
								              'contents' => 
								              array (
								                0 => 
								                array (
								                  'type' => 'text',
								                  'text' => 'Place',
								                  'flex' => 1,
								                  'size' => 'sm',
								                  'color' => '#AAAAAA',
								                ),
								                1 => 
								                array (
								                  'type' => 'text',
								                  'text' => 'Miraina Tower, 4-1-6 Shinjuku, Tokyo',
								                  'flex' => 5,
								                  'size' => 'sm',
								                  'color' => '#666666',
								                  'wrap' => true,
								                ),
								              ),
								            ),
								            1 => 
								            array (
								              'type' => 'box',
								              'layout' => 'baseline',
								              'spacing' => 'sm',
								              'contents' => 
								              array (
								                0 => 
								                array (
								                  'type' => 'text',
								                  'text' => 'Time',
								                  'flex' => 1,
								                  'size' => 'sm',
								                  'color' => '#AAAAAA',
								                ),
								                1 => 
								                array (
								                  'type' => 'text',
								                  'text' => '10:00 - 23:00',
								                  'flex' => 5,
								                  'size' => 'sm',
								                  'color' => '#666666',
								                  'wrap' => true,
								                ),
								              ),
								            ),
								          ),
								        ),
								      ),
								    ),
								    'footer' => 
								    array (
								      'type' => 'box',
								      'layout' => 'vertical',
								      'flex' => 0,
								      'spacing' => 'sm',
								      'contents' => 
								      array (
								        0 => 
								        array (
								          'type' => 'button',
								          'action' => 
								          array (
								            'type' => 'postback',
								            'label' => 'CALL',
								            'text' => 'Caaa',
								            'data' => '่่่fdfg',
								          ),
								          'flex' => 1,
								          'height' => 'sm',
								          'style' => 'link',
								        ),
								        1 => 
								        array (
								          'type' => 'button',
								          'action' => 
								          array (
								            'type' => 'uri',
								            'label' => 'WEBSITE',
								            'uri' => 'https://linecorp.com',
								          ),
								          'height' => 'sm',
								          'style' => 'link',
								        ),
								        2 => 
								        array (
								          'type' => 'spacer',
								          'size' => 'sm',
								        ),
								      ),
								    ),
								  ),
								);
			replyMsg($arrayHeader,$arrayPostData);
	    }

	    else{
	        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
	        $arrayPostData['messages'][0]['type'] = "text";
	        $arrayPostData['messages'][0]['text'] = "เรียกชื่อมีไร กูเพื่อนโชคนะสัส";
	        replyMsg($arrayHeader,$arrayPostData);
	    }

	}
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
    func1('Hello', 'world');
    //echo "https://" . $_SERVER['SERVER_NAME'] ;
   exit;
?>