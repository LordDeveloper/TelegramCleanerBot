<?php


namespace Jey;


class Client
{
    use Plugins\Methods;
    private static $api_url = 'https://api.telegram.org/bot%s/';

    /**
     * @var void|null
     */
    private static $token;
    /**
     * @var void|null
     */
    public static $botId;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var multiRequest
     */
    private $multiRequest;

    public function __construct(
        $token = null)
    {
        close_connection();
        self::$token = $token ?? env('bot.token');
        self::$api_url = sprintf(self::$api_url, self::$token);
        self::$botId = explode(':', self::$token)[0];
    }

    public function request(
        $action)
    {
        $url = self::$api_url. $action;

        $this-> request = new Request($url);
        return $this-> request;

    }
    public function multiRequest()
    {
        $url = self::$api_url;
        $this-> request = new multiRequest($url);
        return $this-> request;

    }

    /**
     * @param mixed ...$args
     * @return Request
     */
    public function addPost(
        ... $args)
    {
        return $this->request->addPost(... $args);
    }

    /**
     * @param mixed ...$args
     * @return Request
     */
    public function addHeader(
        ... $args)
    {
        return $this->request->addHeader(... $args);

    }

    /**
     * @param mixed ...$args
     * @return Request
     */
    public function addParam(
        ... $args)
    {
        return $this->request->addParam(... $args);
    }


}