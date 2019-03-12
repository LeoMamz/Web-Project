 import java.util.*;
 public class T{ 
 public static boolean leap(int a){
 boolean f;
 if(a%4==0&&a%100!=0||a%400==0)
 f=true;
 else
 f=false;
 return(f);
 }
 public static void main(String args[]){ 
    int a,b,n,m;
 boolean f;
 Scanner in=new Scanner(System.in);
 n=in.nextInt();
 for(int i=1;i<=n;i++){
 a=in.nextInt();
 b=in.nextInt();
 f=Leaf(a);
 int arr1[]={31,28,31,30,31,**,**,**,**,31,30,31};
 int arr2[]={31,29,31,30,31,**,**,**,**,31,30,31};
 if(f){
 m=arr2[b-1];
 System.out.println(m);}
 else{m=arr1[b-1];
 System.out.println(m);
 }
 }
 }
