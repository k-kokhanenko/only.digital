<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Only.digital - Registration</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bulma.css">
    <script src="js/main.js"></script>
</head>
<body>
    <main class="main">
        <div class="reg-panel">
            <div class="box">
                <div class="field">
                    <label class="label">Имя *</label>
                    <div class="control">
                        <input class="input" type="text" id="name" placeholder="Введите Ваше имя">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Телефон *</label>
                    <div class="control">
                        <input class="input" type="text" id="phone" placeholder="Введите телефон">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Email *</label>
                    <div class="control">
                        <input class="input" type="email" id="email" placeholder="Введите email">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Пароль *</label>
                    <div class="control">
                        <input class="input" type="password" id="password" placeholder="Введите пароль">
                    </div>
                </div>            
                <div class="field">
                    <label class="label">Пароль *</label>
                    <div class="control">
                        <input class="input" type="password" id="password_confirm" placeholder="Повторите ввод пароля">
                    </div>
                </div>            
                <div class="buttons">
                    <button class="button is-link is-outlined" id="reg_back_button" onclick="javascript:history.back();">Вернуться назад</button>
                    <button class="button is-success is-outlined" type="submit" id="reg_button">Зарегистрироваться</button>
                </div>
                <article class="message is-danger is-hidden" id="message-box"> 
                     <div class="message-body" id="message-body">
                    </div>
                </article>
            </div>
        </div>
    </main>
</body>
</html>