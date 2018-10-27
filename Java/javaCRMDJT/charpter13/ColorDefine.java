//test9_2
public class ColorDefine{
	String color = "black";
	void getMes(){
		System.out.println("getMes");
	}
	public static void main(String[] args){
		ColorDefine c =new ColorDefine();
		System.out.println(c.color);
		c.getMes();
	}
}