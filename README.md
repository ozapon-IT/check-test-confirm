# お問い合わせフォーム&管理者画面

## 環境構築

### Dockerビルド

1. `git clone git@github.com:ozapon-IT/check-test.git`
2. `docker-compose up -d --build`

\* MySQLとphpMyAdminは、OSによって起動しない場合があるのでそれぞれのPCに合わせて `docker-compose.yml` ファイルを編集してください。

### Laravel環境構築

1. `docker-compose exec php bash`
2. `composer install`
3. `.env.example` ファイルから `.env` を作成し、環境変数を変更
4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan db:seed`

---

## 使用技術

- PHP 7.4.9  
- Laravel 8.83.27  
- MySQL 8.0.39  

---

## ER図
![check-test:ER図](https://github.com/user-attachments/assets/eeb79df6-f21d-4bd5-9ca5-57dc43621ed9)

---

## URL

- 開発環境 : [http://localhost](http://localhost)  
- phpMyAdmin : [http://localhost:8080](http://localhost:8080)
