Logback：
	spring boot默认的日志框架
	配置：
		新建文件：src/main/resources/logback.xml
		内容：
		<?xml version="1.0" encoding="UTF-8"?>
		<configuration debug="false">
			<!--定义日志文件的存储地址 勿在 LogBack 的配置中使用相对路径-->
			<property name="LOG_HOME" value="E:/JavaWorkSpace/Log" />
			<!-- 控制台输出 -->
			<appender name="STDOUT" class="ch.qos.logback.core.ConsoleAppender">
				<encoder class="ch.qos.logback.classic.encoder.PatternLayoutEncoder">
					<!--格式化输出：%d表示日期，%thread表示线程名，%-5level：级别从左显示5个字符宽度%msg：日志消息，%n是换行符-->
					<pattern>%d{yyyy-MM-dd HH:mm:ss.SSS} [%thread] %-5level %logger{50} - %msg%n</pattern>
				</encoder>
			</appender>
			<!-- 按照每天生成日志文件 -->
			<appender name="FILE"  class="ch.qos.logback.core.rolling.RollingFileAppender">
				<rollingPolicy class="ch.qos.logback.core.rolling.TimeBasedRollingPolicy">
					<!--日志文件输出的文件名-->
					<FileNamePattern>${LOG_HOME}/TestWeb.log.%d{yyyy-MM-dd}.log</FileNamePattern>
					<!--日志文件保留天数-->
					<MaxHistory>30</MaxHistory>
				</rollingPolicy>
				<encoder class="ch.qos.logback.classic.encoder.PatternLayoutEncoder">
					<!--格式化输出：%d表示日期，%thread表示线程名，%-5level：级别从左显示5个字符宽度%msg：日志消息，%n是换行符-->
					<pattern>%d{yyyy-MM-dd HH:mm:ss.SSS} [%thread] %-5level %logger{50} - %msg%n</pattern>
				</encoder>
				<!--日志文件最大的大小-->
				<triggeringPolicy class="ch.qos.logback.core.rolling.SizeBasedTriggeringPolicy">
					<MaxFileSize>10MB</MaxFileSize>
				</triggeringPolicy>
			</appender>
			<!-- show parameters for hibernate sql 专为 Hibernate 定制 -->
			<logger name="org.hibernate.type.descriptor.sql.BasicBinder"  level="TRACE" />
			<logger name="org.hibernate.type.descriptor.sql.BasicExtractor"  level="DEBUG" />
			<logger name="org.hibernate.SQL" level="DEBUG" />
			<logger name="org.hibernate.engine.QueryParameters" level="DEBUG" />
			<logger name="org.hibernate.engine.query.HQLQueryPlan" level="DEBUG" />

			<!--myibatis log configure-->
			<logger name="com.apache.ibatis" level="TRACE"/>
			<logger name="java.sql.Connection" level="DEBUG"/>
			<logger name="java.sql.Statement" level="DEBUG"/>
			<logger name="java.sql.PreparedStatement" level="DEBUG"/>

			<!-- 日志输出级别 -->
			<root level="INFO">
				<appender-ref ref="STDOUT" />
				<appender-ref ref="FILE" />
			</root>
			<!--日志异步到数据库 -->
			<!--<appender name="DB" class="ch.qos.logback.classic.db.DBAppender">-->
				<!--日志异步到数据库-->
				<!--<connectionSource class="ch.qos.logback.core.db.DriverManagerConnectionSource">-->
					<!--连接池-->
					<!--<dataSource class="com.mchange.v2.c3p0.ComboPooledDataSource">-->
						<!--<driverClass>com.mysql.jdbc.Driver</driverClass>-->
						<!--<url>jdbc:mysql://127.0.0.1:3306/databaseName</url>-->
						<!--<user>root</user>-->
						<!--<password>root</password>-->
					<!--</dataSource>-->
				<!--</connectionSource>-->
			<!--</appender>-->
		</configuration>
	使用：
	@RestController
	public class Example {
		private final static Logger logger = LoggerFactory.getLogger(Example.class);
		
		@RequestMapping("/")
		public String home() {
			logger.info("提示");
			logger.error("提示");
		}
		
	}	