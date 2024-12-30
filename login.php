<?php
 // Страница авторизации
   // Функция для генерации случайной строки
function generateCode($length = 6)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0, $clen)];
    }
    return $code;
}
// Функция проверяет IP адрес пользователя  и обновляет его в БД и задержка 3 секунды
function FindUserIP ($pdo, $new_data) {
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
     
    if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;
  
// Записываем в БД новый хеш авторизации и IP
$stmt = $pdo->prepare("UPDATE `users` SET `user_ip` = :user_ip WHERE `user_id` = :user_id");
$stmt->execute(array('user_ip' => $ip, 
'user_id' => $new_data['user_id']));

// sleep(4); //********************************************** Задержка ***************************************************************** */
    // echo $ip;
    // die();
}

// Соединямся с БД
require_once ("main_info.php");

try {  
    $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $password);
    $pdo->exec('SET NAMES utf8');
    } catch (PDOException $e) {
    print "Не смогли подключиться к БД: " . $e->getMessage();  die();
    }



if (isset($_POST['submit'])) {
    $login = $_POST['login'];

    $input_password =  md5(md5($_POST['password']));
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_login='" . $login . "' LIMIT 1");
    $stmt->execute([]);
    $udata = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";

    if (isset($udata[0])) { // Проверяем, достали ли ЛОГИН из БД
$new_data = call_user_func_array('array_merge', $udata); // Уменьшаем уровень вложенности массива 




// Проверяем IP
FindUserIP ($pdo, $new_data);
// print_r($new_data);

// echo  $input_password;

        // Сравниваем пароли
        if ($new_data['user_password'] === $input_password) {
  
            // Генерируем случайное число и шифруем его
            $hash = md5(generateCode(10));
            // Записываем в БД новый хеш авторизации и IP
            $stmt = $pdo->prepare("UPDATE `users` SET `user_hash` = :user_hash WHERE `user_id` = :user_id");
            $stmt->execute(array('user_hash' => $hash, 
            'user_id' => $new_data['user_id']));
            // Ставим куки
            setcookie("id", $new_data['user_id'], time() + 60 * 60 * 24, "/");
            setcookie("hash", $hash, time() + 60 * 60 * 24, "/", null, null, true);
            setcookie("user_name", $new_data['user_login'], time() + 60 * 60 * 24, "/", null, null, true);
            // Переадресовываем браузер на страницу проверки нашего скрипта

            
            header("Location: index.php");
            exit();
        } else {
            $subject_theme="Кто то неверно ввел пароль";
            // require('mailer/alarm_mail_message.php');
            echo "Вы ввели неправильный логин/пароль";
        
        }
    } else {
        $subject_theme="Кто то неверно ввел логин";
        // require('mailer/alarm_mail_message.php');
        echo "Вы ввели неправильный логин/пароль!"; 
    }

 }
    
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <title>Перечень участиников НУ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
    <link rel="stylesheet" href="css/input_new_admin.css"/>
    
  </head>
  <body>


  <div class="wrapper">
  <form class="login" method="post">
    <p class="title">Авторизация</p>
      
    <input type="text" placeholder="Логин"  name="login"  autofocus required>
    <input type="password" placeholder="Пароль" name="password" required>
    <input type="hidden" name="submit"  value="Войти">

   

    <button>
       <span class="state">Войти</span>
    </button>
  </form>
  </p>
</div>

</body>
