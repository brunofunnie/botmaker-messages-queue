# Botmaker Whatsapp Message Queue
This service uses Botmaker API to send whatsapp messages through a Queue

# Requirements
- PHP 8.x
- Composer 2.x
- Docker

# Setup

Clone this repo, then:

```bash
cd lumen && composer install && cp .env.example .env
```

Now run the docker container:

```bash
cd .. && docker-composer up
```

Now let's browse to the RabbitMQ dashboard at address http://127.0.0.1:15672 and check if you have the following configuration setup:

## Exchange
Name: whatsapp.direct
Type: Direct
Durability: Durable

## Queues
Name: validation-token.whatsapp
Durability: Durable
Arguments:
	x-message-ttl = 10000

### Remember to bind the exchange to the Queue

# Commands

To consume the RabbitMQ queue
```bash
php artisan rabbitmq:consume
```

To send a message token to the queue
```bash
php artisan whatsapp:sendToken
```