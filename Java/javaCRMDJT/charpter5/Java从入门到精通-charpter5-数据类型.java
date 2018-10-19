java从入门到精通
第5章：数据类型
	Java的数据类型可分为基本数据类型和引用数据类型两大类
		基本数据类型--数值型
					----整数类型(byte short int long)
					----浮点类型(float double)
					--字符型(char)
					--布尔型(boolean)
		引用数据类型--类(class)
					--接口(interface)
					--数组(array)
	本章介绍基本数据类型和数据类型的转换
	5.1 整数类型
		在Java中规定了8中基本数据类型变量来存储整数、浮点、字符和布尔值
		不同的数据类型有不同的数据范围
		1字节=8位(1byte = 8bit)
		1个单词2个字节
		5.1.1 byte类型
			占用一个字节(8位 )空间，数据范围-128~127
			byte byte_max = Byte.MAX_VALUE; //得到Byte类型的最大值
		5.1.2 short类型
			占用2个字节空间，数据范围-32768~32767
			short short_max = Short.MAX_VALUE;
		5.1.3 int类型
			int类型数据占据4个字节内存空间，取值范围-2147483648~2147483647
			int int_max = java.lang.Integer.MAX_VALUE;
		5.1.4 long类型
			int类型数据占据8个字节内存空间，取值范围
			long long_max = java.lang.Long.MAX_VALUE;
	5.2 浮点类型
		浮点数据类型主要有双精度double和单精度float两个类型
		double:共8个字节，64位，第1位为符号位，中间11为表示指数，最后52为表示尾数
			double num=6.3e64
		float:共4个字节，32位，第1位为符号位，中间8位表示指数，最后23位表示尾数
			float num=3.0f;
			float max_float = java.lang.Float.MAX_VALUE;
	5.3 字符类型
		字符类型在内存中占用2个字节
		char a='a';
		char b=97;
		char c='\"'; //转义字符，打印时显示"
	5.4 布尔类型
		只有true和false两种值。
		boolean status = true;
	5.5 数据类型的转换
		Java有严格的数据类型限制，数据类型是不可以轻易转换的
		5.5.1 自动类型转换
			以下两个条件都成立时，自动进行数据类型转换：
				转换前的数据类型与转换后的类型兼容
				转换后的数据类型的表示范围比转换前的类型大
			字符与整数，整数与浮点数
		5.5.2 强制类型转换
			int a=55;
			int b=99;
			float h;
			h=(float)a/b;
	5.6 基本数据类型的默认值
		若在变量的声明时没有赋值，则会给该变量赋默认值
		
		
		
		
		
		
		
		
		
		
		
		
		
		