面試考題實做
===
## Install

db新增一個demo database

至專案web資料夾

複製.env.example檔案另取名為.env

.env檔案中修改:

APP_URL為專案URL路徑

DB_HOST為測試DB IP 位址

執行以下命令:
```
php artisan key:generate //產生專案APP_KEY
```
```
composer install //安裝 php套件
```
```
php artisan migrate:fresh --seed //建立TABLE及測試資料
```


## test account
超級管理員:
admin@gmail.com / 12345678

QA:
testqa@gmail.com / 12345678

RD:
testrd@gmail.com / 12345678

PM:
testpm@gmail.com / 12345678