<!doctype html>
<html lang="en">
<head>
    <?php include("partials/links.php"); ?>
    <script src="/public/scripts/login-form-validation.js" defer></script>
    <meta charset="UTF-8">
    <title>Login Page - Open Cutest</title>
</head>
<body class="login">
    <header class="login__header">
        <img class="login__image" src="/public/img/logo.svg" alt="Open Cutest Logo">
        <section class="login__text">
            Open<br>
            cu<span class="text--orange">test</span>
        </section>
    </header>
    <form class="login__form" action="/login" method="POST">
        <div class="login__message <?php if(isset($viewData["message-class"])) { echo $viewData["message-class"]; } ?>">
            <?php if(isset($viewData["login-message"])) { echo $viewData["login-message"]; } ?>
        </div>
        <div class="login__input">
            <i class="fas fa-user fa-2x"></i>
            <input type="text" name="login" placeholder="Username">
        </div>
        <div class="login__input">
            <i class="fas fa-lock fa-2x"></i>
            <input type="password" name="password" placeholder="Password">
        </div>
        <button class="login__button">Log in</button>
    </form>
</body>
</html>