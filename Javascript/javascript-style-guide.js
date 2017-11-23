/*
1.类型types
	原始值：存取直接作用于它自身
		string
		number
		boolean
		null
		undefined		
			var foo=1;
			var bar=foo;
			bar=9;
			console.log(foo,bar);//=>1,9		
	复杂类型：存取时作用于它自身值的引用
		object
		array
		function
			var foo=[1,2];
			var bar=foo;
			bar[0]=9;
			console.log(foo,bar);//=>1,9
2.对象objects
	使用直接量创建对象
		//bad
		var item=new Object();
		//good
		var item={};
	不要使用保留字作为键名，它们在IE8下不工作
		//bad
		var superman={
			default:{clark:‘kent’},
			private:ture;
		};
		//good
		var superman={
			default:{clark:‘kent’},
			hidden:ture;
		};
	使用同义词替换需要使用的保留字
		//bad
		var superman={
			class:'alien'
		};
		//bad
		var superman={
			klass:'alien'
		};
		//good
		var superman={
			type:'alien'
		};
3.数组arrays
	使用直接量创建数组
		//bad
		var items=new Array();
		//good
		var items=[];
	向数组增加元素时使用Array#push来替代直接赋值
		var someStack=[];
		//bad
		someStack[someStack.length]='abcdefghi';
		//good
		someStack.push('abcdefghi');
	当你需要拷贝数组时，使用Array#slice.
		var len=items.length;
		var itemsCopy=[];
		var i;
		//bad
		for(i=0;i<len;i++){
			itemsCopy[i]=items[i];
		}
		//good
		itemsCopy=items.slice();
	使用Array#slice将类数组对象转换成数组
		function trigger(){
			var args=Array.prototype.slice.call(arguments);
		}
4.字符串strings
	使用单引号‘’包裹字符串
		//bad
		var name=“bob parr";
		//good
		var name='bob parr';
		//bad
		var fullName="bob"+this.lastName;
		//good
		var fullName=‘bob’+this.lastName;
	超过100个字符的字符串应该使用链接字符写成多行。
	注：若过度使用，通过连接符连接的长字符串可能会影响性能。
		//bad
		var errorMessage='this is a super long error that was thrown because of batman.when you stip to think';
		var errorMessage='this is a super long error that was thrown\
		because of batman.\
		when you stip to think';
		//good
		errorMessage='this is a super long error that was thrown'+
		'because of batman.'+
		'when you stip to think';
	程序化生成的字符串使用Array#join连接而不是使用连接符。尤其是IE下；
		var items；
		var messages;
		var length;
		var i;
		
		messages=[{
			state:'success',
			message:'this one worked'
		},{
			state:'success',
			message:'this one worked as well'
		},{
			state:'error',
			message:'this one did not work'
		}];
		legnth=messages.length;
		//bad
		function inbox(messages){
			items='<ul>';
			for(i=0;i<length;i++){
				items+='<li>'+messages[i].message+'</li>';
			}
			return items+'</ul>';
		}
		//good
		function inbox(messages){
			items=[];
			for(i=0;i<length;i++){
				items[i]='<li>'+messages[i].message+'</li>';
			}
			return '<ul>'+items.join('')+'</ul>';
		}
5.函数functions
	函数表达式
		//匿名函数表达式
		var anonymous=function(){
			return true;
		}
		//命名函数表达式
		var named=function named(){
			return true;
		}
		//立即调用的函数表达式（IIFE）
		(function(){
			console.log('welcome to the internet');
		}());
	永远不要在一个非函数代码块(if、while等)中声明一个函数，把那个函数赋给一个变狼。浏览器允许你这么做，但它们的解析表现不一致。
	注：ECMA-262把块定义为一组语句。函数声明不是语句。
	//bad
	if(currentUser){
		function test(){
			console.log('Nope');
		}
	}
	//good
	var test;
	if(currentUser){
		test=function test(){
			console.log('Yup');
		};
	}
	永远不要把参数命名为arguments。这将取代函数作用域内的arguments对象。
		// bad
		function nope(name, options, arguments) {
			// ...stuff...
		}

		// good
		function yup(name, options, args) {
			// ...stuff...
		}
	
6.属性properties
	使用.来访问对象的属性。
		var luke={
			jedi:ture;
			age:28
		};
		//bad
		var isJedi=luke['jedi'];
		//good
		var isJedi=luke.jedi;
	当通过变量访问属性时，使用中括号[]
		var luke={
			jedi:ture;
			age:28
		};
		function getProp(prop){
			return luke[prop];
		}
		var isJedi=getProp('jedi');
7.变量varibles
	总是使用var来声明变量。不这么做将导致产生全局变量。我们要避免污染全局命名空间。
		//bad
		superPower=new SuperPower();
		//good
		var superPower=new SuperPower();
	使用var声明每一个变量。这样做的好处是增加新变量将变得更加容易，而且你永远不用再担心调换错;跟，。
		//good
		var items=getItems();
		var	goSportsTeam=ture;
		var	dr='z';
	最后再声明未赋值的变量，当你需要引用前面的变量赋值时这将变的很有用。
		var items=getItems();
		var	goSportsTeam=ture;
		var	dragonball;
		var i;
	在作用域顶部声明变量。这将帮助你避免变量声明提升相关的问题。	
8.提升hoisting
	变量声明会提升至作用域顶部，但赋值不会。
	匿名函数表达式会提升它们的变量名，但不会提升函数的赋值。
	命名函数表达式会提升函数名，但不会提升函数名或函数体。
	函数声明提升它们的名字和函数体。
		function example() {
			superPower(); // => Flying

			function superPower() {
				console.log('Flying');
			}
		}
9.比较预算法&等号comparison-operators-equality
	优先使用===和！==而不是==和！=
	条件表达式例如if语句通过抽象方法ToBoolean强制计算它们的表达式并且总是遵守下面的规则。
		对象被计算为true
		undefined被计算为false
		Null被计算为false
		布尔值被计算为布尔值
		数字如果是+0、-0或NaN被计算为false,负责为true
		字符串如果是空字符串‘’被计算为false,负责为true
			if([0]){
				//true
				//一个数组就是一个对象，对象被计算为true
			}
	使用快捷方式
	//bad
	if(name!==''){
		//stuff
	}
	//good
	if(name){
		//stuff
	}
	//bad
	if(collection.length>0){
		//stuff
	}
	//good
	if(collection.length){
		//stuff
	}
10.块blocks
	使用大括号包裹所有的多行代码块
		if(test){
			return false;
		}
		function(){
			return false;
		}
	如果通过if和else使用多行代码块，把else放在if代码块关闭括号的同一行
		if(test){
			thing1();
		}else{
			thing2();
		}
11.注释comments
	使用/+*..*+/作为多行注释,包含描述、指定所有参数和返回值得类型和值
	使用//作为单行注释，在评论对象上面另起一行使用单行注释。在注释钱插入空行
		// good
		// is current tab
		var active = true;
		
		// good
		function getType() {
			console.log('fetching type...');

			// set the default type to 'no type'
			var type = this.type || 'no type';

			return type;
		}
	使用FIXME或TODO的前缀可以帮助其他开发者快速了解这是一个需要复查的问题
		//FIXME:shouldn`t use a global here
		//TODO:total should be configurable by an options param
12.空白whitespace
	使用2个空格作为缩进
	在大括号前方一个空格
	function test() {
		
	}
	在控制语句(if、while等)的小括号前放一个空格。在函数调用及声明中，不在函数参数列表前加空格。
	使用空格把运算符隔开。
		var x = y + 5;
	在文件末尾插入一个空行
	在使用长方法链时进行缩进。使用前面的点.强调这是方法调用而不是新语句
		$('items')
			.find('selected')
				.highlight()
				.end()
			.find('open')
				.updateCount();
	在块末和新语句前插入空行。
13.逗号commas
	行首逗号：不需要  
	额外的行末逗号：不需要
		var story=[
			once,
			upon,
			aTime
		];
14.分号semicolons
	使用分号
		//good
		(function() {
			var name='sky';
			return name;
		})();
		//good (防止函数在两个IIFE合并时被当成一个参数)
		;(function() {
			var name='sky';
			return name;
		})();
15.类型转化type-casting-coercion
	在语句开始时执行类型转换
	使用parseInt转换数字时总是带上类型转换的基数；
		var inputValue='4';
		//bad
		var val=new Number(inputValue);
		//bad
		var val=+inputValue;
		//bad
		var val=parseInt(inputValue);
		//good
		var val=Number(inputValue);
		//good
		var val=parseInt(inputValue,10);
	布尔：
		var age=0;
		//bad
		var hasAge=new Boolean(age);
		//good
		var hasAge=Boolean(age);
		//good
		var hasAge=!!age;
		
16.命名规则naming-conventions
	避免单字母命名，命名应具备描述下
	使用驼峰式命名对象、函数和实例
	使用帕卡斯式命名构造函数或类
		//bad
		function user(){
			this.namme=options.name;
		}
		//good
		function User(){
			this.namme=options.name;
		}
		var good=new User(){
			name:'hip';
		}
	不要使用下划线前/后缀,javascript没有私有属性或方法的概念
		//bad
		this._firstName_='';
		//good
		this.firstName='';
	不要保存this的应用，使用Function#bind
		//bad
		function(){
			var self=this;
			return function(){
				console.log(self);
			};
		}
		//good
		function() {
			return function() {
				console.log(this);
			}.bind(this);
		}
	给函数命名，这在做堆栈轨迹时很有帮助
		//bad 
		var log=function(msg) {
			console.log(msg);
		};
		//good
		var log=function log(msg) {
			console.log(msg);
		}
	
17.存取器accessors
	属性的存取函数不是必须的
	如果你需要存取函数时使用getVal()和setVal('hello'),便于理解函数的用途
	如果属性时布尔值，使用isVal()或hasVal()	
18.事件events
	当给事件附加数据时，传入一个哈希而不是原始值。这样可以让后面的贡献者增加更
	多数据到事件数据而无需找出并更新事件的每一个处理器。
		//bad
		$(this).trigger('listingUpdated','listing.id');
		//good
		$(this).trigger('listingUpdated',{listingId:listing.id});



*/