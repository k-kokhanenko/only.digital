<?php
session_name('only-digital-login');
session_start();

$error = "";

try {
	$db = new PDO('sqlite:users.db'); 
}
catch (PDOException $error) {
	$error = "Ошибка подключения к БД.<br>".$error->getMessage();
}

if (strlen($error) == 0) {
	switch($_POST['operation']) {
		case 'registration':  
			$result = $db->query("SELECT count(*) FROM users WHERE name = '".$_POST['name']."' AND phone = '".$_POST['phone']."'");  
			if ($result->fetchColumn() > 0) {
				$error = "Пользователь с таким именем '".$_POST['name']."' и/или номером телефона '".$_POST['phone']."' уже существует.";
			} else {
				$data = array($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['password']);    
				$result = $db->prepare("INSERT INTO users (name, phone, email, password) values (?, ?, ?, ?)");  
				$result->execute($data);
		
				$_SESSION["id"] = $db->lastInsertId();
				$_SESSION["name"] = $_POST['name'];
				$_SESSION["phone"] = $_POST['phone'];
				$_SESSION["email"]= $_POST['email'];
				$_SESSION["password"]= $_POST['password'];
			}
			break;
		case 'authorization':  
			$result = $db->query("SELECT * FROM users WHERE password = '".$_POST['password']."' AND (phone = '".$_POST['phone_email']."' OR email = '".$_POST['phone_email']."')");  
			$result->setFetchMode(PDO::FETCH_OBJ);  
	
			while($row = $result->fetch()) {  
				$_SESSION["id"] = $row->id;
				$_SESSION["name"] = $row->name;  
				$_SESSION["phone"] = $row->phone;  
				$_SESSION["email"]= $row->email;  
				$_SESSION["password"]= $row->password;  
			}
	
			if (!$_SESSION["id"]) {
				$error = "Пользователь с таким данными не существует.<br>Ведите новые данные.";
			}
		  	break;

		case 'update':  
			$result = $db->query("SELECT count(*) FROM users WHERE id != '".$_POST['id']."' AND email = '".$_POST['email']."'");  
			if ($result->fetchColumn() > 0) {
				$error = "Уже есть пользователь с таким email.";
			} else {
				$result = $db->query("SELECT count(*) FROM users WHERE id != '".$_POST['id']."' AND phone = '".$_POST['phone']."'");  
				if ($result->fetchColumn() > 0) {
					$error = "Уже есть пользователь с таким телефоном.";
				}	
			}
			
			if (strlen($error) == 0) {
				$data = array($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['password'], $_POST['id']);    
				$result = $db->prepare("UPDATE users SET name = ?, phone = ?, email = ?, password = ? WHERE id = ?");  
				$result->execute($data);
		
				$_SESSION["name"] = $_POST['name'];
				$_SESSION["phone"] = $_POST['phone'];
				$_SESSION["email"]= $_POST['email'];
				$_SESSION["password"]= $_POST['password'];
			}
			break;
	  }
}

echo $error;

?>