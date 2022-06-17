<?php session_start();
    $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>7</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <div class="form-block">
        <h1>Зареєструватись</h1>
        <form action="assets/php/register.php" method="post">
            <input type="text" name="login" placeholder="Логін">
            <input type="password" name="password" placeholder="Пароль">
            <input type="password" name="cpassword" placeholder="Підтвердіть пароль">
            <input type="submit" value="Зареєструватись">
        </form>
    </div> 
    <br>
    <div class="form-block">
        <h1>Увійти</h1>
        <form action="assets/php/login.php" method="post">
            <input type="text" name="login" placeholder="Логін">
            <input type="password" name="password" placeholder="Пароль">
            <input type="submit" value="Увійти">
        </form>
        <?php if(!empty($user['id'])) {?>
        <a href="/7/profile.php">Профіль</a><br>
        <?php } ?>
    </div>
    
</body>
</html>