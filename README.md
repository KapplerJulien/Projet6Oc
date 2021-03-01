# Project 6 for OpenClassrooms

## Context

I did this website in Symfony 5 and I used bootstrap for CSS. 

It's a website about snowboard, tricks snowboard. Everyone can create an account and create new article about tricks or anything, but this need to be related to snowboard. 
You can also edit and delete any of article in the website, and of course you can just edit or delete one by one every images/videos. 
If you're authenticate, you can write a comment on any article.

It's a project for my formation. I know, the website don't include a Contact page or other important stuff. Don't ask for them, i followed the rules. Thanks !

## Project 

If you want to use this project, you can download it. You have a button at the top of the Code page, this button is called "Code". Here you will see everything you need, you can clone (You need to have git on your computer if you want to clone a project) or download.

[Git](https://git-scm.com/downloads)

## Install

You have to be carefull if you want to install this project because : 

- I used WAMPServer for the local development, you can find it here : [WampServer](https://www.wampserver.com/). If you have some problems with WampServer, don't worry, there are a lot of tutorials on internet. You will find everything you need. Or you can also use the documentation.

- Then you need Symfony 5, if you need it : [Symfony](https://symfony.com/doc/current/index.html). You can download from this page and this is also the documentation. Symfony have a big documentation. If you don't know Symfony, everything is explain here. Most of the time, you just need this documentation.

- For the library, I will write them at the end of the README. 

But there is one more information : if you want to use it online. You have to be carefull about the path for images/videos... Don't forget to check the Templates and replace them by your URL. Because if you don't do that you will not see images/videos and CSS.

## Install database

You need the database. For this, you need some library if they don't worked correctly (it's write at the end). 

First, you need to be carefull about the name of the database, if you want to change , you can change it in .env and in this file, you can also change your database type, I'm using mysql but you can change to PostgreSQL or something else. 
Then you can open a terminal, go to your project with the command "cd", when you're in, use : php bin/console doctrine:database:create. That will create the database. 

Then : php bin/console make:migration

and : php bin/console doctrine:migrations:migrate

And you have your database. 

If you want some test, use this command, I write a file with some test inside : php bin/console doctrine:fixtures:load. 

If you have some problems. You can find my SQL export from my PHPMyAdmin in the folder /config/SQL.

## Install website

You don't need to do anything. Just to be care about asset and path in /src/controller, /templates... If you install it in local, juste start symfony and test it.

Just a little thing. If you want or need to change the CSS. You can find it in /public/build

## User test

There is 10 User test

It goes from 

Pseudo : test1
Password : test1

To 

Pseudo : test10
Password : test10

## Library

If you have some problem with the website. I will write here every library I used on it.

### Database 

[Doctrine](https://symfony.com/doc/current/doctrine.html#installing-doctrine)

[DataFixtures](https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html)

### Routing

[Routing](https://symfony.com/doc/current/routing.html)

### Contact

[Mailer](https://symfony.com/doc/current/mailer.html)

### CSS

[Encore](https://symfony.com/doc/current/frontend/encore/installation.html)

[Best practice](https://symfony.com/doc/current/best_practices.html#web-assets)

[Bootstrap](https://symfony.com/doc/current/frontend/encore/bootstrap.html)

### Security

[Security](https://symfony.com/doc/current/security.html)

## Code climate

If you want to know the quality of the code : [my Code climate page](https://codeclimate.com/github/KapplerJulien/Projet6Oc)

![Image Code climate A](https://i.imgur.com/r6evpJ1.png)