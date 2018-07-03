package net.chenzi.aes_rsa.aes_rsa;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Base64;
import android.util.Log;
import java.io.IOException;
import java.security.PublicKey;
import java.util.Random;

import javax.crypto.Cipher;
import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.Headers;
import okhttp3.MediaType;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        MediaType mediaType = MediaType.parse("text/html; charset=utf-8");
        String requestBoy = "I am chenzi";
        Request request = new Request.Builder()
                .url("http://ubaer_api.test/api/v1/test")
                .post(RequestBody.create(mediaType, requestBoy)).build();

        OkHttpClient client = new okhttp3.OkHttpClient();

        client.newCall(request).enqueue(new Callback() {
            @Override
            public void onFailure(Call call, IOException e) {
                Log.d("error", "onFailure:" + e.getMessage());
            }

            @Override
            public void onResponse(Call call, Response response) throws IOException {
                Log.d("success", response.protocol() + " " +response.code() + " " + response.message());
                Headers headers = response.headers();
                String key = headers.get("key");
                Log.d("key=", key);

                //使用RSA算法解密AES密钥
                String keyContent = "";
                try {
                    keyContent =  RSA.decryptWithPublicKey(key);
                    Log.d("decrypt result：", keyContent);
                    //使用AES密钥解密数据
                    String content = AES.decrypt(response.body().string(), keyContent);
                    Log.i("decrypt content：", content);
                } catch (Exception e) {
                    Log.d("解密失败", e.toString());
                }
            }
        });

        //测试RSA加密
        String rsa_str = RSA.encryptWithPublicKey("26ff1eeb98b34e60fc68a1251502ec6e");
        Log.e("rsa_str=", rsa_str);
        //测试AES加密
        try {
            String aes_str = AES.encrypt("123", "26ff1eeb98b34e60fc68a1251502ec6e");
            Log.e("aes_str=", aes_str);

        } catch (Exception e) {
            Log.e("aes_str error ", e.getMessage());
        }


    }




}
