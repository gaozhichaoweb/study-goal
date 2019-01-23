第十四章 类型信息
	13.1 不可变的String
		String对象是不可变的，
	13.2 重载"+"与StringBuilder
		"+"字符串连接时，编译器创建了一个StringBuilder对象，用于构造最终的String，
		并为每个字符串调用一次StringBuilder的append()方法，最后调用toString()生成结果
		StringBuilder是Java SE5引入的，之前Java用的是StringBuffer，后者是线程安全的
			包含append()、toString()、insert()、repleace()、substring()、reverse()方法
	13.4 String上的 操作
		length()charAt()getChars()getBytes()toCharArray()equals()compareTo)()contains()concat()replace()trim()等等
	13.5 格式化输出
		printf()、System.out.format()
		Formatter类
		Formatter转换
		String.format()
	13.6 正则表达式
		基础
			System.out.println("-1234".matches("-?\\d+"));
		