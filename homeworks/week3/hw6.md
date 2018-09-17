## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
1.`<input>`：用來寫輸入小框
	<input type="text" name="">

2.`<table>`：用來寫表格的  
	<table>
		<tr>
			<th></th>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>

3.`<select>`：用來寫下拉列表
	<select>
		<option></option>
		<option></option>
		<option></option>
	</select>

## 請問什麼是盒模型（box modal）
CSS將所有元素當作一個矩形盒子，`padding`是用來改變內邊距，`border` 用來改變邊框，以及`margin`改變外邊距。利用這些去改變元素的大小，排版。

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
`inline`：行內元素，元素跟元素之間會並在同一行，不會換行。不能設寬高，margin 跟 padding 都只能調整左右，上下不能改變。
`block`：元素跟元素不管前後是什麼，就是會換行，可以設寬高，margin跟padding上下左右都可以調整。
`inline-block`：對元素本身呈現 block 屬性可以設寬高以及改變 margin,padding 上下左右，對外呈現 inline，可以跟別的元素並排。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
static:預設值，按照個元素原有的規則下去排列
relative:相對定位，“相對原本static下移動元素”，並且不會影響其他元素
absolute:絕對定位，“相對於它的父元素進行定位”，若上層沒有可以被定位的元素，就會一直再往上找，若都沒有就會相對整個頁面做定位。移動捲軸時，元素還是會隨著頁面捲動
fixed:固定定位，“相對於瀏覽器視窗來定位”，當頁面捲動時它還是會固定在相同的位置

