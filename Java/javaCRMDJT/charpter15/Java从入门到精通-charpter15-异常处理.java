java从入门到精通p272
第15章：异常处理
	15.1 异常的基本概念
		常见异常：
			算术异常ArithmeticException
			指针异常NullPorinterException--没有给对象开辟内存空间
			找不到文件异常FileNotFoundException
		try{
			//要检查的程序语句
		}catch(异常类 对象名称){
			//异常发生时的处理语句
		}finally{
			//一定会运行到的程序代码
		}
	15.2 异常类的继承架构
		异常可分为两大类：java.lang.Exception类与java.lang.Error类
		这两个类均继承自java.lang.Throwable类
		Error类专门用来处理严重影响程序运行的错误，但是开发者无法给予适当的 处理
		Exception类包含了一般性异常，捕捉后可以妥善处理
	15.3 抛出异常
		使用throw关键字
		throw new ArithmeticException("一个算数异常");
	15.4 编写自己的异常类	
		
		
		
		