<!doctype html>
<html lang="en">
<head>
    <?php include(__DIR__."/../partials/links.php"); ?>
    <script src="/public/scripts/render-navigation.js" defer></script>
    <meta charset="UTF-8">
    <title>Project - Open Cutest</title>
</head>
<body class="container">
    <?php include(__DIR__."/../partials/navbar.php"); ?>
    <?php include(__DIR__."/../partials/navigation.php"); ?>
    <main class="content">
        <div class="content__title">
            Add user
        </div>
        <form class="register__form" action="/users/add" method="POST">
            <div class="register__input">
                <i class="fas fa-user fa-2x"></i>
                <input type="text" name="login" placeholder="Username">
            </div>
            <div class="register__input">
                <i class="fas fa-lock fa-2x"></i>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="register__input">
                <i class="fas fa-lock fa-2x"></i>
                <input type="password-repeat" name="password-repeat" placeholder="Repeat password">
            </div>
            <button class="register__button">Add user</button>
            <div class="register__message <?php if(isset($viewData["message-class"])) { echo $viewData["message-class"]; } ?>">
                <?php if(isset($viewData["register-message"])) { echo $viewData["register-message"]; } ?>
            </div>
        </form>
    </main>
</body>
</html>