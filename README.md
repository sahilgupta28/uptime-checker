# Uptime Checker

Uptime checker is a solution to trace the uptime of the website.

## Start from git

Open terminal and run following command for download from git.

```bash
git clone https://github.com/sahilgupta28/uptime-checker.git
cd uptime-checker
```

## Front-End Setup

We are using the Laravel mix for JS & CSS. So, We need to run the following commands.

```bash
npm install
npm run dev
```

## Back-End Setup

Create `.env` file from `.env.example` and put your values. then run following commands.

```bash
composer install
php artisan key:generate
php artisan migrate
sudo chmod -R 777 ./storage
sudo chmod -R 777 ./bootstrap/cache/
php artisan db:seed
```

Now you are ready to start.

## FAQ

### What is uptime checker?

Uptime checker is a powerful tool which checks the uptime of a web project and notifies the user on the project down.

### How it works?

You need to create an account with uptime checker. Then you can add your web URL to check their uptime. This tool will ping the URL to check the uptime of the URL.
