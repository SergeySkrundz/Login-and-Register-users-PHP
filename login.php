<?php require("login.class.php") ?>
<?php
    if(isset($_POST['submit'])){
        $user = new LoginUser($_POST['log'], $_POST['password']);

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма авторизации</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container form_login">
    <h2 class="list-reset">Авторизация</h2>
    <h3 class="title_3 list-reset">Пожалуйста, авторизуйтесь</h3>
    <form  class="input_form" action="" method="post" enctype="multipart\form-data" autocomplete="off">

        <p class="error log_error_all list-reset"><?php echo @$user->error ?></p>

        <label class="flex">Логин</label>
        <input type="text" name="log" value="<?php if (isset($_POST['log'])){echo $_POST['log'];}?>">
        <p class="error log_error_log list-reset"><?php echo @$user->login_error ?></p>

        <label class="flex">Пароль</label>
        <input type="text" name="password" value="<?php if (isset($_POST['password'])){echo $_POST['password'];}?>">
        <p class="error log_error_password list-reset"><?php echo @$user->password_error ?></p>

        <button class="btn btn-reset" type="submit" name="submit">Вход</button>
        
    </form>
    </div>
    
</body>
</html>