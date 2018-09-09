function add(a, b) {
	
	var arra = a.split('').reverse()
	var arrb = b.split('').reverse()
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
	//console.log(arra,arrb)
	var answer =''
	var result = []
	for (var i = 0; i < arra .length; i++) {
		result.push(parseInt(arra[i]) + parseInt(arrb[i]))
	}
	//console.log(result)
	for (var i = 0; i < arra .length; i++) {
		result[i] = result[i]
	 	if (result[i] >= 10) {
			result[i] = result[i] % 10
			result[i+1] = result[i+1] +1
		}
		//console.log(result)	
	}
	//console.log(result)
	result = result.reverse()
//	console.log(result)
	for (var i = 0; i < arra.length; i++) {
		answer += result[i]
	}
	//console.log(answer)
	return answer
}

module.exports = add;

