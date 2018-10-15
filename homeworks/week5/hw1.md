資料庫名稱：comments

| 欄位名稱 | 欄位型態 | 說明 |
|----------|----------|------|
|  id  |    integer      | 留言 id   |
| content   | text | 留言內容 |
| nickname   | text | 暱稱 |
| time   | timestamp | 留言時間 |


資料庫名稱：child_comments

| 欄位名稱 | 欄位型態 | 說明 |
|----------|----------|------|
|  id  |    integer      | 子留言 id   |
| parent_id   | integer | 父留言 id |
| content   | text | 留言內容 |
| nickname   | text | 暱稱 |
| time   | Datetime | 留言時間 |
