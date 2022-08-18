# Instructions
run docker-compose up -d
docker-compose exec db bash
mysql -u root -p
GRANT ALL ON db_test.* TO 'testuser'@'%' IDENTIFIED BY '12345678';
FLUSH PRIVILEGES;
EXIT;
exit