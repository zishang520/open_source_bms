<?php

namespace luoyy\Aes;

use think\Env;

/**
 * AES/CBC/PKCS5Padding 加密解密.comuni app
 *
 * @author zishang520 zishang520@gmail.com
 *
 * @version 1.0
 */
class Aes
{
    /**
     * @var string
     */
    private static $ENCRYPTKEY = "f6b0f909ad39ff7c046d2b25bf29325b"; //AESkey，可自定义
    /**
     * @var string
     */
    private static $IV = "1a4686b042b32ed8074dece77d8a8565"; //密钥偏移量IV，可自定义

    private static $SELF = null;

    /**
     * @param $ENCRYPTKEY
     * @param $IV
     */
    public function __construct()
    {
        self::$ENCRYPTKEY = md5(Env::get('APP_KEY', self::$ENCRYPTKEY));
        self::$IV = md5(self::$ENCRYPTKEY . self::$IV);
    }

    /**
     * [__callStatic 回调调用]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2017-11-18T17:09:42+0800
     * @copyright (c)                      ZiShang520 All           Rights Reserved
     * @param     [type]                   $method    [description]
     * @param     [type]                   $args      [description]
     * @return    [type]                              [description]
     */
    public static function __callStatic($method, $args)
    {
        if (is_null(self::$SELF)) {
            self::$SELF = new self;
        }
        return call_user_func_array([self::$SELF, $method], $args);
    }

    /**
     * 加密.
     *
     * @param mixed  $contents   要加密的内容
     * @param string $ENCRYPTKEY 加密的Key，长度为16，24，32的key
     *
     * @return string 已加密的内容
     */
    private function encrypt($contents)
    {
        try {
            return openssl_encrypt($contents, 'AES-128-CBC', hex2bin(self::$ENCRYPTKEY), null, hex2bin(self::$IV));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 解密.
     *
     * @param string $contents   已加密的内容
     * @param string $ENCRYPTKEY 解密Key，长度为16，24，32的key
     *
     * @return string 已解密的内容
     */
    private function decrypt($contents)
    {
        try {
            return openssl_decrypt($contents, 'AES-128-CBC', hex2bin(self::$ENCRYPTKEY), 0, hex2bin(self::$IV));
        } catch (\Exception $e) {
            return false;
        }
    }
    /**
     * [rc4 rc4加密]
     * @DateTime  2017-11-18T17:14:58+0800
     * @param     [type]                   $key_str   [description]
     * @param     [type]                   $data_str  [description]
     * @return    [type]                              [description]
     */
    public static function rc4($key_str, $data_str)
    {
        $key = [];
        $data = [];
        for ($i = 0; $i < strlen($key_str); $i++) {
            $key[] = ord($key_str{$i});
        }
        for ($i = 0; $i < strlen($data_str); $i++) {
            $data[] = ord($data_str{$i});
        }
        // prepare key
        $state = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,
            16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31,
            32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47,
            48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63,
            64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79,
            80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95,
            96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111,
            112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127,
            128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140, 141, 142, 143,
            144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 154, 155, 156, 157, 158, 159,
            160, 161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175,
            176, 177, 178, 179, 180, 181, 182, 183, 184, 185, 186, 187, 188, 189, 190, 191,
            192, 193, 194, 195, 196, 197, 198, 199, 200, 201, 202, 203, 204, 205, 206, 207,
            208, 209, 210, 211, 212, 213, 214, 215, 216, 217, 218, 219, 220, 221, 222, 223,
            224, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239,
            240, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 253, 254, 255];
        $len = count($key);
        $index1 = $index2 = 0;
        for ($counter = 0; $counter < 256; $counter++) {
            $index2 = ($key[$index1] + $state[$counter] + $index2) % 256;
            $tmp = $state[$counter];
            $state[$counter] = $state[$index2];
            $state[$index2] = $tmp;
            $index1 = ($index1 + 1) % $len;
        }
        // rc4
        $len = count($data);
        $x = $y = 0;
        for ($counter = 0; $counter < $len; $counter++) {
            $x = ($x + 1) % 256;
            $y = ($state[$x] + $y) % 256;
            $tmp = $state[$x];
            $state[$x] = $state[$y];
            $state[$y] = $tmp;
            $data[$counter] ^= $state[($state[$x] + $state[$y]) % 256];
        }
        // convert output back to a string
        $data_str = "";
        for ($i = 0; $i < $len; $i++) {
            $data_str .= chr($data[$i]);
        }
        return $data_str;
    }
    /**
     * @param $data
     */
    public static function url_encode($data)
    {
        return rtrim(strtr($data, '+/', '-_'), '=');
    }

    /**
     * @param $data
     */
    public static function url_decode($data)
    {
        return str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT);
    }
}
