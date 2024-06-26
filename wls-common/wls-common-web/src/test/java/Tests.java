import cn.hutool.core.codec.Base64;
import cn.hutool.core.collection.ListUtil;
import cn.hutool.core.util.StrUtil;
import cn.hutool.crypto.SecureUtil;
import cn.hutool.crypto.SmUtil;
import cn.hutool.crypto.asymmetric.KeyType;
import cn.hutool.crypto.asymmetric.SM2;
import com.alibaba.fastjson.JSON;
import org.junit.jupiter.api.Test;
import org.springframework.mock.web.MockMultipartFile;
import plus.wls.common.web.mask.DataMaskFilter;
import plus.wls.common.web.pojo.AsyncLog;
import plus.wls.common.web.pojo.DataListener;
import plus.wls.common.web.util.ExcelUtil;

import java.security.KeyPair;

/**
 * @author wls
 * @since 2021/11/2 9:13
 */
public class Tests {
    
    String pub = "MFkwEwYHKoZIzj0CAQYIKoEcz1UBgi0DQgAEKfypJQYrjw8htpcfKfFRdMni38zJV41D0FKh/06rELDW4bAYwvNK8LFKa7vCoeweiefKzYdiC1q5RuF6ajAc2g==";
    String pri = "MIGTAgEAMBMGByqGSM49AgEGCCqBHM9VAYItBHkwdwIBAQQg8DLSZ2SmfqEuF+v0Vrv0iRJHYYd3koVWsFnE0iPXlZKgCgYIKoEcz1UBgi2hRANCAAQp/KklBiuPDyG2lx8p8VF0yeLfzMlXjUPQUqH/TqsQsNbhsBjC80rwsUpru8Kh7B6J58rNh2ILWrlG4XpqMBza";
    
    @Test
    public void test01() {
        SM2 sm2 = SmUtil.sm2();
        String format = sm2.getPrivateKey().getFormat();
        String format1 = sm2.getPublicKey().getFormat();
    }
    
    @Test
    void test04() {
        ExcelUtil.importExcel(new MockMultipartFile("xx", "xx".getBytes()), new DataListener<AsyncLog>(asyncLogs -> {
        
        }));
    }
    
    @Test
    void test03() {
        AsyncLog asyncLog = new AsyncLog().setMethodName("这是个方法名称").setAsyncLog(new AsyncLog().setMethodName("这是个方法名称222"))
                                          .setAsyncLogs(ListUtil.of(new AsyncLog().setMethodName("这是个方法名称333"),
                                                  new AsyncLog().setMethodName("这是个方法名称444")));
        String jsonString = JSON.toJSONString(asyncLog, new DataMaskFilter());
        
    }
    
    @Test
    void test02() {
        String text = "{\n  \"nickName\": \"不能为空\",\n  \"userName\": \"不能为空\"\n}";
        
        KeyPair pair = SecureUtil.generateKeyPair("SM2");
        byte[] privateKey = pair.getPrivate().getEncoded();
        byte[] publicKey = pair.getPublic().getEncoded();
        String privateStr = Base64.encode(privateKey);
        String publicStr = Base64.encode(publicKey);
        SM2 sm2 = SmUtil.sm2(pri, pub);
        // 公钥加密，私钥解密
        String encryptStr = sm2.encryptBcd(text, KeyType.PublicKey);
        String decryptStr = StrUtil.utf8Str(sm2.decryptFromBcd(encryptStr, KeyType.PrivateKey));
    }
    
}
