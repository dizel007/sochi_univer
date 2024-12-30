<?php

// echo  "ПРОШЛИ КОННЕКТ<br>";
require_once ("main_info.php");

// ************************************** PHP EXCEL  ***********************************
require_once 'PHPExcel-1.8/Classes/PHPExcel.php';
require_once 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';
require_once 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';


      try {  
        $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $password);
        $pdo->exec('SET NAMES utf8');

        } catch (PDOException $e) {
          print "Has errors: " . $e->getMessage();  die();
        }

// *************   проверяем зашел ли пользователь с паролем  ****************************************


if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) // Проверяем зарегистрирован ли пользователь
{   
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_hash='" . $_COOKIE['hash'] . "' LIMIT 1");
    $stmt->execute([]);
    $userdata_temp = $stmt->fetchAll(PDO::FETCH_ASSOC);

   $userdata =  $userdata_temp[0];     
   
   
  
// ***************   проверяем введеный хэш пароля с тем, что храниться в БД  ***************************

  
    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))
    {
      $link_for_login = "login.php";
      header("Location: $link_for_login"); exit();
    }
  } else {
    $link_for_login = "login.php";
    header("Location: $link_for_login"); exit();

  }

// *******************   Обновляем каждый раз Куку  *******************************
$hash= $_COOKIE['hash'];
$user_id_cook = $_COOKIE['id'];
setcookie("id", $user_id_cook, time() + 60 * 60 * 24, "/");
setcookie("hash", $hash, time() + 60 * 60 * 24, "/", null, null, true); 



