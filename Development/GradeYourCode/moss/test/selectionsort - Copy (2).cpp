#include<conio.h>
#include<iostream>
using namespace std;

int main()
{
	int arr[10]={8,4,5,6,7,1,2,3,6,5};
  int j,k,temp,ind;
  
  
	for(int i=0;i<10;i++)
	  cout<<" "<<arr[i];
//int k,ind;	
  for(int i=0;i<10;i++)
  {
   k=arr[i];
	for(int j=i;j<10;j++ )  			
	  {
	  if(k>arr[j])
	  {
	  	k=arr[j];
	  	ind=j;
	  }
	  
	  	
	  }
	  int t=arr[i];
	  arr[i]=k;
	  arr[ind]=t;
	  			
	
  }
  
  cout<<endl;
	for(int i=0;i<10;i++)
	  cout<<" "<<arr[i];
	getch();
	return 0;
}
