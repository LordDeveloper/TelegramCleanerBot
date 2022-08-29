<<<<<<< HEAD
<i>1</i>. Put the token in the config.php file.</br>
<i>2</i>. Set the webhook to the index.php file.</br>
<i>3</i>. Add the bot to your group and submit the following command:</br>
</br>
<pre>clean 50</pre> 
</br>
By sending the above command, the robot deletes 50 recent messages

</br></br></br>
In the end, this source only has the testing aspect.
</br></br>

©️ <a href="https://t.me/jupiterapi">JupiterAPI</a>
=======
# Botify Framework

Create your own Telegram API bot asynchronously in PHP

## How to use

## Installation

- **Install with git**

``` 
git clone https://github.com/botify-framework/botify 
```
> Then
> ``` composer install ```

- **Install with composer**

``` 
composer create-project --prefer-dist botify-framework/botify 
```

> **Note**
> You must install the framework directly as a master project

### Webhook mode

```php
use Botify\Events\Handler;
use Botify\TelegramAPI;

require_once __DIR__ .'/bootstrap/app.php';

$bot = new TelegramAPI([
    'token' => '123456789:AAABBBCCCDDDEEE',
]);

$bot->loopAndHear(Handler::UPDATE_TYPE_WEBHOOK);
```

### Http server mode

```php
use Botify\Events\Handler;
use Botify\TelegramAPI;

require_once __DIR__ .'/bootstrap/app.php';

$bot = new TelegramAPI([
    'token' => '123456789:AAABBBCCCDDDEEE',
]);

$bot->loopAndHear(Handler::UPDATE_TYPE_SOCKET_SERVER);
```

### Long polling mode

```php
use Botify\Events\Handler;
use Botify\TelegramAPI;

require_once __DIR__ .'/bootstrap/app.php';

$bot = new TelegramAPI([
    'token' => '123456789:AAABBBCCCDDDEEE',
]);

$bot->loopAndHear(Handler::UPDATE_TYPE_POLLING);
```

[**Support group**](https://t.me/+MhwZYoLrHediNTgx)
>>>>>>> b0da91a (Initial commit)
