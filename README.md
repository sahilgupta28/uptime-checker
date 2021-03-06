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

### How to register on uptime?

Hit URL:- https://uptime.utool.dev/register
Then there are options for register with Uptime.

-   Add some user details (Like name, email, password) and create an account.
-   You can directly register with Github.

### Can we use any social login/register?

Yes, We have integrated Github login/register. So, You can login login/register via Github.

### What is the frequency of testing ping?

We ping the URL after every 10 min and when it found down then we start pinging every minute until next up.

### Where user will get notification of down status?

User will get notification of down on Slack. You need to add your slack hook with the web URL.

### How to add slack hook?

Click on edit domain button, there is an option for add slack hook.

### What is the slack hook?

Incoming Webhooks are a simple way to post messages from apps into Slack. Creating an Incoming Webhook gives you a unique URL to which you send a JSON payload with the message text and some options.

### How I can get a slack hook?

Slack provides a service to create webhook. [Click here](https://api.slack.com/messaging/webhooks) to know more about it.
