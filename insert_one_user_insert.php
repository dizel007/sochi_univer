<?php


require_once 'connect_db.php';

$fio = $_GET['fio'];
$born_date = $_GET['born_date'];
$telephon = $_GET['telephon'];
$city = $_GET['city'];
$date_vstuplenia = $_GET['date_vstuplenia'];
$paid = $_GET['paid'];
$dop_pole = $_GET['dop_pole'];
$comment = $_GET['comment'];





    $sql = "INSERT INTO `spisok` SET     `fio` = :fio, 
    `born_date` = :born_date, 
    `telephon` = :telephon, 
    `city` = :city, 
    `date_vstuplenia` = :date_vstuplenia,
    `paid` = :paid,
    `dop_pole` = :dop_pole,
    `comment` = :comment 
    ";


$stmt = $pdo->prepare($sql);

$stmt->execute(array('fio'     => $fio,
'born_date'     => $born_date,
'telephon'   => $telephon,
'city'   => $city,
'date_vstuplenia' => $date_vstuplenia,
'paid'   => $paid,
'dop_pole'   => $dop_pole,

'comment'   => $comment,

));

$stmt = $pdo->prepare("SELECT id FROM `spisok` ORDER BY id DESC LIMIT 1");
$stmt->execute([]);
$arr_id = $stmt->fetchAll(PDO::FETCH_COLUMN);

$id = $arr_id[0];

header("Location: form_for_update_one_user.php?id=$id"); exit();