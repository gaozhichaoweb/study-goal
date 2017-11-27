<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

composer安装以及通过composer安装laravel
1.Windows系统环境下安装composer工具
安装composer需要具有PHP环境，可以使用phpstudy工具。
在网站https：//getcomposer.org下载Composer-Setup.exe
直接双击安装
注意安装选项：
    Shell Menus:Install Shell Menus
    选择php.exe目录
环境变量中添加composer的命令目录
    计算机---->右键----->属性----->高级系统设置----->系统属性----->高级----->环境变量
        ----->系统变量------>Path----->编辑----->变量值文本框的最后添加;C:\ProgramData\ComposerSetup\bin
    注意前后添加分号
如果下载的是Composer-Setup.exe，安装完成后，系统已经添加了环境变量
2、通过cmd命令窗口进入到项目的跟目录
    窗口+R
    cmd
    C:\Users\Administrator>
    C:\Users\Administrator>d:  //输入项目所在的盘符
    D;\>cd phpStudy/WWW/laravel52
    D;\phpStudy\WWW/laravel52>composer              
3、组件安装
    在项目更目录下创建一个名为composer.json的文件，在该文件中记录所需要的组件名及版本，格式如下
    {
        "name": "companyName/projectName",
        "require":{
            "monolog/monolog":"1.0.*"
        }
    }
    name标签表示本项目的名称，不是必需的，除非你想将自己的项目作为一个资源包发布，使得其他人可以下载这个组件。
    require标签表示需要的资源包。
    D;\phpStudy\WWW/laravel52>composer install
    composer会检查composer.json文件中的组件名称及版本，将它下载到当前目录的vendor文件夹下。
    在完成组件的下载后，会在当前目录下创建一个名为composer.lock的锁文件，该文件将记录当前项目依赖组件的确切版本号。
    当执行“composer install”命令时会首先查看该文件中的版本，如果存在则下载该文件中指定的版本。
    这点对于分布式开发非常有用，不同开发人员只需要上传composer.lock文件到版本库，其他人通过该文件就可以下载相同版本的组件，实现程序版本的统一。
    如果组件有了更新的版本，需要更新组件，可以通过输入“composer update”命令实现
4、composer命令行简介
    composer list               获取帮助信息
    composer install            从当前目录读取composer.json文件，处理依赖关系，并安装到vendor目录下
    composer update             获取依赖的最新版本，升级composer.lock文件
    composer require            添加新的依赖包到composer.json文件中并执行更新
    composer search             在当前项目中搜索依赖包
    composer show               列举所有可用的依赖包
    composer self-update        将composer工具更新到最新版本
    composer create-project     基于composer创建一个新的项目
5、安装laravel
    直接在服务器更目录下运行下面代码：
        D;\phpStudy\WWW>composer create-project --prefer-dist laravel/laravel laravel52 "5.2.*"
    在浏览器输入如下代码访问项目：
        http://localhost/laravel51/Public/
6、版本说明：
    5.1.*安装的是5.1.33
    5.2.*安装的是5.2.31