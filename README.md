# mogitate

## 環境構築

### Dockerビルド
1.リポジトリをclone

git clone git@github.com:coachtech-material/mogitate.git
# または
git clone https://github.com/coachtech-material/mogitate.git


2.Docker起動

docker compose up -d --build

*MYSQLは、OSによって起動しない場合があります。
エラーが発生する場合は、docker-compose.ymlの「mysql」設定に以下を追記してください:
mysql:
    platform: linux/amd64


### Laravel環境構築
1. docker compose exec php bash
2. composer install
3. 「.env.example」ファイルを「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加。
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5.アプリケーションキーの作成
php artisan key:generate


6.マイグレーションの実行
php artisan migrate


7.シーディングの実行
php artisan db:seed


## 使用技術（実行環境）
- PHP8.3.0
- Laravel8.83.27
- MySQL8.0.26

## ER図
![ER図](docs/er.png)

> ※ ER図の編集用ファイルは [docs/er.drawio](docs/er.drawio) にあります。


## URL
- 開発環境: http://localhost/
- phpMyAdmin: http://localhost:8080/