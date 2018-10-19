public class Test{
	public static void main(String[] args){
		//max min
		int i,min,max;
		int A[] = {56,28,36,82,22};
		min=max=A[0];
		System.out.println("array A has:");
		for(i=0;i<A.length;i++){
			System.out.println("  A["+i+"]="+A[i]);
			if(A[i]>max){
				max = A[i];
			}
			if(A[i]<min){
				min = A[i];
			}
		}
		System.out.println("max="+max);
		System.out.println("min="+min);
	}
}