function stars(n) {
	if(n >= 1 && n<= 30) {
		var result = []
		for (var i = 1; i <= n; i++) {
				result.push('*'.repeat(i))
		}
		return result
	}
}

module.exports = stars;