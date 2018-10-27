 package crmdjt;
public class TestEquals {
		public static void main(String[] args){
			String str1 = new String("java");
			String str2 = new String("java");
			String str3 = str2;
			if(str1 == str2){
				System.out.println("str1 == str2");
			}else{
				System.out.println("str1 != str2");
			}
			if(str1.equals(str2)){
				System.out.println("str1 equals str2");
			}else{
				System.out.println("str1 not equals str2");
			}
			//str1 != str2
			//str1 equals str2
			
			if(str2 == str3){
				System.out.println("str2 == str3");
			}else{
				System.out.println("str2 != str3");
			}
			if(str2.equals(str3)){
				System.out.println("str2 equals str3");
			}else{
				System.out.println("str2 not equals str3");
			}
			//str2 == str3
			//str2 equals str3
		}
}