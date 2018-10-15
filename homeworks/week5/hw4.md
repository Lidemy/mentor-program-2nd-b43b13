## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
VARCHAR：可以設定長度
TEXT：不能設定限制長度



## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又會以什麼形式帶去 Server？

Cookie 是什麼？
HTTP 本身 無狀態 (Stateless) 的特性，Cookie 是其中一種保存狀態的機制，	主要用途是要在網路上識別瀏覽者的身份，讓 Server 端能夠追蹤使用者。
會顯示在 HTTP Response, Request 中的 Cookie 那行，和 Client 端瀏覽器上的 Cookie 檔 以及 server資料庫。


在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又會以什麼形式帶去 Server？

1.Server 在收到 Request 之後，會建立索引編號在資料庫中作為記錄，以及 response 給 Browser "Set-Cookie" HTTP Header。
2.Client 端接收到 Set-Cookie 指令時，會將 Cookie 的名稱與值儲存在 Browser 的 Cookie 存放區，並記錄該 Cookie 隸屬的網域、網址路徑、過期時間、是否為安全連線。

<!-- 參考資料： https://blog.miniasp.com/post/2008/02/22/Explain-HTTP-Cookie-in-Detail.aspx -->



## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？

1.會員密碼可以在資料庫顯示，會被管理資料庫的人看光光
2.由於在HTTP請求中的Cookie是明文傳遞的，所以安全性成問題，除非用HTTPS
3.入侵者可以在輸入框竄改程式碼



