# Project TinyGram

Tinygram is a cutting-edge social media platform 😊 that brings the world of visual storytelling to life. Developed using the power of Laravel 10 🤗

<p align="center">
<img src="https://i.ibb.co/b1wwxxc/tinygram.png" width="100" alt="tinygram logo" title="TinyGram Logo">
</p>

## Run Locally

Clone the project

```bash
  git clone https://github.com/developersharif/tinygram.git
```

Go to the project directory

```bash
  cd tinygram
```

Install dependencies

```bash
  composer install
```

copy .env.example to .env

```bash
cp .env.example .env
```

Key Generate

```bash
php artisan key:generate
```

Storage Link

```bash
php artisan storage:link
```

`##-Update DB info in .env-##`

Migrate

```bash
php artisan migrate
```

install Tailwindcss

```bash
  npm install
```

Build Tailwindcss

```bash
  npm run build
```

Run Tests

```bash
  php artisan test
```

DB Seed

```bash
php artisan db:seed
```

Start the server

```bash
  php artisan serve
```

Start the socket server

```bash
  php artisan websockets:serve
```

# Or

1.

```bash
git clone https://github.com/developersharif/tinygram.git && cd tinygram && composer install && cp .env.example .env

```

2.

```bash
Update DB info (.env)
```

3.

```bash
php artisan key:generate && php artisan storage:link && php artisan migrate && npm install && npm run build && php artisan test && php artisan db:seed && php artisan serve
```

Open: http://127.0.0.1:8000

Demo Account:

```
Email:demo@example.com
Password:password
```

![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)

Run on play with docker
https://labs.play-with-docker.com/

Clone the project

```bash
  git clone https://github.com/developersharif/tinygram.git
```

Go to the project directory

```bash
  cd tinygram
```

Build Docker Image
#with docker desktop

```bash
docker compose build
```

Docker Up

```bash
  docker compose up -d
```

Docker initial commands

```bash
docker exec tinygram-app bash -c "cp .env.docker .env && composer install && php artisan key:generate && php artisan migrate && php artisan db:seed && npm install && npm run build && chmod -R a+rw storage/ && php artisan storage:link"
```

Run websocket server

```bash
docker exec tinygram-app bash -c "php artisan websockets:serve"
```

Open: http://localhost

## Screenshots

![App Home](https://i.ibb.co/4tTsmmJ/2023-12-11-08-23.png)
![App Profile](https://i.ibb.co/89TK4YY/2023-12-11-08-24.png)
![App Notification](https://i.ibb.co/xztRYrp/2023-12-11-08-30-1.png)
## Demo Video.

https://github.com/developersharif/tinygram/assets/54396379/57938efa-763d-4da1-93fc-374c9758324a


## Features

-   Auth/Authorization (Breeze Starter kit)
-   Post Crud
-   Like
-   Comment (With Nested Reply)
-   Follow/Unfollow
-   Like, Comment, Reply Notification
-   Search (Users/Posts)
-   NewsFeed as User Following Lists
-   RealTime Messaging
-   Custom Policy Applied
-   UI (Tailwindcss & DaisyUI)
-   Templating Engine (Blade)
-   Fully ORM Based
-   Mobile First Design

## Tech Stack

**Client:** Alpinejs, DaisyUI, TailwindCSS, Fontawesome, Reactjs(/chat route)

**Server:** PHP8.2, Laravel10.x,Blade ,(Node,NPM to build TailwindCSS)

## Authors

-   [@developersharif](https://www.github.com/developersharif)
