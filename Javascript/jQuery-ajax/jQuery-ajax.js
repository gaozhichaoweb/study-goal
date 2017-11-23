/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 标题：ThinkPHP框架处理jQuery.js的ajax请求
 * 

ajax:
    type:类型，"POST"或"GET"，默认为"GET"
    url;发送请求的地址
    data:是一个对象，连同请求发送到服务器的数据
    dataType:预期服务器返回的数据类型
        如果不指定，jQuery将自动根据HTTP包MIME信息来只能判断，一般我们采用json格式，可以设置为"json"
    success:是一个方法，请求成功后的回调函数。传入返回后的数据，以及包含成功代码的字符串
    error:是一个方法，请求失败时调用此函数。传入XMLHttpRequerst对象   
前端页面：Public/ajaxPage.html
    1、引入jQuery.js
        <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    2、GET请求JS代码片段
        <script>
            $(document).ready(function(){
                $("#username").blur(function(){
                    var $username = $("#username").val();
                    //alert($username);
                    if($username == ""){
                        alert("用户名不能为空");
                    }
                    $.ajax({
                        type:"GET",
                        url:"{:U('Public/ajaxR')}",
                        dataType:"json",
                        data:{"username":$("#username").val()},
                        success:function(res){
                            //console.log(res);
                            //res返回的是一个对象，内容是PHP页面传递过来的Json格式的数据
                            //Object {status: 1, msg: "用户已存在，请重新输入用户名"}
                            if(res.status == 1){
                                $("#msg").html(res.msg);
                            }else{
                                $("#msg").html(res.msg);
                            } 
                        },
                        error:function(jqXHR){
                            alert("发生错误:"+jqXHR.status);
                        }
                    });
                });
            });
        </script>
    3、HTML代码
        <form action="" method="POST">
            <input type="text" name="username" id="username"><span id="msg">输入用户名</span>
            <br />
            <input type="submit" value="提交">
        </form>  
后台页面：PublicController.class.php
    //显示页面
    public function ajaxPage(){
        $this->display();
    }
    //处理ajax请求
    public function ajaxR(){
        if(IS_AJAX){
            $name = I('get.username');
            if(empty($name)){
                $this->ajaxReturn(array(
                    'status'=> 0,
                    'msg' =>"用户名不能为空"
                ));
            }
            if($name == "gao"){
                $this->ajaxReturn(array(
                    'status'=> 1,
                    'msg' =>"用户已存在，请重新输入用户名"
                ));
            }else{
                $this->ajaxReturn(array(
                    'status'=> 0,
                    'msg' =>"该用户名可以使用"
                ));
            }
        }else{
            return false;
        }
    }
POST请求：
    $(document).ready(function(){
        $("#search").click(function(){
            $.ajax({
                type:"POST",
                url:"service.php",
                dataType:"json",
                data:{
                    name:$("#staffName").val(),
                    number:$("#staffNumber").val(),
                    sex:$("#staffSex").val(),
                    job:$("#staffJob").val(),
                },
                success:function(data){
                    if(data.success){
                        $("#creatResult").html(data.msg);
                    }else{
                        $("#creatResult").html("出现错误："+data.msg);
                    }
                },
                error:function(jqXHR){
                    alert("发生错误:"+jqXHR.status);
                }
            })
        });
    });

*/
