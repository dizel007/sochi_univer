<?php
require_once "connect_db.php";
require_once 'functions.php';


$stmt = $pdo->prepare("SELECT * FROM `spisok` WHERE `small_spisok` = 1 AND `delete_user` <> 1 ORDER BY `fio` ASC");
$stmt->execute([]);
$table_data = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo <<<HTML
 <link rel="stylesheet" href="css/main_table.css">
HTML;
// echo "<pre>";
// print_r($table_data[0]);

if ($userdata['admin_user'] == 1){
    print_users_table($table_data);
}else {
    print_users_table_low_right($table_data);
}

echo "<br><br>";
echo "<a href=\"download_small_spisok.php\">Скачать список</a>";