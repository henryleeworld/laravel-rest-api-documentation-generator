# Laravel 6 具象狀態傳輸應用程式介面文件產生器

透過程式碼中的註解來生成 API 文件，對現有程式碼可以做到無侵入性。

## 使用方式
- 把整個專案複製一份到你的電腦裡，這裡指的「內容」不是只有檔案，而是指所有整個專案的歷史紀錄、分支、標籤等內容都會複製一份下來。
```sh
$ git clone
```
- 將 __.env.example__ 檔案重新命名成 __.env__，如果應用程式金鑰沒有被設定的話，你的使用者 sessions 和其他加密的資料都是不安全的！
- 當你的專案中已經有 composer.lock，可以直接執行指令以讓 Composer 安裝 composer.lock 中指定的套件及版本。
```sh
$ composer install
```
- 產⽣ Laravel 要使用的一組 32 字元長度的隨機字串 APP_KEY 並存在 .env 內。
```sh
$ php artisan key:generate
```
- 執行 __Artisan__ 指令的 __migrate__ 來執行所有未完成的遷移。Passport 服務提供者在框架中已註冊好本身的資料庫遷移目錄，所以你應該在遷移資料庫之後註冊這個提供者。Passport 的遷移檔會建立應用程式需要儲存客戶端與 Access Token 的資料表。
```sh
$ php artisan migrate
```
- 執行 __Artisan__ 指令的 __passport:install__ 會建立用來產生安全 Access Token 的加密金鑰。此外，該指令會建立用於產生 Access Token 的「個人存取」與「密碼授權」的客戶端。
```sh
$ php artisan passport:install
```
- 給上對應的註解關鍵字，有修改註解都要下指令產生文件。

| 註解關鍵字     | 用意                                                                              |
| -------------- | :-------------------------------------------------------------------------------- |
| @group         | 幫 API 分組                                                                       |
| @bodyParam     | 請求時須提供的資料，名稱、生日（選填）、顏色...                                   |
| @queryParam    | 請求時可附加的參數 排序、篩選...(/api/animals?sort=name:asc) 問候後面的那些參數   |
| @authenticated | 該是否需要身份驗證                                                                |
| @response      | 返回回應相關                                                                      |
| @responseFile  |  如果響應資料太多可以用此關鍵字載入 json 檔案                                     |
- 使用 __Artisan__ 指令的 __apidoc:generate__ 產生 API 文件。
```sh
$ php artisan apidoc:generate
```
- 在瀏覽器中輸入已定義的路由 URL 來訪問，例如：http://127.0.0.1:8000。
- 你可以經由 `/api/register` 來進行註冊使用者；經由 `/api/login` 來進行使用者登入；只能在開發環境經由 `/docs/` 來進行 API 文件瀏覽。

----

## 畫面截圖
![](https://i.imgur.com/oYpAiNh.png)
> 看到左邊的 general 分類就是目前專案內的所有 API
