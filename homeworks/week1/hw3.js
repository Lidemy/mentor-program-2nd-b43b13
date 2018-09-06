function reverse(str) {
	var result=''
	for (var i = str.length-1; i >= 0; i--) {
		result += str[i]
	}
	console.log(result)

}

reverse('yoyoyo') //oyoyoy
reverse('1abc2') //2bca1
reverse('1,2,3,2,1') //1,2,3,2,1