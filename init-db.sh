set -e
sleep 10
echo "Importando o arquivo db.sql..."
mysql -u root -p"$MYSQL_ROOT_PASSWORD" $MYSQL_DATABASE < /docker-entrypoint-initdb.d/db.sql
exec docker-entrypoint.sh mysqld
