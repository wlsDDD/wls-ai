import com.mybatisflex.codegen.Generator;
import com.mybatisflex.codegen.config.ColumnConfig;
import com.mybatisflex.codegen.config.GlobalConfig;
import com.zaxxer.hikari.HikariDataSource;

public class TestA {
    public static void main(String[] args) {
        // 配置数据源
        HikariDataSource dataSource = new HikariDataSource();
        dataSource.setJdbcUrl("jdbc:mysql://localhost:3306/wls-ry-vue?useUnicode=true&characterEncoding=utf8&zeroDateTimeBehavior=convertToNull&useSSL=true&serverTimezone=GMT%2B8");
        dataSource.setUsername("root");
        dataSource.setPassword("wls-mysql-tencent");
        
        // 创建配置内容，两种风格都可以。
        GlobalConfig globalConfig = createGlobalConfigUseStyle1();
        // GlobalConfig globalConfig = createGlobalConfigUseStyle2();
        
        // 通过 datasource 和 globalConfig 创建代码生成器
        Generator generator = new Generator(dataSource, globalConfig);
        
        // 生成代码
        generator.generate();
    }
    
    public static GlobalConfig createGlobalConfigUseStyle1() {
        // 创建配置内容
        GlobalConfig globalConfig = new GlobalConfig();
        
        // 设置根包
        globalConfig.setBasePackage("plus.wls.flex.test");
        
        // 设置表前缀和只生成哪些表
        globalConfig.setGenerateSchema("wls-ry-vue");
        globalConfig.setTablePrefix("sys_");
        globalConfig.setGenerateTable("user", "role");
        
        // 设置生成 entity 并启用 Lombok
        globalConfig.setEntityGenerateEnable(true);
        globalConfig.setEntityWithLombok(true);
        
        // 设置生成 mapper
        globalConfig.setMapperGenerateEnable(true);
        
        // 可以单独配置某个列
        // ColumnConfig columnConfig = new ColumnConfig();
        // columnConfig.setColumnName("tenant_id");
        // columnConfig.setLarge(true);
        // columnConfig.setVersion(true);
        // globalConfig.setColumnConfig("account", columnConfig);
        
        return globalConfig;
    }
    
    public static GlobalConfig createGlobalConfigUseStyle2() {
        // 创建配置内容
        GlobalConfig globalConfig = new GlobalConfig();
        
        // 设置根包
        globalConfig.getPackageConfig()
                    .setBasePackage("com.test");
        
        // 设置表前缀和只生成哪些表，setGenerateTable 未配置时，生成所有表
        globalConfig.getStrategyConfig()
                    .setGenerateSchema("schema")
                    .setTablePrefix("tb_")
                    .setGenerateTable("account", "account_session");
        
        // 设置生成 entity 并启用 Lombok
        globalConfig.enableEntity()
                    .setWithLombok(true);
        
        // 设置生成 mapper
        globalConfig.enableMapper();
        
        // 可以单独配置某个列
        ColumnConfig columnConfig = new ColumnConfig();
        columnConfig.setColumnName("tenant_id");
        columnConfig.setLarge(true);
        columnConfig.setVersion(true);
        globalConfig.getStrategyConfig()
                    .setColumnConfig("account", columnConfig);
        
        return globalConfig;
    }
    
}
