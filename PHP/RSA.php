<?php
/**
 * Created by PhpStorm.
 * User: chenzi
 * Date: 7/3/18
 * Time: 9:55 AM
 */

namespace App\Services;

/**
 * RAS算法加密解密
 *
 * Class RSA
 *
 * @package app\Services
 */
class RSA {

	const RSA_PUBLIC_KEY =<<<STR
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDYul+eKZYkHLDXlqnD3VzmZJFS
3hGckJW9tBv1YRGJIcyyiO8Z06YO31xlyzGAtX2tABkyz2FUnzOeVlEHi4P08LCO
OKUG3iQgLo/Y7khVGxsS40GC46AwqUib+6jY7zqOMjD2NXEQt9wpqPkQW6QJtHeN
utVBpmR3xVeoimIpfwIDAQAB
-----END PUBLIC KEY-----
STR;

	const RSA_PRIVATE_KEY =<<<STR
-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDYul+eKZYkHLDXlqnD3VzmZJFS3hGckJW9tBv1YRGJIcyyiO8Z
06YO31xlyzGAtX2tABkyz2FUnzOeVlEHi4P08LCOOKUG3iQgLo/Y7khVGxsS40GC
46AwqUib+6jY7zqOMjD2NXEQt9wpqPkQW6QJtHeNutVBpmR3xVeoimIpfwIDAQAB
AoGAHmrZ7KrNhbf5IejlXrX8yeEnfEfqlNy+B2f13JSJD4QM5KnPVQKddcznfOnt
wrC2OMegwb7VXDkT148pxDNSi5X1szm5sP0FmHk/5JVB1tEq9+7skAsaXM3QJoeL
tzMBi01+A00pYrhqXm8v/DR6Qp6JK8/GkbnUY1Pa9iVqJkECQQDtFxuqZBIg4/Ez
oLRScs8EYiZQHcBjijiS5+BJqjrQlzsinCCtAq0SuOM8adq5hPLSBddsNg3Gew6Y
2o1wIy4PAkEA6gOCttz2jmu6HgxQ1G7SNZ87dDtyIWO8E5FuDVU15WT4zNvlMpPp
Ba9bwX3NsfkKSEKOCRYrys/UJ1wKj0y9kQJBANdJYm/IysVe9kkBJnyvj9fVICEj
wu0gN9r9/yYlE58RlDsLNoijo3Eavgy/ukM3vB6F+2VheATA/TJDUqd+6nUCQQCJ
zfFuv+ZNbjDWuwfqYSxWuWMoik0mTnYVy+FT5qbrZC+Da8anpyRk3aQZ6Hx13qLo
dJDx1uWI9CQJ3ZC2XEmRAkAW3/yGYih+5lSMdzZAKUVI3q82vs6ELH1ApsUPwdKn
L6DpmDpEMzhq1qImjDCA9FakxhTWW+anz85/fWUFTocT
-----END RSA PRIVATE KEY-----
STR;


	/**
	 * 使用公钥加密
	 * @param $data
	 *
	 * @return string
	 */
	public static function encryptWithPublicKey( $data ) {
		$publicKey = openssl_get_publickey(self::RSA_PUBLIC_KEY);
		openssl_public_encrypt( $data, $encrypted, $publicKey );
		$base64Encoded = base64_encode( $encrypted );

		return $base64Encoded;
	}

	/**
	 * 使用私钥解密
	 * @param $data
	 *
	 * @return mixed
	 */
	public static function decryptWithPrivateKey( $data ) {
		$privateKey = openssl_get_privatekey(self::RSA_PRIVATE_KEY);
		openssl_private_decrypt( base64_decode( $data ), $decrypted,
			$privateKey );

		return $decrypted;
	}

	/**
	 * 使用私钥加密
	 * @param $data
	 *
	 * @return string
	 */
	public static function encryptWithPrivateKey( $data ) {
		$privateKey = openssl_get_privatekey( self::RSA_PRIVATE_KEY );
		openssl_private_encrypt( $data, $encrypted, $privateKey );
		$base64Encoded = base64_encode( $encrypted );

		return $base64Encoded;
	}

	/**
	 * 使用公钥解密
	 * @param $data
	 *
	 * @return mixed
	 */
	public static function decryptWithPublicKey( $data ) {
		$publicKey = openssl_get_publickey( self::RSA_PUBLIC_KEY );
		openssl_public_decrypt( base64_decode( $data ), $decrypted, $publicKey );

		return $decrypted;
	}
}