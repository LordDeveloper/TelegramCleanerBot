<?php


namespace Jey;


class multiRequest
{
    private static $_handles = [];

    private static $_handle =  null;
    private static $_post = [];

    private static $_param = [];

    private static $_header = [];

    /**
     * @var bool|string
     */
    private static $response = [];
    private static $url;


    /**
     * Request constructor.
     * @param $url
     */
    public function __construct(
        $url = null)
    {
        self::$url = $url;
        self::$_handle = curl_multi_init();
    }

    /**
     * @return bool|string
     */
    public static function getResponse(
        $assoc = true)
    {
        return self::$response;
    }

    /**
     * @param $key
     * @param $value
     * @return multiRequest
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
     * @return multiRequest
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
     * @return multiRequest
     */
    public function addParam(
        $key,
        $value)
    {
        self::$_param[$key] = $value;
        return $this;
    }

    /**
     * @param $action
     * @return $this
     */
    public function addHandle(
        $action)
    {
        $url = !empty(self::$_param)? (self::$url. $action.'?'.http_build_query(self::$_param)):(self::$url. $action);
        $handle = curl_init($url);
        curl_setopt_array(
            $handle,
            [
                CURLOPT_POST            => true,
                CURLOPT_POSTFIELDS      => self::$_post,
                CURLOPT_HTTPHEADER      => self::$_header,
                CURLOPT_RETURNTRANSFER  => true
            ]
        );
        self::$_handles[] = $handle;
        self::$_post = [];
        self::$_header = [];
        self::$_param = [];
        curl_multi_add_handle(self::$_handle, $handle);
        return $this;
    }

    /**
     * @return $this
     */
    public function execute()
    {
        $r = false;
        do {
            usleep(1000);
            curl_multi_exec(self::$_handle,$r);
        }
        while($r > 0);

        foreach(self::$_handles as $handle) {
            self::$response[] = curl_multi_getcontent($handle);
            curl_multi_remove_handle(self::$_handle, $handle);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function close()
    {
        curl_multi_close(self::$_handle);
        return $this;
    }
}