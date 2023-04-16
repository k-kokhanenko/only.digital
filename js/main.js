function showMessage(isError, messageText) {
    let messageBox = document.getElementById('message-box');
    if (messageBox !== null) {
        let messageBody = document.getElementById("message-body");
        if (messageBody !== null) {
            let type = isError ? 'is-danger' : 'is-success';

            messageBody.innerHTML = messageText;    
            messageBox.className = "message " + type;

            setTimeout(
                () => {
                    messageBox.className = "message is-danger is-hidden";
                },
                5 * 1000
            );
        }
    }
}

function getUserParamsFromForm() {
    const params = [
        { message : 'Ваше имя', fieldId : 'name', isRequired : true, fieldValue: ''},
        { message : 'Телефон', fieldId : 'phone', isRequired : true, fieldValue: ''},
        { message : 'Email', fieldId : 'email', isRequired : true, fieldValue: ''},
        { message : 'Пароль', fieldId : 'password', isRequired : true, fieldValue: ''},
        { message : 'Подтверждение пароля', fieldId : 'password_confirm', isRequired : true, fieldValue: ''}
    ];

    let errorMessage = '';
    let requestBody = '';
    for (let i = 0; i < params.length; i++) {
        let param = document.getElementById(params[i].fieldId);
        if (param === null) {
            throw new Error('В HTML-разметке отсутствует элемент с id = ' + params[i].fieldId + '.');
        }
        else {
            params[i].fieldValue = param.value;  
            requestBody += '&' + params[i].fieldId + '=' + encodeURIComponent(params[i].fieldValue);

            if (param.value.length == 0 && params[i].isRequired) {
                errorMessage += ' - ' + params[i].message + '<br>';
            } 
        }
    }

    return { errorMessage : errorMessage, params : params, requestBody : requestBody};
} 

window.onload = function() {
    const registrationButton = document.getElementById('reg_button');
    if (registrationButton !== null) {
        registrationButton.addEventListener('click', function () {
            let res = getUserParamsFromForm();
            let requestBody = 'operation=registration' + res.requestBody;

            if (res.errorMessage.length > 0) {
                showMessage(true, 'Необходимо ввести значения в следующие поля формы:<br>' + res.errorMessage + 'Данные поля не могут быть пустыми.');
            } else {
                if (res.params[3].fieldValue != res.params[4].fieldValue) {
                    showMessage(true, 'Повторите ввод пароля.'); 
                } else {
                    let request = new XMLHttpRequest();
                    request.open('POST', 'db/userCRUD.php', true);
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    request.onreadystatechange = function() {
                        if (request.readyState == 4) {
                            if (request.status == 200) {	
                                if (request.responseText.length > 0) {
                                    showMessage(true, 'Ошибка регистрации:\n' + request.responseText);
                                } else {
                                    window.location = 'profile.php';
                                }
                            } else {
                                showMessage(true, 'Ошибка регистрации: ' + request.statusText + '\nПовторите попытку позднее.');
                            }
                        }
                    }		

                    request.send(requestBody);
                }
            }
        }); 
    } 

    const authButton = document.getElementById('auth_submit');
    if (authButton !== null) {
        authButton.addEventListener('click', function () {
            let errorMessage = '';
            let requestBody = 'operation=authorization';
            
            let param = document.getElementById('phone_email');
            if (param === null) {
                throw new Error('В HTML-разметке отсутствует элемент с id = phone_email.');
            } else {
                if (param.value.length == 0) {    
                    errorMessage += ' - телефон или email<br>';
                } else {
                    requestBody += '&phone_email=' + param.value;
                }
            }

            param = document.getElementById('password');
            if (param === null) {
                throw new Error('В HTML-разметке отсутствует элемент с id = password.');
            } else {
                if (param.value.length == 0) {    
                    errorMessage += ' - пароль<br>';
                } else {
                    requestBody += '&password=' + param.value; 
                }
            }

            if (errorMessage.length > 0) {
                showMessage(true, 'Необходимо ввести значения в следующие поля формы:<br>' + errorMessage + 'Данные поля не могут быть пустыми.');
            } else {
                var response = grecaptcha.getResponse();
                if (response.length == 0) {
                    showMessage(true, 'Вы не прошли проверку reCAPTCHA.');
                } else {
                    let request = new XMLHttpRequest();
                    request.open('POST', 'db/userCRUD.php', true);
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
                    request.onreadystatechange = function() {
                        if (request.readyState == 4) {
                            if (request.status == 200) {	
                                if (request.responseText.length > 0) {
                                    showMessage(true, 'Ошибка авторизации:<br>' + request.responseText);
                                } else {
                                    window.location = 'profile.php';
                                }
                            } else {
                                showMessage(true, 'Ошибка авторизации: ' + request.statusText + '<br>Повторите попытку позднее.');
                            }
                        }
                    }		
    
                    request.send(requestBody);
                }
            }
        });
    }

    const profileButton = document.getElementById('profile_button');
    if (profileButton !== null) {
        profileButton.addEventListener('click', function () {
            let userId = document.getElementById('user-id');
            if (userId === null) {
                throw new Error('В HTML-разметке отсутствует элемент с id = user-id.');
            }
            
            let res = getUserParamsFromForm();
            let requestBody = 'operation=update' + res.requestBody + '&id=' + userId.value;

            if (res.errorMessage.length > 0) {
                showMessage(true, 'Необходимо ввести значения в следующие поля формы:<br>' + res.errorMessage + 'Данные поля не могут быть пустыми.');
            } else {
                if (res.params[3].fieldValue != res.params[4].fieldValue) {
                    showMessage(true, 'Повторите ввод пароля.'); 
                } else {
                    let request = new XMLHttpRequest();
                    request.open('POST', 'db/userCRUD.php', true);
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    request.onreadystatechange = function() {
                        if (request.readyState == 4) {
                            if (request.status == 200) {	
                                if (request.responseText.length > 0) {
                                    showMessage(true, 'Ошибка обновления данных:<br>' + request.responseText);
                                } else {
                                    showMessage(false, "Данные успешно обновлены.");
                                }
                            } else {
                                showMessage(true, 'Ошибка обновления данных: ' + request.statusText + '\nПовторите попытку позднее.');
                            }
                        }
                    }		

                    request.send(requestBody);
                }
            }
        });
    }
  }