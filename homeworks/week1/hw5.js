function join(arr, concatStr) {
	var result = ''
	for (var i = 0; i < arr.length; i++) {
		if (i < arr.length-1 ) {
			result += arr[i] + concatStr
		}
		else {
			result += arr[i]
		}
	}
	return result
}

console.log(join(["a", "b", "c"], "!")) //a!b!c


function repeat(str, times) {
	var result = ''
	for (var i = 1; i <= times; i++) {
		result += str
	}
	return result
}

console.log(repeat('a', 5)) // aaaaa
