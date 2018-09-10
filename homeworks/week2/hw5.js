function add(a, b) {
	
	var arra = a.split('').reverse() //轉換為陣列並反轉因為要從個位數加
	var arrb = b.split('').reverse() //轉換為陣列並反轉因為要從個位數加
	var result = []
	var answer =''
	
	if (a.length>=1 && a.length<=1000 && b.length>=1 && b.length<=1000 ) {

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

		//將a,b上下相加從個位數相加
		for (var i = 0; i < arra .length; i++) {
			result.push(parseInt(arra[i]) + parseInt(arrb[i]))
		}

		//將相加完後做進位
		for (var i = 0; i < arra .length; i++) {
			result[i] = result[i]
		 	if (result[i] >= 10) {
				result[i] = result[i] % 10
				result[i+1] = result[i+1] +1
			}
		}

		//相加完後反轉回來正確的位置
		result = result.reverse()

		//將正確的元素轉為字串
		for (var i = 0; i < arra.length; i++) {
			answer += result[i]
		}
		return answer
	}
}

module.exports = add;

