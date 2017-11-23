/*
Javascript:用来在页面中编写特效，和HTML、CSS一样都是有浏览器解析

Javascript语言：
	一、JS如何运行（javascript,jscript,vbscript,applet...）
	
	二、输出
		alert(什么类型都可以)；可以做调试用
		document.write("字符串")；
		
	三、如何在HTML文档中使用JS
		使用<script></script>将js语法嵌入到html中，可以使用多个，每一个之间都是有关联的。
		<script src="demo.js"></script>引入外部js文件，多个文件之间是相通的，但是有先后顺序。
		<a href="javascript:alert("111111");"></a>点击A链接时执行Javascirpt程序
		事件:事件触发时运行js
	js语法：
		命名规范：
			1.命名一定要有意义。
			2.不以数字开头的字母、数字、下划线、$符号。
			3.不能是关键字和保留字。
		大小写：javascript严格区分大小写
		驼峰式命名法：变量名和函数，第一个单词小写，以后每个单词首字母大写showColor();
		对象：每个单词首字母都要大写  Data();new Object();
		分号：
			结构定义语句后面不用加分号。if(){}  for(){}  function(){}
			功能执行语句后面加分号。var a=1;如果有回车换行的地方可以省略（因为js认为换行表示语句结束），但是建议都加上分号。
		注释：写注释文档
			//单行
			多行
			
	四、变量
		var a=10;
		注：声明的变量调运后保存在内存里随时使用，只有当关闭浏览器才会释放内存，与别的语言不同。
		
		var 变量名=值；
		注：javascript是弱类型语言（和PHP相同）
		
		var a=10;   声明
		a=10;		赋值	
		
	五、数据类型
		1.number(int float double)包括整形浮点型，计算时还是按整形和浮点型分开看。
		2.string（string char）
		3.boolean
		4.object(object array null)注意：使用时分别处理
		5.undefind没有声明的变量
		
		整数：
			var a=10;十进制
			var a=045;八进制
			var a=0xff;十六进制
		
		浮点型：
			浮点数是近似数，不能用作判断两个浮点数等于（ 0.1=0.0999999999）
			var f=10.5;
			var f=10.55;
			var f=10.5e+10;
		
		字符串
			''
			""
			没有区别，所有的转义都可以使用
			用+号连接字符串
		
	六、运算符和表达式
		算数运算符
			+ - * / % ++ --
			var a=10+5+"12abc"+20  //1512abc20 javascript里所有与字符串运算的都按字符串处理。
			%（最后值的正负与前面值正负一致）求余数的话，最好都是整数，如果有浮点数的话，求出来的值没意义。4%2.7  值为1.29999998
		赋值运算符
			= += -= *= /= %=
		条件运算符
			> < == != >= <= === !==
			两边比较时最好是相同类型，比较完之后值是布尔型
			var a=false;
			if(a){alert("111");}else{alert("000");}
		逻辑运算符
			&& || ！ ^
		位运算符号(C语言里面加密和算法的时候用到)
			>> >>> << | & ~
		其他 ?:
	
	七、流程控制
		顺序结构
		条件结构/分支结构/选择结构
			1.单路分支
				if(boolean){
				}
			2.双路分支
				if(boolean){
				}else{
				}
			3.多路分支
				if(boolean){
				}else if(boolean){
				}
				}else if(boolean){
				}用于范围
				
				switch(变量){   //变量值最好用整形或字符型
					case:值1；
						表达式1；
						break;
					case:值2；
						表达式2；
						break;
					default;
				}单个值匹配
			4.嵌套分支
				if(bool){
					if(bool){
						...
					}
				}
		循环结构
			条件循环(js用的不多)
			var i=0;
			while(i<100){
				document.write("###");
				i++;
			}
			
			do-while()
			计数循环
			st:
			for(var i=1;i<=9;i++){
				for(var j=0;j<=9;j++){
				if(j==5)
					break st; //退出双重循环的办法，输出5例后跳出
					document.write(j+"*"+i+"="+(j*i)+"&nbsp")
				}
				document.write("<br>");
			}
			break退出循环
			continue退出本次循环
	八、函数：是一段完成“指定功能”的已经”命名“的代码段
		函数只用”调用“才能使用到,通过函数名称调用（可以在声明之前，也可以在声明之后）
		function test(obj){  //obj是形参
			功能段
			return 值；//退出函数
		}
		test(x); //x实参
		函数名不加（）时，这个函数名就代表整个函数
		alert(typeof(test));//function
		alert(test);//函数可以看成是变量，弹出test()的函数声明
		var demo=test;
		demo(x);//和test(x)一样的效果
		1.函数名
		2.参数
		3.函数体（功能）
		4.返回值（可选）有返回值才能称之为函数，没有返回值只能称之为过程
		回调函数：函数通过传递变量不能解决问题，通过传递函数来完成
		
	九、对象（首字母大写）
		1.基于对象的操作方式（面向对象主要有三大特性：封装、继承、多态）
		2.将相关的操作使用一个对象完成，看做是一个整体
		
		字符串对象
		数学对象
		数组对象
		时间对象
		
		对象里存的内容：
			1.属性（变量）
			2.方法（函数）
		
		声明对象；
		使用对象；
		使用系统对象；
		
	十、内置JS对象
		重要：
		Array对象
		String对象
			属性：length
			方法：
				bold  把HTML<b>标记放置在对象中的文本两端
					var str1="abc";
					str2=str1.bold();//<b>abc</b>
				charAt 返回指定索引位置处的字符
				replace 返回根据正则表达式进行文字替换后的字符串的复制。
				lastIndexOf 返回string对象中字符串最后出现的位置
				match 使用正则表达式模式对字符串执行查找
				substr 返回一个从指定位置开始的指定长度的子字符串
					var s="acdscdgaefes"；
					var ss=s.substr(2,6);//dscdg
				toString
				toUpperCase 所有字母都转换为大写字母
				toLowerCase 所有字母都转换为小写字母
		Math对象
			属性：E、PI
			方法：
				abs    绝对值
				ceil   返回大于等于其数字参数的最小整数
				floor  返回小于等于其数值参数的最大整数
				random	返回介于0到1的伪随机数
				round	返回与给出的数值表达式最接近的整数。
				max     返回数值表达式中的较大者。
				min		返回数值表达式中的较小者。
				var i=300;
				var x=Math.max(-6,Math.min(6,i));x在正6负6之间
		RegExp对象
		Data对象
		Global对象
		
		了解：
		Boolean对象		
		Function对象				
		Number对象
		Object对象
		
	十一、数组
		Array对象
			数组的作用：只要是批量的数据都需要使用数组声明；
			声明数组：
				1.快速声明
				var arrs=[item1,item2,item3,,,,,,];
				var arrs=[[1,2,3],[4,5,6],[7,8,9]];
				2.使用Array对象
				var arr=new Array("item1","item2","item3");
			属性：length、prototype
			方法：
				concat 连接数组
				join   连接数组元素
				pop		移除数组中最后一个元素并返回改元素
				shift  移除数组中第一个元素并返回改元素
				push	将新元素添加到一个驻足中
				reverse 返回一个元素顺序被反转的数组对象
				slice   返回数组的一段arrayobj.slice(start,end);
				sort	排序
				splice	移除数组中的一个或多个元素
				toString 返回对象的字符串表示objname.toString(进制);
DOM:
	DOM操作：
	
	事件：
		一、事件源：任何一个HTML元素body,div,button,p,a,h1等等
		二、事件：你的操作
			鼠标事件：
				click
				dbclick
				textcontentmenu(在body)文本菜单（鼠标右键事件）
					<body oncontextmenu="return test()">
						<script>
							function test(){
								alert("ok");
								return false;
							}
						</scirpt>
					</body>
				mouseover
				mouseout
				mousedown
				mouseup
				mousemove
			键盘事件：
				keypress 键盘事件  只能获取数字和字母键（不包括功能键、方向键等）
				keyup	所有按键
				keydown 所有按键
			
			文档：
				load 页面加载完之后触发
				unload
				beforeunload 关闭之前
				
			表单：
				submit
				focus
				blur
				change 表单内容改变
				
			其他：
				scroll滚动事件
				selected选择事件
		
		三、事件处理
			三种方法加事件：
				1.标签里加
				<p on事件="事件处理程序"></p>
				2.<script></script>标签里加
				<script>
					对象.on事件=function(){
						事件处理程序
					}
				</script>
				3.不常用
				<script for="事件ID" event="事件">事件处理程序</script>
		
	事件对象：	事件发生时产生的事件对象
		属性：
			1.srcElement  事件源对象，不需要用this一般用this，不过可以用来解决兼容性
			<p onclick="show()">aaaaa</p>
			<script>
				function show(){
					window.srcElement.innerText="aaa";
				}
			</script>
			2.keyCode 事件发生时的键盘码
			<body onkeydown="show()">
				<script>
					function show(){
						alert(event.keyCode);
					}
				</script>
			</body>
			3.clientX,clientY
			4.screenX,screenY
			5.returnValue
			window.event.returnValue=false;
			6.cancelBubble取消冒泡
			<body onclick="one()">
				<img src="images/ren_s_1.png" onclick="two">
				<script>
					function one(){
						alert("body click");
					}
					function two(){
						alert("img click");
						window.event.cancelBubble=ture;  //当出现冒泡事件后，程序执行到这里就不在往下执行。
					}
				</script>
			</body>
				
BOM:浏览器对象模型
	一、浏览器本身就有一些对象，这些对象不用创建就能使用；
		1.window:当前浏览器窗体的
			属性：	
				status
				opener
				closed
			方法：
				alert();
				confirm();  onclick="return confirm("你确认删除吗？");"
				setInterval();
				
					var num=0;	
					var dir=1;
					setInterval(function(){
						if(num>40||num<0){
							dir=-1*dir;
						}
						num+=dir;
						var space="";
						for(var i=0;i<num;i++){
							space+=" "；  //通过添加空格来实现滚动向右显示；
						}
											
						window.status=space+"滚动显示的内容"；
					},100);
					
					
				clearInterval();
				seTimeout();
				clearTimeout();
				open(); window.open("url","windowName","windowFeature");

*/