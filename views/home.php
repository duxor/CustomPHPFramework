<?php require_once "views/layouts/master.php"; ?>

<h1>Home</h1>

<div class="col-sm-12">
    <?php if (!User::isLogged()) : ?>
        <a href="/login">
            Login
        </a>
        <br>
        <a href="/register">
            Register
        </a>
    <?php else: ?>
        <a href="/logout"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            Logout
        </a>
    <?php endif; ?>
</div>

<?php
    if(isset($_SESSION['user']))
        echo "<h2>Welcome, {$_SESSION['user']['name']}</h2>";
?>

<?php require_once "views/layouts/search-form.php"; ?>