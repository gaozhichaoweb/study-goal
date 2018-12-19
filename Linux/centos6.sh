centos6的常用命令集：
	查看内核版本
		cd /proc
		cat veresion
	重启网络服务
		service network restart
	切换用户:
		su root
		su javaer
	yum:
		(yellow dog update Modified) 软件包管理器
		基于rpm包管理，能够从指定的服务器自动下载rpm包并安装，可自动处理依赖关系
		yum语法：yum [option] [command] [package ...] 
			option: -h帮助 -y当安装过程提示选择全部为yes -q不显示安装过程
			command: 要进行的操作
			package :操作的对象
		安装：
			yum install --------------------全部安装
			yum install package_name--------安装指定的安装包package_name
			yum install yumex---安装yum图形窗口插件
		更新和升级：
			yum update----------更新所有软件
			yum update package_name---------仅更新指定的安装包package_name	
			yum check-update----列出所有可更新的软件清单
			yum upgrade package_name---------升级指定的安装包package_name
			yum groupupdate group1 升级程序组group1
		查找和显示：
			yum info package------显示安装包信息
			yum list--------------显示所有已经安装和可以安装的程序包
			yum list package------显示指定程序包安装情况
			yum groupinfo group1--显示程序组group1信息
			yum search keyword-----------根据关键字查找安装包：
		删除：
			yum remove package_name------删除软件包
			yum groupremove group1-------删除程序组group1
			yum deplist package----------查看程序package的依赖情况
		缓存：
			yum clean packages-------清除缓存目录下的软件包
			yum clean headers--------清除缓存目录下的headers
			yum clean all -----------清除缓存目录下的软件包以及旧的headers
			yum makecache------------生成缓存
		修改为国内yum源：首选网易yum源
			备份之前的源：
			mv /etc/yum.repos.d/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo.bak
		下载对应版本的repo文件，放入/etc/yum.repos.d
			http://mirrors.163.com/.help/CentOS6-Base-163.repo
		运行一下命令生成缓存：
			yum clean all
			yum makecache
	rpm包管理软件:
		rpm -ql 包名 //查看软件安装目录
		rpm -qa | grep 包名  查看有没有安装这个包
		rpm -qa 查看全部已安装的包名
		安装：
			rpm -ivh *.rpm
		卸载：
			rpm -e 包名
	*.tar.gz/*.tgz *.bz2软件安装卸载
		安装：
			tar zxvf *.tar.gz / tar yxvf *.tar.gz
			z:调用gzip解压
			x:解包
			v: 校验
			f:显示结果
			y:调用bzip2解压
		卸载： 
			手动删除
	查看网络信息
		ifconfig
	配置网络:
		cd /etc/sysconfig/network-scripts
		vim ifcfg-eth0
			DEVICE=eth0
			HWADDR=08:00:27:07:0f:e9
			TYPE=Ethernet
			UUID=easfaaaa-seaea-
			ONBOOT=no
			BOOTPROTO=dhcp
		动态地址只需要修改：
			ONBOOT=yes
		静态地址修改：
			ONBOOT=yes
			BOOTPROTO=static
			添加：
				IPADDR=192.168.0.12
				NETMASK=255.255.255.0
				GATEWAY=192.168.198.2
			(i进入编辑模式，esc退出编辑模式，wq.q!)
		设置DNS服务
			vi /etc/resolv.conf
			添加：
			nameserver 114.114.114.114
	防火墙
		开启：
			chkconfig iptables on  开机自启动，重启后生效
			service iptables start 立即生效，重启后失效
		关闭：
			chkconfig iptables off 开机自启动，重启后生效
			service iptables stop  立即生效，重启后失效
	修改目录权限：
		chmod -R 777 /var/www
	安装GNOME
		yum -y groupinstall Desktop
		yum -y groupinstall "X window System"
		startx
virtualBox安装centos6系统：
	1.下载并安装virtualBox和CentOS-6.10-x86_64-bin-DVD1
	2.virtualBox设置 ：
		本机设置：
			网络和共享中心->更改适配器设置->virtualBox Host-Only network设置为自动获取
			ipconfig
				virtualBox Host-Only network的ip地址为169.254.0.253
				本机: 192.168.31.146
		虚拟机：
		
			设置为自动获取Ip
				cd /etc/sysconfig/network-scripts
				vim ifcfg-eth0
				修改:
					ONBOOT=yes
					BOOTPROTO=dhcp
				ifconfig
					虚拟机ip地址:10.0.2.15
			打开21和8080端口(或者直接关闭防火墙)
				/sbin/iptables -I INPUT -p tcp --dport 21 -j ACCEPT
				/sbin/iptables -I INPUT -p tcp --dport 8080 -j ACCEPT
				/etc/rc.d/init.d/iptables save
			关闭防火墙:
				service iptables stop   立即生效，重启后失效
				chkconfig iptables off  开机自启动，重启后生效
		virtualBox设置-网络
			链接方式: 网络地址转换NAT
			端口转发：
				名称：ftp 
				协议：tcp 
				主机ip：本机的virtualBox Host-Only network的ip地址(169.254.0.253)
				主机端口:21 
				子系统ip:虚拟机设置为自动获取的ip(10.0.2.15)
				子系统端口:21
			端口转发：
				名称：www
				协议：tcp 
				主机ip：本机的virtualBox Host-Only network的ip地址(169.254.0.253)
				主机端口:8080 
				子系统ip:虚拟机设置为自动获取的ip(10.0.2.15)
				子系统端口:8080
		测试虚拟机上网正常
			ping www.baidu.com
		虚拟机主机互通正常
			虚拟机: ping 192.168.31.146
			主机: ping 169.254.0.253正常
centos6的javaweb服务器的搭建：
	查看jdk版本:
		java -version
	查看虚拟机已安装的jdk:
		rpm -qa java
		查看结果:
			tzdata-java.noarch
			java-1.7....
	如果虚拟机和本机上eclipse的jdk版本不同，则需要在虚拟机上安装相同版本的jdk,入则会报如下错误： 
		unsupported major.minor version 52.0
		例如：
			eclipse使用的是jdk1.8,而服务器上是openJDK1.7.0_181，所以会报此错误
			eclipse的build path的JDK版本是开发的时候编译器的版本
			java compiler compliance level中的版本是项目将来开发完毕后，要放到服务器，服务器上运行的JDK版本
		解决方案：
			eclipse->window>preferences>java>compiler>compiler compliance level 选择服务器上的JDK版本
			项目右键>preperties>java compiler>和服务器上的JDK版本一致
			所以本地要安装和服务器上一致的JDK版本
	卸载虚拟机上的jdk:
		yum -y remove java-1.7(全称)
		yum -y remove tzdata-java.noarch(rpm -e tzdata-java.noarch)
	安装和主机相同的jdk版本
		yum -y list java*
		yum -y install java-1.8.0-openjdk
	(设置环境变量
		[root@localhost ~]# vi /etc/profile
		在profile文件中添加如下内容
		#set java environment
		JAVA_HOME=/usr/lib/jvm/java-1.7.0-openjdk-1.7.0.75.x86_64
		JRE_HOME=$JAVA_HOME/jre
		CLASS_PATH=.:$JAVA_HOME/lib/dt.jar:$JAVA_HOME/lib/tools.jar:$JRE_HOME/lib
		PATH=$PATH:$JAVA_HOME/bin:$JRE_HOME/bin
		export JAVA_HOME JRE_HOME CLASS_PATH PATH
	)
	查看jdk版本:
		java -version
		变为1.8.0
centos6的ftp服务器的搭建：
	yum install vsftpd
	service vsftpd start
	关掉虚拟机的selinux和iptables
		service iptables stop
		chkconfig iptables off
		vim /etc/selinux/config
			SELINUX=disabled
	打开21和20端口或者直接关闭防火墙
		/sbin/iptables -I INPUT -p tcp --dport 21 -j ACCEPT
		/etc/rc.d/init.d/iptables save
	虚拟机的ftp服务器配置目录/etc/vsftpd/vsftpd.conf
		anonymous_enable=NO
	/etc/vsftpd/ftpusers文件配置了那些账户不能访问ftp服务器，其中就有root
	/etc/vsftpd/user_list文件里的账户默认也不能访问ftp服务器，只有vsftpd.conf列启用userlist_enable=NO选项时才允许访问
	新建一个ftp用户，用该用户的账户密码就可以访问ftp了。
		adduser javaer
		passwd javaer
		回车后输入密码
		修改密码:
			用要修改的用户账号登录，输入passwd
			输入旧密码，输入新密码
	修改目录权限：
		chmod -R 777 /var/www
	TUDO:最好给每个ftp用户都配置权限，只能访问某个目录而不能访问root等关键目录
centos6的apache服务器的搭建：
    yum install httpd
       httpd -v 查看版本号
	  安装成功后就会生成/var/www/html目录
	配置解析.php文件
	  cd /etc/httpd/conf/httpd.conf
	  添加：
	    AddType application/x-httpd-php .php .htm .html
centos6安装php
    yum install php.x86_64
centos6的mysql服务器的搭建：
    yum install mysql-server.x86_64
	service mysqld start   开启mysql服务器
    mysqladmin -u root password 123456  //设置数据库密码
    mysql -u root -p 123456  //登录
centos6的springboot部署：
	使用eclipse的maven打包为jar包形式：
		修改配置文件里的mysql和服务器一致
		运行项目
		然后右键点击项目->run as ->maven install，自动打包，打包好的文件保存在target目录
	使用ftp上传打包好的jar包到虚拟机上的/var/www/html目录
		主机: 169.254.0.253 21
		用户: javaer
		密码: javaer666
	进入目录/var/www/html运行jar包
		nohup java -jar gcms-0.0.1-SNAPSHOT.jar
	虚拟机测试：
		localhost:8080/admin/index------正常
	主机测试:
		169.254.0.253:8080/admin/index--正常
	springboot默认的是jar包，不需要安装tomcat服务器就可以运行
	一般项目会打为war包在服务器中发布与测试
	war包和jar包区别：
		jar:直接通过内置tomcat运行，不需要安装tomcat。内置tomcat没有自己的日志输出，全靠jar包应用输出日志
			方便、快速、简单
		war包:传统的应用交付方式，需要安装tomcat,然后放到webapps目录下运行war包
			灵活选择tomcat版本，可以直接修改tomcat的配置，有自己的tomcat日志输出
			可以灵活配置安全策略，相对于jar包没那么快速方便
	war包打包:
		修改打包形式pom.xml
			<packaging>war</packaging>
		移除嵌入式tomcat插件
			在pom.xml里找到spring-boot-starter-web依赖节点，修改如下
			<dependency>
				<groupId>org.springframework.boot</groupId>
				<artifactId>spring-boot-starter-web</artifactId>
				<!-- 移除嵌入式tomcat插件 -->
				<exclusions>
					<exclusion>
						<groupId>org.springframework.boot</groupId>
						<artifactId>spring-boot-starter-tomcat</artifactId>
					</exclusion>
				</exclusions>
			</dependency>
		添加servlet-api依赖，以下两种方式2选1
			<dependency>
				<groupId>javax.servlet</groupId>
				<artifactId>javax.servlet-api</artifactId>
				<version>3.1.0</version>
				<scope>provided</scope>
			</dependency>
			<dependency>
				<groupId>org.apache.tomcat</groupId>
				<artifactId>tomcat-servlet-api</artifactId>
				<version>8.0.36</version>
				<scope>provided</scope>
			</dependency>
		修改启动类，并重写初始化方法
			//App启动类
			@SpringBootApplication
			public class Application {
				public static void main(String[] args) {
					SpringApplication.run(Application.class, args);
				}
			}
			/**
			 * 修改启动类，继承 SpringBootServletInitializer 并重写 configure 方法
			 */
			public class SpringBootStartApplication extends SpringBootServletInitializer {
			 
				@Override
				protected SpringApplicationBuilder configure(SpringApplicationBuilder builder) {
					// 注意这里要指向原先用main方法执行的Application启动类
					return builder.sources(Application.class);
				}
			}
		打包：
			maven clean package

			








