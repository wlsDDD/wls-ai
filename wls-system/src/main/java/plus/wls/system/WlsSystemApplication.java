package plus.wls.system;

import lombok.extern.slf4j.Slf4j;
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
 * wls系统应用
 *
 * @author wls
 * @since 2021/01/20 14:28:02
 */
@Slf4j
@ComponentScan(basePackage)
@EnableAsync
@EnableFeignClients(basePackage)
@EnableDiscoveryClient
@SpringBootApplication
public class WlsSystemApplication {
    
    public static void main(String[] args) throws UnknownHostException {
        ConfigurableApplicationContext application = SpringApplication.run(WlsSystemApplication.class, args);
        
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
