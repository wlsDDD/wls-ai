package plus.wls.flex;

import lombok.extern.slf4j.Slf4j;
import org.mybatis.spring.annotation.MapperScan;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.cloud.client.discovery.EnableDiscoveryClient;
import org.springframework.cloud.openfeign.EnableFeignClients;
import org.springframework.context.ConfigurableApplicationContext;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.core.env.Environment;
import org.springframework.scheduling.annotation.EnableAsync;

import java.net.InetAddress;
import java.net.UnknownHostException;

import static plus.wls.common.core.constant.GlobalConstants.basePackage;

/**
 * MyBatis-Flex
 *
 * @author wls
 * @since 2023-07-28
 */
@Slf4j
@ComponentScan(basePackage)
@EnableAsync
@EnableFeignClients(basePackage)
@EnableDiscoveryClient
@SpringBootApplication
@MapperScan(basePackage + ".**.mapper")
public class WlsFlexApplication {
    
    public static void main(String[] args) throws UnknownHostException {
        ConfigurableApplicationContext application = SpringApplication.run(WlsFlexApplication.class, args);
        
        Environment env = application.getEnvironment();
        String ip = InetAddress.getLocalHost().getHostAddress();
        String port = env.getProperty("server.port");
        String appName = env.getProperty("spring.application.name");
        String active = env.getProperty("spring.profiles.active");
        String path = env.getProperty("server.servlet.context-path");
        log.info("-------------------------------------------------------");
        log.info("Application {} {} is running! ", appName, active);
        log.info("Local: http://localhost:{}{}/", port, path);
        log.info("External: http://{}:{}{}/", ip, port, path);
        log.info("Doc文档: http://{}:{}{}/doc.html", ip, port, path);
    }
    
}
