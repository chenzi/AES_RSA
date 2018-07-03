//
//  ViewController.m
//  AES_RSA
//
//  Created by chenzi on 7/3/18.
//  Copyright © 2018 chenzi. All rights reserved.
//

#import "ViewController.h"
#import "RSA.h"
#import "AES.h"

@interface ViewController ()

@end

@implementation ViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    
    NSString *pubkey = @"-----BEGIN PUBLIC KEY-----\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDYul+eKZYkHLDXlqnD3VzmZJFS 3hGckJW9tBv1YRGJIcyyiO8Z06YO31xlyzGAtX2tABkyz2FUnzOeVlEHi4P08LCO OKUG3iQgLo/Y7khVGxsS40GC46AwqUib+6jY7zqOMjD2NXEQt9wpqPkQW6QJtHeN utVBpmR3xVeoimIpfwIDAQAB\n-----END PUBLIC KEY-----";
    
    NSString *originString = @"hello world!";
    
    NSString *encWithPubKey;
    NSString *decWithPublicKey;
    
    NSLog(@"Original string(%d): %@", (int)originString.length, originString);
    
    // 使用公钥加密字符串
    encWithPubKey = [RSA encryptString:originString publicKey:pubkey];
    NSLog(@"Enctypted with public key: %@", encWithPubKey);

    // PHP生成的密文
    encWithPubKey = @"wArIPLFKqy3XU/QFY4hM/Gy9yLrQh9fylXrLu4Vib3yU5ryks+fqvt5AMjyacamFolozuLPd97unTeOEobZG1MQxRX2wKfV9M8qZlUMZvRayyPiy4e8K5Rys6yveH81MqCvDNFCYJVPkb/oq04XlSSZRss3jIyXRgSZvHSbRfi8=";
    
    // 使用公钥解密
    decWithPublicKey = [RSA decryptString:encWithPubKey publicKey:pubkey];
    NSLog(@"(PHP enc)Decrypted with public key: %@", decWithPublicKey);
    
    
    //AES算法演示
    
    NSString *plainText = @"IAmThePlainText";
    NSString *key = @"1e016d1e6d40a1bf9cf7d546c22e797c";
    
    NSString *cipherText = aesEncryptString(plainText, key);
    
    NSLog(@"%@", cipherText);
    
    NSString *decryptedText = aesDecryptString(cipherText, key);
    
    NSLog(@"%@", decryptedText);
    
    //加密服务器加密的数据
    decryptedText = aesDecryptString(@"Ey6ueOLvwVVwPOgLCBMsYQ==", key);
    NSLog(@"%@", decryptedText);
    
}


- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}


@end
