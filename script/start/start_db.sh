#!/bin/bash

# Variables de connexion à la base de données
set -o allexport
source ./.env
echo 'Creation des tables sans contenu'
# Commandes SQL pour réinitialiser la base de données
SQL_COMMANDS="DROP DATABASE IF EXISTS $DB_NAME; CREATE DATABASE $DB_NAME;"
# Copier le fichier SQL dans le conteneur
docker cp ./script/start/01_create.sql db_mysql:/docker-entrypoint-initdb.d/1.sql
# Connexion au container et exécution des commandes SQL
docker exec -it db_mysql bash -c "mysql -u $DB_USER -p$DB_PASSWORD -e \"$SQL_COMMANDS\""

# Exécution des fichiers SQL de création
docker exec -it db_mysql bash -c "mysql -u $DB_USER -p$DB_PASSWORD $DB_NAME < /docker-entrypoint-initdb.d/1.sql"
