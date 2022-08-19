# Instructions
docker-compose -f "docker-compose.yml" up -d

docker exec -i mysql mysql -p12345678 < db_test.sql

--- Windows ---
docker run --rm --interactive --tty --volume ${PWD}:/app composer install
--- Linux ---
docker run --rm --interactive --tty --volume $PWD:/app composer install