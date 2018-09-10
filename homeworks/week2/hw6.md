## hw1：好多星星
找出規則當 n 等於多少時，陣列就有 n 個元素，並且第 n 個元素裡有 n 顆星星。

1.規則當n等於多少時，陣列就有n個元素 =>做循環，在每一個循環都加一個星星元素 => `arr.push`

	var result = []
	for (var i = 1; i <= n; i++) {
		result.push('*')
	}

2.第 n 個元素裡有 n 顆星星 ＝> `'*'.repeat(n)`

	var result = []
	for (var i = 1; i <= n; i++) {
		result.push('*'.repeat(i))
	}
  
  
在寫這題時很快就結束了，但是我在剛開始練習 [JS101] 練習題時對 push 卡很久，之前對於 push 的觀念沒有很完整了解，所以還是來打個心得，
那時候在上面步驟１.中間那邊會一直犯傻寫成 `result = result.push('*')` ， console.log出來後會顯示 result.push() is not a function，
後來百思不得其解就去 MDN 查 arr.push() 的定義：
  
  
> push():
> The push() method adds one or more elements to the end of an array and returns the new length of the array.
  
	var arr1 = [‘a’, ‘b’, ‘c’];
	var arr2 = [‘d’, ‘e’, ‘f’];
	var arr3 = arr1.push(arr2);
	console.log(arr3); // 4
	console.log(arr1); // [“a”, “b”, “c”, [“d”, “e”, “f”]]
  
  
重點是後面 “returns the new length of the array” 之前沒注意到， 寫了`result.push('*')` 後，result 後面會加元素進去，並且回傳
新的長度，所以此時`console.log(result.push('*'))`出來自己會是個數字，`console.log(result)` 出來後面就會是多了一個元素的陣列。
所以並不能寫`result = result.push('*')`。寫成`result = result.push('*')`這個的意思會是 result 在第一圈`[].push('*')`的時候
會變成１，(因為回傳了增加了一顆星後的長度為１)，在第二圈的時候就會變成 `1.push('*')` ，此時就不成立，因為 push()前面一定要是陣列，才算是
內建函示，此時已經變成 數字.push()，所以會出錯，輸出會顯示result.push()不是一個函式（result.push() is not a function。)
  

## hw2：大小寫互換
做循環去找每一個元素，如果找到第i個字母是小寫字母，就把它取代大寫字母toUpperCase()，反之找到大寫就換小寫。
做的時候發現有兩種寫法：

1.直接用 str.replace(要改的數,改成啥) 去代替原本的字母

	function alphaSwap(str) {
		for (var i = 0; i < str.length; i++) {
			if (str[i] >= 'a' && str[i] <= 'z')  {
				str = str.replace(str[i], str[i].toUpperCase())
			}
			else {
				str = str.replace(str[i], str[i].toLowerCase())
			}
		}
		return str
	}

2.先把答案儲存下來空字串，循環去加每一個轉換過的字母

	function alphaSwap(str) {
		var result = ''
		for (var i = 0; i < str.length; i++) {
			if (str[i] >= 'a' && str[i] <= 'z')  {
				result += str[i].toUpperCase()
			} else {
				result += str[i].toLowerCase()
			}
		}
		return result
	}
  

## hw3：判斷質數
印象中這一題在 [JS101] 裡的練習題也有，但我寫完回去比對後看發現寫法不一樣，兩種好像都行。

1.解題思路：n 除以 (除了1以外小於 n 的正整數)，每一個都除一遍(迴圈)，從2開始直到 n-1，如果一有找到整除的就表示不是質數(return false)。
反之，沒找到的話就返回 true ，另外加上特殊的1不是質數。

	function isPrime(n) {
		if (n >= 1 && n <= 100000) {
			if( n == 1) {
				return false
			}
			for (var i = 2; i < n; i++) {
				if (n % i == 0) {
					return false
				}
			}
			return true
		}  	
	}

2.解題思路：找有幾個數可以被整除，如果有找到(>0)有可以被整除的數＝>不是質數(false); 沒有找到可以被整除的數＝>是質數(true)。

	function isPrime(n) {
		var result = 0
		if (n == 1) {
			return false
		}
		for (var i = 2; i < n; i++) {
			if ( n % i == 0) {  //有可以被整除的數
				result = result + 1  
			}
		}
		if (result == 0) return true
		if (result > 0)  return false
	}



## hw4：判斷迴文
看到這題直接就聯想到做過的題目返過來印。原本陣列的索引值是遞增，要反過來的話就利用遞減迴圈，將原本陣列裡面的元素排列反過來。
接著返過來的 str 如果跟原本長得一模一樣就是迴文了。

1.先反過來

	function isPalindromes(str) {
		var result = ''
		for (var i = str.length-1; i >= 0; i--) {
			result += str[i]
		}
	}

２.如果一樣就返回 true ， 否則就返回 false 

	function isPalindromes(str) {
		var result = ''
		for (var i = str.length-1; i >= 0; i--) {
			result += str[i]
		}
	  if (result == str) {
	  	return true
	  }
	  return false
	}
	

## hw5：大數加法
前面幾題一下就解決了，這一題卡超久..卡了一個週末..最後終於在週日晚上睡前解出來。

解題思路:小時候做加法. 

1.先將陣列反過來(因為相加從個位數），若位數不同，較少位數的要補零，利用`陣列.push('0')`補零上去
			
	var arra = a.split('').reverse()
	var arrb = b.split('').reverse()

	//將比較少的位數後面補零，補長度差幾位數就補幾個零
	if (arra.length > arrb.length) {
		for (var i = 0; i < (a.length-b.length); i++) {
			arrb.push('0')
		}
	}
	if (arrb.length > arra.length) {
		for (var i = 0; i < (b.length-a.length); i++) {
			arra.push('0')
		}
	}	

2.相加

	var result = []
	for (var i = 0; i < arra .length; i++) {
		result.push(parseInt(arra[i]) + parseInt(arrb[i]))
	}

3.進位 (我在這裡卡超級久)  
原本以為我很快地就寫好，後來用 npm run test 也通過，後來自己亂加了幾個 case 再測卻不通過，因為會有
進位的問題，我卡在進位的時候因為自己做直式加法直接進位，再加，再進位，再加..，完全不知道要怎麼用程式語
言表達，後來自己試試上下全部加完後，再全部一次一起進位也是相同答案 ＝> 所以想到進位要用迴圈 => 後卡住
因為那時候沒有把數字轉為陣列，後面就無法不知道怎做了。=>後來試試先把字串轉為陣列，得到新的陣列(第一次加
完的所有數字)＝>去做進位，留下於數，下一個數字加一。

	//將相加完後做進位
	for (var i = 0; i < arra .length; i++) {
		result[i] = result[i]
	 	if (result[i] >= 10) {
			result[i] = result[i] % 10
			result[i+1] = result[i+1] +1
		}
	}

4.反轉回來正確的個位數在右邊

	result = result.reverse()

5.陣列轉字串
	
	//將正確的元素轉為字串
	var answer =''
	for (var i = 0; i < arra.length; i++) {
		answer += result[i]
	}
	return answer

好像沒太多的心得，一切都是慢慢試，慢慢推出來的，遇到卡住的地方就在那裡加console.log印出來看看，一發現不對就修正。
最大的心得就是“關鍵真的是把自己當成電腦一行一行已電腦的思維去思考”。







