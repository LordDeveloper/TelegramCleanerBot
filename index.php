<?php



require_once __DIR__.'/vendor/autoload.php';

error_reporting(env('errors.level'));
ini_set( 'display_errors',env('errors.display') );

use Jey\Client;

$client = new Client();





// دریافت ورودی‌های وب‌هوک
$input = file_get_contents( 'php://input' );
$update = json_decode($input, true);


$message    = $update['message'] ?? null;
$chat       = $message['chat'] ?? null;
$from       = $message['from'] ?? null;
$chatId     = $chat['id'] ?? null;
$fromId     = $from['id'] ?? null;
$text       = $message['text'] ?? null;
$messageId  = $message['message_id'] ?? null;


if(preg_match('/^(clean|پاکسازی) (\d+)$/ui', $text, $matches)) {
    $status = $client-> getChatMember(['chat_id'=> $chatId, 'user_id'=> $fromId])['result']['status'];
    $msg = 'برای ارسال این دستور، باید در گروه ادمین باشید.';
    if(in_array($status, ['creator', 'administrator'])) {
        $status = $client-> getChatMember(['chat_id'=> $chatId, 'user_id'=> $client::$botId])['result']['status'];
        $msg = 'برای انجام این دستور من باید در گروه ادمین باشم.';
        if($status == 'administrator') {
            $response = $client-> sendMessage(['chat_id'=> $chatId, 'text'=> 'درحال پاکسازی پیام‌ها، لطفا کمی صبر کنید...']);
            $client-> deleteMessage(['chat_id'=> $chatId, 'id'=> range(($messageId-$matches[2]), $messageId)]);
            return $client-> editMessageText(['chat_id'=> $chatId, 'message_id'=> $response['result']['message_id'], 'text'=> sprintf('%d پیام با موفقیت پاکسازی شد.', $matches[2])]);
        }
    }
    
    
    $client-> sendMessage(['chat_id'=> $chatId, 'text'=> $msg]);
    
    
    
}