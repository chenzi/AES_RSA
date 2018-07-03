<?php
/**
 * Created by PhpStorm.
 * User: chenzi
 * Date: 7/3/18
 * Time: 9:55 AM
 */

namespace App\Services;

/**
 * AES算法加密解密
 *
 * Class AES
 *
 * @package App\Services
 */
class AES {

	const IV = "poijmhzemrsaqony";

	public static function encrypt( $data, $key ) {
		$encrypted = openssl_encrypt( $data, 'aes-256-cbc', $key,
			OPENSSL_RAW_DATA, self::IV );

		return base64_encode( $encrypted );
	}

	public static function decrypt( $data, $key ) {
		$decrypted = openssl_decrypt( base64_decode( $data ), 'aes-256-cbc',
			$key, OPENSSL_RAW_DATA, self::IV );

		return $decrypted;
	}
}