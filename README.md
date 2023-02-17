# 環境構築手順

以下のコマンドを実行し、http://localhost:80 にアクセスできると正常に動作しています。

1. `git clone git@github.com:posse-ap/hackathon-202202-sample.git`

2. `cd hackathon-202202-sample`

3. `make init`

windowsの場合は、makeのインストールが必要です。以下の記事を参考に導入してみてください。

[Windowsのmakeコマンドの設定方法](https://zenn.dev/genki86web/articles/6e61c167fbe926)

また、makeに興味の湧いた人は以下の記事を読んでみたり、Makefileの中身を見てみたりしましょう。便利なコマンドが入っているかもしれません。

[Makefileとは](https://linuc.org/study/knowledge/542/#:~:text=%E3%80%8CMakefile%E3%80%8D%E3%81%AF%E3%80%81%E3%82%B3%E3%83%B3%E3%83%91%E3%82%A4%E3%83%AB%E3%80%81,%E9%96%A2%E4%BF%82%E3%82%92%E8%A8%98%E8%BF%B0%E3%81%97%E3%81%BE%E3%81%99%E3%80%82)

もし、makeの設定がうまくいかない場合やコマンドの実行でエラーが起きてしまう場合は、以下の手順を実行してみてください。

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
