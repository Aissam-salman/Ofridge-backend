# Ofridge API for symfony

- nginx
- php
- symfony
- mysql
- phpmyadmin

```bash
docker compose up --build
# for the first run , before
docker compose up -d
#or
docker compose up #to see logs
```

- app
`http://localhost:8080`

- phpmyadmin
`http://localhost:7070`

- mysql host
`172.18.0.2` port 3306

## script for database mysql
- reset database schema
`./script/reset/reset_db.sh`

- create database with tables
`./script/start/start_db.sh`

- initialize database with data
`./script/start/init_db.sh`