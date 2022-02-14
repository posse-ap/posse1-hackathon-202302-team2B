# 環境構築手順

1. `git clone git@github.com:posse-ap/hackathon-202202-sample.git`

2. `cd hackathon-202202-sample`

3. `cp ./src/.env.dev ./src/.env`

3. `docker-compose build --pull`

4. `docker-compose up -d`

5. `docker-compose exec php bash`

6. `cd ichiichiban`

7. `composer install`

8. `php artisan migrate:refresh --seed`

9. `npm install`

10. `npm run dev`

11. Please try to access `http://localhost:80`

```
※CSSについて
 src/resources/sassにSASSファイルが入っています
 修正した場合は`npm run dev`を再実行することで
 src/public/css/app.css に出力され、画面に反映されます
``` 

```
※npm installについて
　　完了までに結構時間がかかります
 環境構築を実行しながら実装の作戦会議などしたほうがよいかも！？
```
