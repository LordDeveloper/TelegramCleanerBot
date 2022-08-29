<?php


use Botify\Events\EventHandler;
use Botify\Events\Handler;
use Botify\TelegramAPI;
use Botify\Types\Map\Message;
use function Botify\gather;

require_once __DIR__ .'/bootstrap/app.php';

$bot = TelegramAPI::factory();

$bot->setEventHandler(new class extends EventHandler {
    public function onUpdateNewMessage(Message $message)
    {
        $chat = $message->chat;

        if (isset($chat['type']) && in_array($chat['type'], ['supergroup', 'group'])) {
            if ($message->regex('/^(?:clean|پاکسازی) (\d+)$/ui')) {
                [$me, $user] = yield gather([
                    $chat->getMember('me'),
                    $chat->getMember($message['from']),
                ]);

                if (in_array($user['status'], ['creator', 'administrator'])) {
                    if ($me['status'] === 'administrator') {
                        $replied = yield $message->reply('درحال پاکسازی پیام‌ها، لطفا کمی صبر کنید...');
                        $responses = yield $message->delete($message['matches'][1]);
                        return yield $replied->edit(sprintf(
                            '%d پیام با موفقیت پاکسازی شد.',
                            count(array_filter($responses, fn ($response) => $response === true))
                        ));
                    }

                    return yield $message->reply('برای انجام این دستور من باید در گروه ادمین باشم.');
                }

                return yield $message->reply('برای ارسال این دستور، باید در گروه ادمین باشید.');
            }
        }
    }
});


$bot->loopAndHear(Handler::UPDATE_TYPE_WEBHOOK);