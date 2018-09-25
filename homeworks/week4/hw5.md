## hw5：簡答題

1. 什麼是 DOM？

當網頁加載時，瀏覽器會創建 DOM 作為 HTML 的编程接口(programming interface)，它會將 HTML document 進行結構化，
組成樹枝狀的物件架構，把 document 中的 tag，看成是一個個節點(node)， 再利用 JavaScript(或其他程式語言) 來操縱節
點，進而達成 JavaScript與網頁的互動。

	
2. 什麼是 Ajax？

主要的功能就是 “不換頁” 就可以跟 Server 溝通，實現非同步更新，相對於
傳統網頁（不使用 AJAX）如果需要更新内容，必需重载整个网页面。


3. HTTP method 有哪幾個？有什麼不一樣？

GET: 從目標資源中取得資料，通常用在檢視資料。
POST: cilent 端新增一項資料，傳送資料到 server ，例如 登入傳送帳號密碼。
PATCH: 在現有的資料欄位中，增加或部分更改一筆資料。
PUT: 已覆蓋的方式資料全部更新
DELETE: 刪除指定的東西
OPTIONS: 看 server 支援哪些method
HEAD: 跟 GET 一樣，response 回傳回來沒有 body，大多用在測試。



4. `GET` 跟 `POST` 有哪些區別，可以試著舉幾個例子嗎？


1.網址差異：
  `GET`:網址會帶有 HTML Form 表單的參數與資料(會自動encode)
  `POST`:資料傳遞時，網址並不會改變
2.資料傳遞量:
  `GET`:是透過 URL 帶資料，所以有長度限制
  `POST`:不透過 URL 帶參數，所以不受限於 URL 長度限制
3.安全性:
  `GET`: 表單參數與填寫內容可在 URL 看到，不安全，不會放敏感資訊，資源通常不會變。
  `POST`: 透過 HTTP Request 方式，所以參數與填寫內容不會顯示於 URL，相較於安全，適合放敏感資訊，無法複製，只能複製到網址，不能複製到資料。


5. 什麼是 RESTful API？


RESTful是一種設計風格，設計規範。
全名：Resource Representational State Transfer 
Resource：資源。
Representational：表現形式，如JSON，XML．．．
State Transfer：狀態變化。即上述講到的可利用HTTP動詞們來做呼叫。


RESTful API ，就是照著 HTTP 協定下不同的 method 去操作資源，相對一般的Web API沒有一定要照著 HTTP 協定的 method 定義敘述建立，若有依照就稱作 Restful API。

簡單的說，就是一個單從發出的 HTTP 要求裡面所包含的資訊，就可以直接預期這要求會收到怎樣類型的資料，讓資源的管理有更好地規範，串接API的人可以很快速地了解你的API，省去不必要的溝通。

<!-- 參考 https://progressbar.tw/posts/53 -->

6. JSON 是什麼？

由陣列以及物件組合而成的純文字資料格式，可以非常簡單的跟其他程式溝通或交換資料

7. JSONP 是什麼？

因為同源政策，照理來說只能拿到同個網域的API，但是 JSONP 可以 利用 `<script>`沒有同源限制，可以跨域的特性拿到資料


8. 要如何存取跨網域的 API？

方法一：JSONP，利用 `<script>`但是有限制，只能用在 get。
方法一: CORS(Cross-Origin Resource Sharing)，Server 必須在 Response 的 Header 裡面加上 Access-Control-Allow-Origin。若後面接的是'＊'星號就代表萬用字元，任何一個 Origin 都接受。
