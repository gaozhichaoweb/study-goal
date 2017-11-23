<?php
/*
linux根目录介绍：
1./bin
  binary 二进制
  许多"指令"对应的"可执行程序"文件目录
  ls  pwd init等
2./sbin
  super binary 超级的二进制
  许多"指令"对应的"可执行程序"文件目录
  该目录文件对应指令都是root用户可以执行的命令
  init
3./usr
  unix system resource(unix系统资源文件目录)
  该目录类似win系统的C:/Program files目录，经常用于安装软件
  软件安装完毕会形成对应的指令，该指令对应的可执行程序文件就存在以下目录
  /usr/bin
    许多指令对应的可执行程序文件目录
  /usr/sbin
	root用户执行的指令对应的可执行程序文件目录
4./dev
  device 系统硬件设备目录(linux系统所有的硬件都通过文件表示)
  /dev/cdrom是光驱
  /dev/sda是第一块scsi硬盘
5./home
  用户的"家目录"
  系统每增加一个普通用户的同时，都会在该目录为该用户设置一个文件目录
  代表该用户的家目录，用户后期使用的时候会首先进入其家目录
  家目录名字默认与当前用户名字一致，用户对家目录由绝对最高的权限
6./root
  该目录是root管理员的家目录，root用户登录系统后首先进入该目录
7./proc
  内容映射目录，该目录可以查看系统的相关硬件信息
8./var
  variable  可变的、易变的
  该目录存储的文件经常会发生变动，经常用于部署项目程序文件
  /var/www/index.php
9./boot
  系统启动核心目录，用于存储系统启动文件
10./etc
  系统主要配置文件目录
  /etc/passwd  用于存储用户信息的文件
  /etc/group	 用于存储组别信息的文件
11./lib
  library 系统资源文件类库目录
12./selinux
  secure enhanced linux 安全增强型Linux
  对系统形成保护，会对系统安装软件时有干扰作用
相对路径和绝对路径：
  相对路径：以引用文件所在位置为参考基层，而建立出的目录路径
  绝对路径：以web站点根目录为参考基础的目录路径
  jinzhou---->network-script
	#cd /etc/sysconfig/network-script [绝对路径]推荐
	#cd ../../../../../etc/sysconfig/network-script[相对路径]
  jinzhou---->dalian
	#cd ../[相对路径]推荐
	#cd /home/jinnan/tianjin/ningliao/dalian[绝对路径]
Linux常用命令:
1.查看目录下有什么文件/目录
  #ls			//list列出目录的文件信息
  #ls -l		//list -list查看目录文件"详细信息"
  #ls -a		//list -all查看目录全部(包括隐藏文件)文件
  #ls -al		//list -all -list 查看目录全部文件的详细信息相
  #ls 目录	//查看指定目录下有什么文件
2.进行目录切换
  #cd dirname		//进行目录切换
  #cd ..			//切换到上级目录
  #cd ~			//切换到当前用户的家目录
  #cd				//切换到当前用户的家目录
3.查看完整的操作位置
  #pwd
4.用户切换
  #su -			//向root用户切换
  #su -root		//向root用户切换
  #exit			//退回到原用户
  #su 用户名		//普通用户切换
5.查看当前用户是谁
  #whoami
6.图形界面与命令界面切换
  #init 3  			//命令行界面
  #init 5				//图形界面
7.查看一个指令对应的执行程序文件在哪
  #which 指令
8.目录相关操作
  a.创建目录 make directory
	#mkdir dirname
	#mkdir dir/newdir	//在已存在的dir目录下创建新目录
	#mkdir -p newdir/newdir2/newdir3 //递归方式创建多个新的连续目录
  b.移动目录  move
	#mv dir1 dir2			//把dir1移动到dir2目录下
	#mv dir1/dir2 dir3		//把dir2移动到dir3目录下
	#mv dir1/dir2 dir3/dir4 //把dir2移动到dir4目录下
	#mv dir1/dir2 ./		//把dir2移动到当前目录下
	#mv a* dir1             //把a开头的文件移动到dir1目录
  c.改名字
	#mv dir1 newdir			//修改dir1的名字为newdir
	#mv dir1 ./newdir		//把dir1移动到当前目录，并改名newdir
	#mv dir1/dir2 dir3		//dir2移动到dir3目录下，原名
	#mv dir1/dir2 dir3/newdir	//dir2移动到dir3目录下，并改名newdir
  d.目录复制 copy
	文件复制
	#cp file1 dir/newdir	//file1复制到dir目录下，并改为newdir
	#cp file1 dir			//file1复制到dir目录下，不改名
	#cp dir1/file1 dir2/newfile //file1复制到dir2目录下，并改为newdir
	目录复制(需要设置-r[recursive递归]参数，无视目录的层次)
	#cp -r dir1 dir2		//dir1被复制到dir2目录下，不改名
	#cp -r dir1/dir2 dir3/newdir	//dir2被复制到dir3目录下，并改名newdir
	#cp -r dir1/dir2 dir3/dir4/newdir	//dir2被复制到dir4目录下，并改名newdir
	#cp -r dir1 ../../newdir	//dir1被复制到上两级目录下，并改名newdir
  e.删除(目录和文件)remove
	#rm 文件
	#rm -r 目录			//递归方式删除目录
	#rm -rf 文件/目录	//递归强制方式删除文件(force强制，不需要额外提示)
	mv是"移动"和"修改"合并的指令
9.文件操作
  a.查看文件内容
	#cat filename  //打印文件内容到输出终端
	#less filename //通过"上下左右键"方式查看文件的各个部分内容
					//支持回看//q 退出查看
	#more filename //通过敲回车方式逐行查看文件的各个行内容
					//默认从第一行开始查看，不支持回看
					//q 退出查看
	#wc				//查看文件行数
	#head -n		//查看文件前n行内容
	#tail -n		//查看文件后n行内容
  b.创建文件
	#touch filename //在当前目录下创建filename
	#touch dir/filename //在dir目录下创建filename
  c.给文件追加内容
	#echo 内容>filename //把"内容"以覆盖写方式追加给fliename
						//如果文件不存在会创建文件
	#echo 内容>>filename //把文件以追加的形式写给filename
						//如果文件不存在会创建文件
10.用户操作
  配置文件:/etc/passwd
  a.创建user add
	#useradd xiaoming
	  xiaoming:x:508:502::/home/xiaoming:/bin/bash
		x:密码
		508:用户编号,类似于主键，每添加一个用户就会增加一
		502:组别编号
		/home/xiaoming:家目录
		/bin/bash:用户登录系统执行的shell脚步
	#useradd -g 组别编号 username //把用户的组别设置好，避免创建同名的组出来
	#useradd -g 组别编号 -u 用户编号 -d 家目录路径 username
  b.修改user modify
	#usermod -g 组编号 -u用户编号 -d 家目录 -l 新名字 username
	修改家目录时 需要手动创建
  c.删除user delete
	#userdel username //删除用户
	#userdel -r username //删除用户以及家目录
  d.给用户设置密码，使其登录系统
	#passwd 用户名
11.组别操作
  配置文件:/etc/group
  a.创建group add
	#groupadd music
	#groupadd movie
	#groupadd php
	#cat /etc/group  //查看组别编号
  b.修改group modify
	#groupmod -g 新编号 -n 新名字 groupname
  c.删除group delete
	#groupdel groupname 
	如果组别下面有用户，不能删除
12.查看指令可设置的参数
  #man 指令
13.给文件设置权限
  #chmod u+rwx filename //给filename的主人增加读、写、执行的权限
  #chmod g-rx filename  //给filename的同组用户删除读、执行的权限
  #chmod u+wx,g+rx,o-w filename
  #chmod u+w,u-x filename
  #chmod +rwx filename  //无视组别，统一给全部的组设置权限
  #chmod 753 filename  //主人读写执行，同组读执行，其他写执行
文件主人、组别的设置：change owner
  drwxr-xr-x. 2 gao family 4096 8月 21 10:32 gao
  #ll  //查看文件信息，可以查看文件的主人、同组、其他用户的权限信息
  #chown 主人 filename
  #chown 主人.组别 filename
  #chown .组别 filename
  #chown -R 主人.组别 dir  //通过递归方式设置目录的属组信息
  #chown -R 765 dir			////通过递归方式设置目录的权限
权限操作：
  drwxr-xr-x. 2 jinnan jiannan 4096 8月 21 10:32 tianjin
  权限本身划分为：读Read、写Write、执行Execute
  权限针对用户的划分：主人User、同组用户Group、其他组用户Other
  数字绝对方式设置权限：
		r:4   w:2  x:1
		0:没有权限
		1：执行
		2：写 
		3：写、执行
		4：读
		5：读、执行
		6：读、写
		7：读、写、执行
权限的使用:
  文件：
	读:是否可以查看文件内容
	写:是否可以修改文件
	执行:二进制文件和批量指令执行文件(shell脚本)
	执行脚本程序：./out.sh  
	(前面不加./会在系统中找指令，因为找不到，所以会报错)
  目录：
	读：是否可以查看该目录内部的文件信息
	写：是否可以给该目录创建、删除文件
	执行：指定用户是否可以cd进入目录
强制操作：
  对文件没有r或w权限，还要修改该文件，可以！感叹号强制写保存
	1.对文件有w权限，没有r权限，强制写保存，新写入内容会覆盖文件原内容
	2.对文件没有w权限，可以强制写保存
	3.非主人用户，没有w写权限，强制写保存有时候成功，有时候不成功。
	  该文件的上级目录针对该修改者没有开放w权限，强行写保存不成功
	  该文件的上级目录针对该修改者有开放w权限，强行写保存成功
14.在文件中查找内容
  grep 被搜索内容 文件
  #grep hello passwd   //在passwd文件中查找包含Hello内容
						//会把hello所在行的内容都打印到终端
15.查看活跃进程
  #ps -A
16.终止指定进程号的进程
  #kill -9 pid
17.查看文件占用磁盘空间大小(不等于文件大小)
  #du -h filename
  磁盘格式化时一般最小的一个单位空间是4k，和磁盘格式有关
18.给系统设置时间
  #date -s "2017-01-11 10:26:30"
19.查看系统时间
  #date
20.查看系统磁盘分区情况
  #df -lh
21.查看系统当月的日历
  #cal
22.查看可用内存
  #free
管道：pipe
  变量修饰器/管道：前者的输出是后者的输入参数
  linux的管道与smarty的变量修饰器的使用效果是一致的
  输出的信息与预期信息不符合，需要通过中间介质(其他函数)对信息再进一步处理、过滤、优化
  {$time | upper}
  linux系统中许多指令(grep head ls)
  #grep hello passwd | wc  //在passwd文件中查找包含Hello的内容
							//然后再在结果里统计文件数
  #ls -l | grep out  //查看目录信息，然后再在结果里筛选包含out文件的记录
  #ls -l | head -5
  #ls -l | head -10 | tail -5 //查看前十个，然后再在结果里显示最后5个
  #grep hello passwd | grep word //查找hello ,然后再在结果里查找word
文件查找：find
  find 查找目录 选项1 选项值1 选项2 选项值2 ...
  1.-name选项 根据名字进行查找
  #find / -name passwd  //遍历根目录/及其内部深层目录，寻找名称等于passwd文件
  #find ./ -name "h*"   //在当前文件中查找以h开头的文件名，模糊查找
  #find ./ -name "*hh*"
  2.限制查找的目录层次 
  -maxdepth  限制查找的最深目录
  -mindepth  限制查找的最浅目录
  #find / -name passwd -maxdepth 4 -mindepth 3
  3.根据大小为条件进行文件查找
  -size +/-数字 +表示大于数字  -表示小于数字
  大小单位：
    -size 5 //单位是512字节 5*512字节
	-size 10c  //单位是字节  10字节
	-size 3k   //单位是千字节 3*1024字节
	-size 6M  //单位是1024千字节  6兆字节
  4.-group -gname
  5.-user -uname
  6.-perm
  7.-type (f文件/d目录)
任务调度指令设置：规定系统在指定的时间完成指定的任务过程
  设置：
    #crontab -e  //编辑任务调度指令
	#crontab -l  //查看任务调度指令
  制作一个shell脚本，名称为out.sh：
    #！/bin/bash
	cd /
	ls -l > /home/jiannan/result.txt
  设置任务指令设置：
    #crontab -e   //进入任务调度指令编辑界面
	#分钟 小时 日期 月份 星期 被执行的指令
	22    11   11    4    2   /home/jiannan/out.sh  //4月11号星期2的11:22分运行out.sh
	43    21   *     *    *   /home/jiannan/out.sh  //每天的21:43运行out.sh
	0     17   *     *    1
	38    6    1     *    *
	0     21   *     *    1-6
	2     8-20/3  *  *     *
    30    5    1,15  *     *	
网络配置:
  #cd /etc/sysconfig/network-script
  #vi ifcfg-eth0
  DEVICE=eth0
  ONBOOT=yes
  BOOTPROTO=static
  IPADDR=192.168.0.6
  NETMASK=255.255.255.0
  #service netwrok restart  //重启网络服务
  #ifconfig
  本机可以Ping通linux，但是Linux不能ping通本机，关闭防火墙
软件安装：
  #ls | grep ftp    //当前目录下查找ftp软件
  #rpm -ivh 软件包全名  //安装软件
  #rpm -q 软件包名      //查看软件是否有安装
  #rpm -e 软件包名      //卸载软件
  #rpm -qa              //查看系统里全部rpm方式安装的软件
  #rpm -qa | grep ftpd  //模糊查找指定软件是否有安装
  #yum install httpd    //安装软件
  #yum remove httpd
  #yum list | grep ftp  //列出包含ftp的软件
  #service vsftpd start   //启动软件
  #ps -A | grep ftp    //查看ftp相关服务进程
ftp优化：
  1.ftp服务可以在配置文件里边做设置,使得用户是否可以登陆ftp
    以下2个文件对用户进行限制:
    /etc/vsftpd/user_list
    /etc/vsftpd/ftpusers
    打开以上文件，根据需要配置允许访问的用户,前面加#。更改后重启ftp服务。
  2.限制普通用户只访问自己的家目录
    #vim vsftpd.conf
      97，99行去掉#
    把需要访问自己家目录的信息配置到文件chroot_list中即可
    #touch chroot_list
      User1
      User2
  3.客户端安装winscp软件，首次访问服务器会提示失败，这需要关闭selinux
    #vi /etc/selinx/config   //把selinux=enforcing改为disable
	#reboot
  4.防火墙配置添加端口,或者直接关闭防火墙
    #service iptables stop
重定向：
  #ls -l /usr/bin > output.txt   //覆盖
  #ls -l /usr/bin >> output.txt  //追加
配置让系统以命令行模式启动：
  #vim /etc/inittab
  修改：id:5:initdefault--->id:3:initdefault---
  #reboot
VIM编辑器(记事本):
  三种模式：命令(默认)、编辑、尾行
  命令模式：
	a.光标移动
		字符级：
			上k下j左h右l键：字符级移动，一个字符一个字符移动
		单词级：
			w:word 移动到下一个单词的首字母
			e:end 移动到下一个单词的尾字母
			b:before移动到上一个单词的首字母(包括本单词)
		行级：
			$:行尾
			0:行首
		段落级：
			{：上个段落首部
			}：下个段落尾部
		屏幕级(不翻屏)：
			H:屏幕首部
			L:屏幕尾部
		文档级:
			G：文档尾部
			1G：文档第1 行
			nG:文档第n行
	b.内容删除
		dd:		//删除光标当前行
		2dd:	//包括当前行在内，向后删除2行内容
		ndd:	//包括当前行在内，向后删除n行内容
		x:		//删除光标所在字符
		cw:		//从光标所在位置删除至单词结尾，并进入编辑模式
	c.内容复制
		yy:		//复制光标当前行
		2yy:	//包括当前行在内，向后删除2行内容
		nyy:	//包括当前行在内，向后删除n行内容
		p:		//对复制好的内容进行粘贴操作
	d.相关快捷操作
		u:		//undo撤销
		J：		//合并上下两行
		r:		//单个字符替换
  命令模式--->编辑模式切换:
	a	//光标向后移动一位
	i   //光标和所在字符不发生仍和变化
	o	//新起一行
	s	//删除光标所在字符
	按esc:退出编辑模式，返回到命令模式
  命令模式--->尾行模式切换:
	:
	/
	按esc:返回命令模式,比较慢
	按2次esc:返回命令模式,比较快
	:q		//quit
	:w 		//write
	:wq		//write quit退出并保存
	:q!		//强制退出编辑器
	:w!		//强制保存
	:wq!	//强制保存并退出
	:set number  //设置行号
	:nu		//设置行号
	:set nonumber  //取消行号
	:nonu		//取消行号
	:/内容/ 	//查找指定内容，按n查找下一个，按N查找上一个
	/内容		//查找指定内容
	:数字		//跳转到数字所在行
	:s/cont1/cont2 //找到cont1替换为cont2
					//替换光标所在行的第一个cont1
					//按u撤销替换
	:s/cont1/cont2/g 	//替换光标所在行的所有cont1
	:%s/cont1/cont2/g 	//替换文档内所有cont1

*/
?>