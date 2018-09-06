function capitalize(str) {
	var result = ''
	for (var i = 0; i < str.length; i++) {
		
		if (i == 0) {
			result = result + str[i].toUpperCase()
		}
		if (i > 0) {
			result = result + str[i]
		}

	}
	return result
	
}

console.log(capitalize('nick'))