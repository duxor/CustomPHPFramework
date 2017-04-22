<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="/assets/js/jquery-3.1.1.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                App
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/">
                        Home
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if (!User::isLogged()) : ?>
                <li>
                    <a href="/login">
                        Login
                    </a>
                </li>
                <li>
                    <a href="/register">
                        Register
                    </a>
                </li>
                <?php else: ?>

                <li>
                    <a href="/logout"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="/logout" method="POST"></form>
                </li>

                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <?php ErrorHandlerController::get(); ?>
    </div>