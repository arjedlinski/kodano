#!/bin/bash

cd .docker

echo "Stopping existing Docker containers..."
docker-compose down

echo "Starting Docker containers..."
docker-compose up -d

if [ $? -ne 0 ]; then
  echo "Error starting Docker containers. Exiting..."
  exit 1
fi

cd ..

echo "Running Composer install..."
docker exec -it kodano-php-1 composer install

if [ $? -ne 0 ]; then
  echo "Error running Composer install. Exiting..."
  exit 1
fi

echo "Waiting for database..."
sleep 30

echo "Migrations..."
docker exec -it kodano-php-1 php bin/console doctrine:migrations:migrate --no-interaction

echo "Loading fixtures..."
docker exec -it kodano-php-1 php bin/console doctrine:fixtures:load --no-interaction


if [ $? -ne 0 ]; then
  echo "Error loading fixtures. Exiting..."
  exit 1
fi

echo "Docker containers started, Composer dependencies installed, and fixtures loaded successfully!"