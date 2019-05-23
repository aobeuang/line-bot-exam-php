<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

include_once 'fc/bot.php';
include_once 'profile.php';



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
	    else if(strpos($message, 'ฝันดี') !== false){
	    // else if($message == "ฝันดี"){
	        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
	        $arrayPostData['messages'][0]['type'] = "text";
	        $arrayPostData['messages'][0]['text'] = 'ฝันดี';
	        $arrayPostData['messages'][1]['type'] = "sticker";
	        $arrayPostData['messages'][1]['packageId'] = "2";
	        $arrayPostData['messages'][1]['stickerId'] = "46";	        
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
										  'type' => 'template',
										  'altText' => 'this is a buttons template',
										  'template' => 
										  array (
										    'type' => 'buttons',
										    'actions' => 
										    array (
										      0 => 
										      array (
										        'type' => 'postback',
										        'label' => 'sss',
										        'text' => 'นุ้งบอทฝันดี',
										        'data' => 'test=นุ้งบอทฝันดี',
										      ),
										    ),
										    'title' => 'Title',
										    'text' => 'Text',
										  ),
										);
			replyMsg($arrayHeader,$arrayPostData);
	    }

	    else{
	        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
	        $arrayPostData['messages'][0]['type'] = "text";
	        $arrayPostData['messages'][0]['text'] = "555";
	        replyMsg($arrayHeader,$arrayPostData);
	    }

	}
	#ตัวอย่าง Message Type "Location"
    if(strpos($message, 'เทส') !== false){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0] = gProfile($arrayJson['events'][0]['source']['userId']);
        replyMsg($arrayHeader,$arrayPostData);
    }



	$arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
	        $arrayPostData['messages'][0]['type'] = "text";
	        $arrayPostData['messages'][0]['text'] = $arrayJson['events'][0]['postback']['data'];
	        replyMsg($arrayHeader,$arrayPostData);

function gProfile($userid)
{
	$userss = json_decode(gUserdetail($userid));
		$userdetail = array (
						  'type' => 'flex',
						  'altText' => 'Flex Message',
						  'contents' => 
						  array (
						    'type' => 'bubble',
						    'hero' => 
						    array (
						      'type' => 'image',
						      'url' => $userss->pictureUrl,
						      'size' => 'full',
						      'aspectRatio' => '20:13',
						      'aspectMode' => 'cover',
						      'action' => 
						      array (
						        'type' => 'uri',
						        'label' => 'Line',
						        'uri' => $userss->pictureUrl,
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
						          'type' => 'spacer',
						          'size' => 'sm',
						        ),
						        1 => 
						        array (
						          'type' => 'text',
						          'text' => $userss->displayName,
						          'size' => 'xl',
						          'align' => 'center',
						          'gravity' => 'center',
						          'color' => '#050505',
						        ),
						        2 => 
						        array (
						          'type' => 'text',
						          'text' => (!empty($userss->statusMessage)) ? $userss->statusMessage : "" ;,
						          'align' => 'center',
						          'gravity' => 'center',
						          'weight' => 'regular',
						        ),
						        3 => 
						        array (
						          'type' => 'text',
						          'text' => '!! Welcome !!',
						          'size' => 'xl',
						          'align' => 'center',
						          'gravity' => 'center',
						          'weight' => 'bold',
						          'color' => '#1200FF',
						        ),
						      ),
						    ),
						  ),
						);

		return $userdetail;
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