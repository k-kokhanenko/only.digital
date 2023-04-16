<?php

session_name('only-digital-login');
session_start();

if (isset($_GET['logoff']) || !$_SESSION['id'])
{
	session_destroy();
	header("Location: index.php");
	exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Only.digital - User Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bulma.css">
    <script src="js/main.js"></script>
</head>
<body>
    <main>
        <div class="profile-panel">
            <div class="box">
                <h1 class="title">Добро пожаловать, <?php echo $_SESSION['name'];?>!</h1>
                <p><a href="profile.php?logoff">Выход из системы</a></p>
                <input type="hidden" id="user-id" value="<?php echo $_SESSION['id'];?>" />
                <div class="field">
                    <label class="label">Имя *</label>
                    <div class="control">
                        <input class="input" type="text" id="name" placeholder="Введите Ваше имя" value="<?php echo $_SESSION["name"];?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Телефон *</label>
                    <div class="control">
                        <input class="input" type="text" id="phone" placeholder="Ведите телефон" value="<?php echo $_SESSION["phone"];?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Email *</label>
                    <div class="control">
                        <input class="input" type="email" id="email" placeholder="Введите email" value="<?php echo $_SESSION["email"];?>">
                    </div>
                </div>     
                <div class="field">
                    <label class="label">Пароль *</label>
                    <div class="control">
                        <input class="input" type="password" id="password" placeholder="Ведите пароль" value="<?php echo $_SESSION["password"];?>">
                    </div>
                </div>   
                <div class="field">
                    <label class="label">Пароль *</label>
                    <div class="control">
                        <input class="input" type="password" id="password_confirm" placeholder="Повторите ввод пароля" value="<?php echo $_SESSION["password"];?>">
                    </div>
                </div>          

                <button class="button is-success is-outlined is-fullwidth" type="submit" id="profile_button">Обновить данные</button>
                <article class="message is-danger is-hidden" id="message-box"> 
                     <div class="message-body" id="message-body">
                    </div>
                </article>
            </div>
        </div>
    </main>
</body>
</html>
