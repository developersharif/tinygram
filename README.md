# Project TinyGram

Tinygram is a cutting-edge social media platform 😊 that brings the world of visual storytelling to life. Developed using the power of Laravel 10 🤗

<p align="center">
<img src="https://i.ibb.co/b1wwxxc/tinygram.png" width="100" alt="tinygram logo" title="TinyGram Logo">
</p>

## Run Locally

Clone the project

```bash
  git clone https://github.com/developersharif/tinygram-blade.git
```

Go to the project directory

```bash
  cd tinygram-blade
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
php artisan migrate --seed
```

install Tailwindcss

```bash
  npm install
```

Build Tailwindcss

```bash
  npm run build
```

Start the server

```bash
  php artisan serve
```

Open: http://127.0.0.1:8000

Demo Account:

```
Email:demo@example.com
Password:password
```

## Screenshots

![App Home](https://i.ibb.co/bLbtVrk/tinygram-home.png)
![App Profile](https://i.ibb.co/6sZJzCr/tinygram-profile.png)

![App Notification](https://i.ibb.co/YpSv76b/tinygram-notice.png)

## Features

-   Auth/Authorization (Breeze Starter kit)
-   Post Crud
-   Like
-   Comment (With Nested Reply)
-   Follow/unFollow
-   Like,Comment,Reply Notification
-   Search (Users/Posts)
-   NewsFeed as User Following Lists
-   Custom Policy Applied
-   UI (Tailwindcss & DaisyUI)
-   Templeting Engine (Blade)
-   Fully ORM Based
-   Mobile First Design

## Tech Stack

**Client:** Alpinejs, DaisyUI, TailwindCSS,Fontawesome

**Server:** PHP8.2, Laravel10.x,Blade ,(Node,NPM to build TailwindCSS)

## Authors

-   [@developersharif](https://www.github.com/developersharif)
