<?php

/**
 * Class base64Pwd
 * 加解密字符串
 */
class base64Pwd
{
    /**
     * @var int
     * 预设值
     */
    private $_PWDNUB = 5;//模数
    private $_ALPHA = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";//随机字符串范围
    private $_VERSION = "1.0";//版本

    /**
     * @param $s
     * @return string
     * 加密
     */
    public function encode(&$s)
    {
        $s_len = mb_strlen($s) % $this->_PWDNUB;
        $s_random = self::getRandomString(mb_strlen($s));
        $s = mb_substr($s_random, 0, $s_len) . mb_substr($s, $s_len) . mb_substr($s_random, $s_len) . mb_substr($s, 0, $s_len);
        $pwd_str = base64_encode($s);
        $pwd_str_len = mb_strlen($pwd_str);
        $pwd_str_stlen = $pwd_str_len % $this->_PWDNUB;

        $s = base64_encode(mb_substr($pwd_str, 0, $pwd_str_stlen) . self::getRandomString($pwd_str_len) . mb_substr($pwd_str, $pwd_str_stlen));
        return $s;
    }

    /**
     * @param $s
     * @return string
     * 解密
     */
    public function decode(&$s)
    {
        $pwd_str = base64_decode($s);
        $pwd_str_len = mb_strlen($pwd_str) / 2;
        $pwd_str_stlen = $pwd_str_len % $this->_PWDNUB;
        $pwd_str_base64 = base64_decode(mb_substr($pwd_str, 0, $pwd_str_stlen) . mb_substr($pwd_str, $pwd_str_stlen + $pwd_str_len));
        $str_len = mb_strlen($pwd_str_base64) / 2;
        $str_stlen = $str_len % $this->_PWDNUB;
        $str_len -= $str_stlen;

        $s = mb_substr($pwd_str_base64, (mb_strlen($pwd_str_base64) - $str_stlen)) . mb_substr($pwd_str_base64, $str_stlen, $str_len);
        return $s;
    }

    /**
     * @param int $len
     * @return string
     * 随机字符串
     */
    public function getRandomString($len = 64)
    {
        $maxPos = mb_strlen($this->_ALPHA);
        $pwd = '';
        for ($i = 0; $i < $len; $i++) {
            $pwd .= $this->_ALPHA[mt_rand(0, $maxPos - 1)];
        }
        return $pwd;
    }

}

/**
 * 列：
 */
$base64pwd = new base64Pwd();
if ($argv[1]) {

    if ($argv[2]) {
        var_dump($base64pwd->decode($argv[1]));
    } else {
        var_dump($base64pwd->encode($argv[1]));
    }
} else {

    var_dump($base64pwd->getRandomString(3));
}

die;

