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

module.exports = alphaSwap