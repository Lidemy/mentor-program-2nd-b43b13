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

module.exports = isPalindromes