# 環境構築手順

1. `git clone git@github.com:posse-ap/hackathon-202202-sample.git`

2. `cd hackathon-202202-sample`

3. `cp ./src/.env.dev ./src/.env`

3. `docker-compose build --pull`

4. `docker-compose up -d`

5. `docker-compose exec php bash`

6. `cd ichiichiban`

7. `composer install`

7. `php artisan mmigrate:refresh --seed`

8. Please try to access `http://localhost:80`
