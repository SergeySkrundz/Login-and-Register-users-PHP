<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location: login.php"); exit();
    }
    if(isset($_GET['logout'])){
        unset($_SESSION['user']);
        header("location: login.php"); exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сайт</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="content">
        <header>
            <h2 class="hello">Привет "<?php echo $_SESSION['user']; ?>"</h2>
            <a class="btn btn_site" href="?logout">Выйти</a>
        </header>
        <main>
            <h3 class="page">Контент страницы сайта...</h3>
        </main>
    </div>
</body>
</html>