#!/usr/bin/env bash

mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS market_new;
        GRANT ALL PRIVILEGES ON \`market_new%\`.* TO '$MYSQL_USER'@'%';

        CREATE DATABASE IF NOT EXISTS market_old;
        GRANT ALL PRIVILEGES ON \`market_old%\`.* TO '$MYSQL_USER'@'%';
EOSQL
