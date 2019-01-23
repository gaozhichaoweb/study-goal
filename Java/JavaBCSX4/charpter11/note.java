第十一章 持有对象
	Java实用类库还提供李一套相当完整的容器类，其中基本的类型是List、Set、Queue和Map。
	这些对象类型也称为集合类，一般称呼为“容器”Collection
	容器提供李完善的方法来保存对象
	11.1 泛型和类型安全的容器		
		通过十一泛型，可以在编译期防止将错误类型的对象放置到容器中
		ArrayList<User> user = new ArrayList<User>();
		user.add(new User());
		for(User u : user){
			
		}
	11.2 基本概念
		Java容器类类库的用途是“保存对象”，并将其划分为两个不同的概念：
			Collection--一个独立元素的序列
				List必须按照插入的顺序保存元素
				Set不能有重复元素
				Queue按照排队规则来确定对象产生的属性
			Map--一组成对的“键值对”对象，允许使用键来查找值。
				ArrayList允许你使用数字来查找值。
				映射表
	11.3 添加一组元素
		Collection<Integer> collection = new ArrayList<Integer>(Arrays.asList(1,2,3,4,5));
		Integer[] moreInts = {6,7,8,9,10};
		collection.addAll(Arrays.asList(moreInts));
	11.4 容器的打印
		ArrayList和LinkedList都是List类型，按照被插入的顺序保存元素
		HashSet、TreeSet和LinkedHashSet都是Set类型，每个相同的项只保存一次
			HashSet:最快的获取元素方式
			TreeSet：按照比较结果的升序保存对象，存储顺序很重要
			LinkedHashSet：按照被添加的顺序保存对象
		Map可以用键来查找对象，就像一个简单的额数据库，键所关联的对象称为值
			Map.put(key,value)方法将增加一个值
			HashMap:提供来最快的查找即使，没有按照任何明显的顺序来保存其元素
			TreeSet：按照比较结果的升序保存键
			LinkedHashSet：按照被添加的顺序保存键
	11.5 List
		可以将元素维护在特定的序列中
		两种类型的List
			基本的ArrayList：它长于随机访问元素，但是在List的中间插入和 移除元素时较慢
			LinkedList：随机访问相对较慢，它的特性集较ArrayList更大
	11.6 迭代器
		迭代器是一个对象，它的工作是遍历并选择序列中的对象
		Java的Iterator只能单向移动，这个Iterator只能用来：
			使用方法iterator()要求容器返回一个Iterator
			使用next()获得序列中的下一个元素
			使用hasNext()检查序列中是否还有元素
			使用remove()将迭代器新近返回的元素删除
		有了interface就不必为容器中元素的数量操心来，那是由hasNext()和next()关心
		while(it.hasNext()){
			
		}
		Listiterator:是一个更加强大的iterator的子类型，它只能用于各种List类的访问
	11.7 LinkedList
		也像ArrayList一样实现了基本的List接口，它执行(在List的中间插入和移除)时比ArrayList更高效
		但随机访问相对较慢，它的特性集较ArrayList更大
		LinkedList还添加来可以使其用作栈、队列或双端队列的方法
			getFirst()peek()removeFirst()addFirst()removeLast()等方法
	11.8 Stack
		栈通常是指后进先出(LIFO)的容器,有时栈也被称为叠加栈，因为最后“压入”栈的元素，第一个“弹出”栈
		LinkedList具有能够直接实现栈的所有功能的方法，因此可以直接将LinkedList作为栈使用
		public class Stack<T>{
			private LinkedList<T> storage = new LinkedList<T>();
			public void push(T v) {
				storage.addFirst(v);
			}
			public T peek() {
				return storage.getFirst();
			}
		}
		类名之后的<T>告诉编译器这将是ige参数化类型，而其中的类型参数，即在类被使用时将会被实际类型替换的参数，就是T
		大体上，这个类是在声明“我们在定义一个可以持有T类型对象的Stack”
		Stack使用LinkedList实现的，而LinkedList也被告知它将持有T类型对象
	11.9 Set
		Set不保存重复的元素，通常会选择一个HashSet的实现，它专门对快速查找进行了优化
		Set具有与Collection完全一样的接口，只是行为不同
		例子：在0到29之间的1000个随机数被添加到类Set中
			Random rand = new Random(47);
			Set<Integer> intset = new hashSet<Integer>();
			for(int i=0;i<1000;i++){
				intset.add(rand.nextInt(30));
			}
		但是不会出现1000个数，每一个数只有一个实例出现在结果中，而且没有顺序
		如果相对结果排序，使用TreeSet来代替hashSet
	11.10 Map 
		将对象映射到其他对象
	11.11 Queue
		队列是一个典型的先进先出(FIFO)的容器,在并发编程中非常重要
		LinkedList提供来方法以支持队列的行为，并且它实现来Queue接口。
		例：
			Queue<Integer> queue = new LinkedList<Integer>();
			Random rand = new Random(47);
			for(int i=0;i<10;i++){
				queue.offer(rand.nextInt(i+10));
			}
		PriorityQueue
			当你在PriorityQueue上调用offer()方法来插入一个对象时，这个对象会在队列中被排序
	11.12 Collection和Iterator
		Collection时描述所有序列容器的共性的根接口
	总结：
		数组将数字与对象联系起来，它保存类型明确的对象，数组一旦生成，其容量就不能改变
		如果要进行大量的随机访问，就使用ArrayList，如果要经常从表中间插入或删除元素，则应该使用LinkedList。
		各种Queue以及栈的行为，由LinkedList提供支持
		Map是一中将对象与对象相关联的设计，HashMap设计用来快速访问，而TreeMap保持“键”始终处于排序状态，所有慢
		LinkedHashMap保持元素插入的顺序，但是也通过散列提供快速访问能力
		Set不接受重复元素，HashSet提供最快的查询速度，而TreeSet保持元素处于排序状态
		LinkedHashSet以插入顺序保存元素
		简单的容器分类，其实只有四中容器：Map、List、Set和Queue