function join(arr, concatStr) {
	var result = ''
	for (var i = 0; i < arr.length; i++) {
		result += arr[i] + concatStr
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
