## 請說明 SQL Injection 的攻擊原理以及防範方法

SQL Injection 攻擊原理
利用操作資料庫時，sql 指令內的字串串接方式讓攻擊者有漏洞可以輸入故意輸入假的字串如 `or 1=1`，
竄改原本我們自己下的 sql 指令。造成使用者密碼可以被盜。
例如
`$sql = “select * from u where user=’’ or 1=1 --’’ and pwd=’’”`
也等於`$sql = “select * from u where user=’’ or 1=1”`


防範方式：
1. 採用參數化（Parameterized）查詢語法
`$stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $lastname, $email);`

使用者輸入的資料透過參數的方式傳遞，而不會直接結合SQL查詢語法，以避免惡意使用者有機會植入攻擊性字串。

2. 明確劃分資料庫使用者權限，避免一般使用者有機會執行權限外的動作。
3. 加強對用戶輸入資料的檢核與驗證

參考資料
http://www.gss.com.tw/images/stories/epaper_GSS_security/pdf/epaper_gss_security_0051.pdf


## 請說明 XSS 的攻擊原理以及防範方法

XSS 攻擊原理
攻擊者利用自己輸入的資料和 HTML, CSS或JavaScript語法組成，那麼呈現的時候，這些資料就可能變成『可執行的語法』，進而可能導致其他使用者在瀏覽網頁時，被這樣注入的惡意程式碼所影響，如果在網頁開發時沒有作特別處理的話，瀏覽器會將這段文字當作網頁內容，進而影響資料庫甚至程式碼。

如有可能：
盜用 cookie ，獲取敏感資訊。
利用植入 Flash ，透過 crossdomain 許可權設定進一步獲取更高許可權；或者利用Java等得到類似的操作。
利用 iframe、frame、XMLHttpRequest或上述Flash等方式，以（被攻擊）使用者的身份執行一些管理動作，或執行一些一般的如發微博、加好友、發私信等操作。
利用可被攻擊的域受到其他域信任的特點，以受信任來源的身份請求一些平時不允許的操作，如進行不當的投票活動。
在存取量極大的一些頁面上的XSS可以攻擊一些小型網站，實作DDoS攻擊的效果。



XSS防範方法
 htmlspecialchars() 做轉換處理使用者輸入的資料。htmlspecialchars() 會將 & " ' < > 等符號轉換為 html 實體，例如 < 轉換成 &lt;，而使瀏覽器將該筆資料作為文字資料顯示，而不會當作網頁程式碼。



## 請說明 CSRF 的攻擊原理以及防範方法


Cross Site Request Forgery 跨站請求偽造，又稱作 one-click attack，偽造 user 身分並發送 request 給 server。

CSRF 攻擊原理
利用瀏覽器在向網站發出 request 時，會將同網域的 cookie 一併送出的特性，來偽造使用者身分。 以使用者登入 A 網頁為例，A 網頁的伺服器在使用者登入時，會將認證資訊留存在 cookie 中，而在使用者未主動登出或是網頁設定時限未到之前，該 cookie 都算是合法認證。如果使用者在此時被誘導瀏覽或點擊了惡意使用者置入帶有向 A 網頁發出 request 的網頁時，因為瀏覽器有將 A 網頁設置的 cookie 資料一併送出，而讓 A 網頁誤以為該 request 是使用者發出的，而達到偽造使用者請求的目的。


CSRF 防範方法

1. 檢查 request 的 domain (request 的 header 裡面的 referer 從哪來)
2. 在 HTTP Request 中加入惡意使用者無法偽造的資訊，例如：簡訊驗證碼、圖形驗證碼、CSRF Token(只有 user 知道，駭客不知道的資訊)等。
3. 在設定 cookie 時，加上 SameSite 參數，可防止cookie 隨著跨站的 Request 發送。不過目前並非所有的瀏覽器都支援 SameSite 參數，Chrome 51、Firefox 59、Opera 39 以上的瀏覽器已支援參數。


## 請舉出三種不同的雜湊函數
MD5、SHA-256、bcrypt


## 請去查什麼是 Session，以及 Session 跟 Cookie 的差別


Session 負責紀錄在 web server 上的使用者訊息。Session 機制會在一個用戶完成身分認證後，存下所需的用戶資料，接著產生一組對應的 id，存入 cookie 後傳回用戶端。而這個 id 要是獨特的，所以會使用 uuid 的機制，重複的機率非常非常低。因此當下次用戶端發送請求時，如果帶有該 id 資訊，web server 就會認為該請求是來自該名使用者，達到驗證用戶的目的。

cookie 和 session 都是為了補強 HTTP stateless 特性，暫存資訊的文本文件。差別在於 Session 會儲存在 server 端，client 端會儲存 session id(唯一)，透過 session id 及資料庫中的來比對是否正確。而 Cookie 會 儲存在 client 端，因此有可能被修改，常用來儲存 user 輸入的資料(帳號，資料欄位等)，有生命期限，只對本來的 domain 有效。



## `include`、`require`、`include_once`、`require_once` 的差別

require 與 include 都是用來引入外部檔案，差別在於如果引入時發生錯誤時會有不同反應。

require : 引入檔案錯誤時會中斷程式執行，並丟出錯誤(E_COMPILE_ERROR)
include : 用途與 require 相同，但通常用在判斷句中，引入檔案錯誤時不會中斷程式的執行，而只是拋出警告(E_WARNING)並回傳false
_once : 會先檢查是否已有引入此檔案，確保不重複引入。