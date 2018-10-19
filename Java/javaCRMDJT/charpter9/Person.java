public class Person {
	String name;
	int age;
	public Person()
	{
		
	}
	public Person(String name,int age)
	{
		this.name = name;
		this.age = age;
	}
	public String talk()
	{
		return "我是:"+this.name+" 年龄:"+this.age;
	}
}