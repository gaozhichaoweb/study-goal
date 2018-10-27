public class TestObjectArray {
	public static void main(String[] args) {
		Person p[] = {
				new Person("zhangsan",22),
				new Person("lisi",33),
				new Person("wangwu",55)
				};
		for(int i=0;i<p.length;i++) {
			System.out.println(p[i].talk());
		}
	}
}