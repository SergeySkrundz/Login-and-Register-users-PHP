<?php require("register.class.php") ?>
<?php
    if(isset($_POST['submit'])){
        $user = new RegisterUser($_POST['username'], $_POST['password'], $_POST['confirm_password'], $_POST['mail'], $_POST['log']);

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма регистрации</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container form_register">
        <h2 class="list-reset">Регистрация</h2>
        <h3 class="title_3 list-reset">Пожалуйста, зарегистрируйтесь</h3>
    <form class="input_form" action="" method="post" enctype="multipart\form-data" autocomplete="off">

        <p class="error reg_error_all list-reset"><?php echo @$user->error ?></p>
        <p class="success reg_error_all list-reset"><?php echo @$user->success ?></p>

        <label class="flex">Логин</label>
        <input class="reg_input" type="text" name="log" value="<?php if (isset($_POST['log'])){echo $_POST['log'];}?>">
        <p class="error reg_error_log list-reset"><?php echo @$user->login_error ?></p>
           
        <label class="flex">Пароль</label>
        <input class="reg_input" type="text" name="password" value="<?php if (isset($_POST['password'])){echo $_POST['password'];}?>">
        <p class="error reg_error_password list-reset"><?php echo @$user->password_error ?></p>

        <label class="flex">Подтверждение пароля</label>
        <input class="reg_input" type="text" name="confirm_password" value="<?php if (isset($_POST['confirm_password'])){echo $_POST['confirm_password'];}?>">
        <p class="error reg_error_confirm_password list-reset"><?php echo @$user->confirm_password_error ?></p>
        
        <label class="flex">Электронная почта</label>
        <input class="reg_input" type="email" name="mail" value="<?php if (isset($_POST['mail'])){echo $_POST['mail'];}?>">
        <p class="error reg_error_email list-reset"><?php echo @$user->email_error ?></p>

        <label class="flex">Имя пользователя</label>
        <input class="reg_input" type="text" name="username" value="<?php if (isset($_POST['username'])){echo $_POST['username'];}?>">
        <p class="error reg_error_username list-reset"><?php echo @$user->username_error ?></p>

        <button class="btn btn-reset" type="submit" name="submit">Регистрация</button>

        
    </form>
    </div>
</body>
</html>