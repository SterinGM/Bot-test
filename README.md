# BOT Test App
### Deploy
Используется PHP 7.4, PostgreSQL 12. 
Для развертывания проекта требуется docker и docker-compose на хостовой машине. По умолчанию nginx слушает на `8111` порту, postgres слашуает на `5444` порту, при желании можно поменять порты в файле .env: `NGINX_PORT`, `PG_PORT`. Шаши по развертыванияю:
1. В корне проекта выполнить 
```shell script
docker-compose up --build -d
```
2. Пакеты:
```shell script
docker exec vigrom-php composer install
```
3. Создание базы:
```shell script
docker exec -it bot-test-postgres createdb bot_test -U docker
```
4. Миграции:
```shell script
docker exec -it bot-test-postgres psql -U docker -d bot_test -f /var/www/Bot-test/dump.sql
```

Если надо, то можно удалить БД и создать все заного:
```shell script
docker exec -it bot-test-postgres dropdb bot_test -U docker
```


### Использование
* Проект доступен по адресу `http://localhost:8111/`.
* Для авторизации в системе есть 2 пользователя:

```shell script
Login: user1, Password: pass
Login: user2, Password: pass
```