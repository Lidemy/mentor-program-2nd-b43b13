資料庫名稱：comments

| 欄位名稱 | 欄位型態 | 說明 |
|----------|----------|------|
|  id  |    integer      | 留言 id   |
| content   | text | 留言內容 |
| user_id   | integer | 使用者id |
| time   | timestamp | 留言時間 |
| parent_id   | integer | 自己設0為父留言，1為子留言 |


資料庫名稱：users

| 欄位名稱 | 欄位型態 | 說明 |
|----------|----------|------|
|  id  |    integer      | 使用者id   |
| username   | varchar | 使用者帳號 |
| password   | varchar | 使用者密碼 |
| nickname   | varchar | 使用者暱稱 |
