<?php


namespace Jey;


class Request
{
    private static $handle = null;

    private static $_post = [];

    private static $_param = [];

    private static $_header = [];

    /**
     * @var bool|string
     */
    private static $response;
    private static $url;


    /**
     * Request constructor.
     * @param $url
     */
    public function __construct(
        $url = null)
    {
        self::$url = $url;
    }

    /**
     * @return bool|string
     */
    public static function getResponse(
        $assoc = true)
    {
        return is_json(self::$response) ? json_decode(self::$response, $assoc):self::$response;
    }

    /**
     * @param $key
     * @param $value
     * @return Request
     */
    public function addPost(
        $key,
        $value)
    {
        self::$_post[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return Request
     */
    public function addHeader(
        $key,
        $value)
    {
        self::$_header[$key] = $value;
        return $this;

    }

    /**
     * @param $key
     * @param $value
     * @return Request
     */
    public function addParam(
        $key,
        $value)
    {
        self::$_param[$key] = $value;
        return $this;
    }

    /**
     * @return $this
     */
    public function execute()
    {
        $url = !empty(self::$_param)? self::$url.'?'.http_build_query(self::$_param):self::$url;
        self::$handle = curl_init($url);
        curl_setopt_array(
            self::$handle,
            [
                CURLOPT_POST            => true,
                CURLOPT_POSTFIELDS      => self::$_post,
                CURLOPT_HTTPHEADER      => self::$_header,
                CURLOPT_RETURNTRANSFER  => true
            ]
        );
        self::$response = curl_exec(self::$handle);

        return $this;
    }

    /**
     * @return $this
     */
    public function close()
    {
        curl_close(self::$handle);
        return $this;
    }
}