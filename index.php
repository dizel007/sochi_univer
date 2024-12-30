<?php
require_once 'connect_db.php';
require_once 'functions.php';



$stmt = $pdo->prepare("SELECT * FROM `spisok` WHERE `delete_user` <> 1 ORDER BY `fio` ASC");
$stmt->execute([]);
$table_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Сумма всех платежей
$count_members = count($table_data);
$total_sum = 0;
foreach ($table_data as $item) {
    $total_sum += $item['paid'];
}

// echo "<pre>";
// print_r($userdata);

$admin_user = $userdata['user_login']; // логин зарегистрированного пользователя
echo "<table class = \"resp-tab\">";
echo "<tr>";
echo "<td>"."Участников : $count_members"."</td>";
// Это видно только АДМИНАМ

        echo "<td>"."Сумма взносов =  $total_sum"."</td>";
        if ($userdata['admin_user'] == 1){
        echo "<td>"."<a  href=\"birthsday_users.php\" class=\"block\"> <img src=\"pics/dr.png\"> <span class=\"block-text\">ДР пользователей</span> </a></td>";

        // echo "<td>"."<a href=\"birthsday_users.php\"> <img src=\"pics/dr.png\"><p>Дни рождения пользователей</p></a>"."</td>";
        echo "<td>"."<a href=\"find_users.php\">Найти пользователя</a>"."</td>";
        echo "<td>"."<a href=\"form_for_insert_one_user.php\">Добавить участника</a>"."</td>";
        echo "<td>"."<a href=\"form_for_insert_new_admin.php\">Добавить админа</a>"."</td>";
        echo "<td>"."<a href=\"excel_spisok.php\">Скачать список</a>"."</td>";
        }
        echo "<td>". "Админ: $admin_user "."</td>";
        echo "<td>". "<a  href=\"exit_prg.php?exit_user=1\" class=\"block\"> <img src=\"pics/exit.jpg\"> </a>"."</td>";


echo "</tr>";


echo "</table>";


echo "<br>";
echo "<br>";





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