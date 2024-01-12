#!/bin/bash
# Variables de connexion à la base de données
set -o allexport
source ./.env
echo 'Remplir les tables de données'
# Copier le fichier SQL dans le conteneur
docker cp ./script/start/02_init.sql db_mysql:/docker-entrypoint-initdb.d/2.sql

# Exécution des fichiers SQL de création
docker exec -it db_mysql bash -c "mysql -u $DB_USER -p$DB_PASSWORD $DB_NAME < /docker-entrypoint-initdb.d/2.sql"
