package net.chenzi.aes_rsa.aes_rsa;

import android.util.Base64;

import java.security.KeyFactory;
import java.security.PublicKey;
import java.security.spec.X509EncodedKeySpec;

import javax.crypto.Cipher;

public class RSA {

    private static String mPublicKey = "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDYul+eKZYkHLDXlqnD3VzmZJFS3hGckJW9tBv1YRGJIcyyiO8Z06YO31xlyzGAtX2tABkyz2FUnzOeVlEHi4P08LCOOKUG3iQgLo/Y7khVGxsS40GC46AwqUib+6jY7zqOMjD2NXEQt9wpqPkQW6QJtHeNutVBpmR3xVeoimIpfwIDAQAB";

    /**
     * 加密
     *
     * @param data String
     * @return
     */
    public static String encryptWithPublicKey(String data) {
        byte[] encryptedBytes = {};
        try {
            PublicKey publicKey = getPublicKey(mPublicKey);
            encryptedBytes = encrypted(data.getBytes(), publicKey);
        } catch (Exception e) {
            e.printStackTrace();
        }

        return Base64.encodeToString(encryptedBytes, Base64.NO_WRAP);
    }

    /**
     * 解密
     *
     * @param data String
     * @return
     */
    public static String decryptWithPublicKey(String data) {
        byte[] decryptedBytes = {};
        try {
            byte[] decodedData = Base64.decode(data, Base64.NO_WRAP);
            PublicKey publicKey = getPublicKey(mPublicKey);
            decryptedBytes = decrypt(decodedData, publicKey);
        } catch (Exception e) {
            e.printStackTrace();
        }

        return new String(decryptedBytes);
    }


    private static byte[] encrypted(byte[] content, PublicKey publicKey) throws Exception {
        Cipher cipher = Cipher.getInstance("RSA/ECB/PKCS1Padding");
        cipher.init(Cipher.ENCRYPT_MODE, publicKey);
        return cipher.doFinal(content);
    }

    private static byte[] decrypt(byte[] content, PublicKey publicKey) throws Exception {
        Cipher cipher = Cipher.getInstance("RSA/ECB/PKCS1Padding");
        cipher.init(Cipher.DECRYPT_MODE, publicKey);
        return cipher.doFinal(content);
    }

    private static PublicKey getPublicKey(String publicKeyString) throws Exception {
        byte[] keyBytes = Base64.decode(publicKeyString.getBytes(), Base64.DEFAULT);
        X509EncodedKeySpec keySpec = new X509EncodedKeySpec(keyBytes);
        KeyFactory keyFactory = KeyFactory.getInstance("RSA");
        return keyFactory.generatePublic(keySpec);
    }
}