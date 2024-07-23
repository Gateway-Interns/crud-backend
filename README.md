<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects.

## Notification In Laravel

    Laravel is a framework which gives you a great and a wide options to implement, firstly if you can we have a command which sends notification to all the users, but be warned that there should be some users registered!
    in CreateUserNotification.php file you can see some codes the most important one is what you command should be like in the terminal the Signature, notify:new-release, which sends a new notification release to all the registered users, through handle method.

    In handle method we have NewReleaseNtofication, which is a class you can see we have used Queue, for more detail on queue you can check this article: <a href="https://laravel.com/docs/11.x/queues"> 
 

