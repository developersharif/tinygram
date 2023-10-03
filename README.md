
# Project TinyGram

Tinygram is a cutting-edge social media platform 😊  that brings the world of visual storytelling to life. Developed using the power of Laravel 10 🤗


![Logo](https://i.ibb.co/mTg3XKd/tinygramlogo.png)


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
Sqlite file create
```bash
touch database/database.sqlite
```
Migrate
```bash
php artisan migrate:refresh --seed
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


## Screenshots

![App Home](https://i.ibb.co/xzL3gfZ/tinygram-home.png)
![App Profile](https://i.ibb.co/R9S9FtK/tinygram-profile.png)

![App Notification](https://i.ibb.co/FJFrBzP/tinygram-notice.png)

## Features
- Auth/Authorization (Breeze Starter kit)
- Post Crud
- Like
- Comment (With Nested Reply)
- Follow/unFollow
- Like,Comment,Reply Notification
- Search (Users/Posts)
- NewsFeed as User Following Lists
- Custom Policy Applied
- UI (Tailwindcss & DaisyUI)
- Templeting Engine (Blade)
- Fully ORM Based
- Mobile First Design


## Tech Stack

**Client:** Alpinejs, DaisyUI, TailwindCSS,Fontawesome

**Server:** PHP8.2, Laravel10.x,Blade ,(Node,NPM to build TailwindCSS)


## Authors

- [@developersharif](https://www.github.com/developersharif)
