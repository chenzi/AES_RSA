//
//  AES.h
//  AES_RSA
//
//  Created by chenzi on 7/3/18.
//  Copyright © 2018 chenzi. All rights reserved.
//

#import <Foundation/Foundation.h>

NSString * aesEncryptString(NSString *content, NSString *key);
NSString * aesDecryptString(NSString *content, NSString *key);

NSData * aesEncryptData(NSData *data, NSData *key);
NSData * aesDecryptData(NSData *data, NSData *key);

