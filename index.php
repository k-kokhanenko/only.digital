<?php
session_name('only-digital-login');
session_start();

if ($_SESSION["id"])
{
	header("Location: profile.php");
	exit;	
} 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Only.digital - Authorization</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bulma.css">
    <script src="js/main.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
    <main class="main">
       <div class="auth-panel">
            <div class="box">
                <div class="field">
                    <label class="label">Телефон или email *</label>
                    <div class="control">
                        <input class="input" type="text" id="phone_email" placeholder="Введите Ваш телефон или email">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Пароль *</label>
                    <div class="control">
                        <input class="input" type="password" id="password" placeholder="Введите Ваш пароль">
                    </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6LfIjZElAAAAAMMe7RHZygoyPcBAb-e-onrVfpNW"></div>
                <br>
                <div class="buttons">
                    <button class="button is-link is-outlined is-small" onclick="location.href='registration.php';">Зарегистрироваться</button>
                    <button class="button is-success is-outlined is-fullwidth" type="submit" id="auth_submit">Войти</button>
                </div>
                <article class="message is-danger is-hidden" id="message-box"> 
                     <div class="message-body" id="message-body"></div>
                </article>
            </div>
        </div>
    </main>
</body>
</html>