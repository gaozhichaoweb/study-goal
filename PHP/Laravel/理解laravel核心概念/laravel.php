<?php

1、Service Container 服务容器
    通常也叫做IOC Container
    反射机制
    依赖注入
    Route::get('/',function (Foo $foo){
        dd($foo);
    });
    class Foo {
        public $bar;
        public function __construct(Bar $bar){
            $this->bar = $bar
        }
    }
    class Bar {

    }
    laravel会一层一层的实例化类：
        $foo = new Foo();
        $bar = new Bar();
2、Service Providers 服务提供者
    Service Providers
        Route::get('/',function (){
            dd($app('files')->get(__DIR__.'Kernel.php'));
        });
    把自己的类注册到Service Providers
        创建自己的类
            app/Billing/Stripe.php
            namespace App\Billing;
            class Stripe {
                public function charge(){
                    dd('charged');
                }
            }
        创建providers
            app/Providers/BillingServiceProvider.php
            namespace App\Providers;
            user Illuminate\Support\ServiceProvider;
            class BillingServiceProvider extends ServiceProvider{
                public function boot(){}
                public function register(){
                    $this->app->bind('billing',function(){
                        return new Stripe();
                    })
                }
            }
        config/app.php
            App\Providers\BillingServiceProvider::class，
        使用billiing
            例如：routes.php
                Route::get('/',function(){
                    $billing = app('billinig');
                    dd($billing->charge());
                })
3、Facades 门面
    config/app.php  
        'Route'=>Illuminate\Support\Facades\Route::class,
    查看Facades类
        abstract class Facades{}
    通过facades类，我们才可以直接使用下面的代码
    Route::get()
    Mail::send()
4、contract的概念:契约
    面向接口编程
5、container的背后
    Route::get('/',function(){
       dd(Hash::make('password'));
       dd(app('hash')->make('password'));
       dd(app()['hash']->make('password'));
       dd(app('Illuminate\Hashing\BcryptHasher')->make('password'));
    });        
    查看HashingServiceProvider

