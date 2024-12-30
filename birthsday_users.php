<?php

require_once 'connect_db.php';
require_once 'functions.php';




echo <<<HTML
 <link rel="stylesheet" href="css/main_table.css">
HTML;


if (isset($_GET['born_date'])) {
    $date = $_GET['born_date'];
} else {
    $date = date('Y-m-d');
}


$table_data = Get_birthsday_users_for_one_day($pdo, $date);
// echo "<pre>";
// print_r($table_data);



echo "<form action=\"birthsday_users.php\" method=\"get\">";
echo "<table class = \"resp-tab\">";
echo "<tr>";
echo "<td> Дата рождения </td>";
echo  "<td><input size =\"45\" class=\"\" type=\"date\" name=\"born_date\" value=" . "\"$date\"" . "></td>";
echo "<td> <input type=\"submit\" value=\"Поиск данных\"> </td>";
echo "<td> <a href=\"index.php\" > Главная страница</a></td>";
echo "</tr>";
echo "</table>";
echo "</form>";







echo "<h1>День Рождения $date</h1>";
if (isset($table_data[0])) {
    print_users_table($table_data);
    $all_people ='Сегодня мы поздравляем с Днем рождения следующих участников  Народного Университета : ';

foreach ($table_data as $users) {
    $uchastniki[] = $users['fio'];
    
}
$string_uchastniki = implode(', ',$uchastniki);
$all_people = $all_people.  $string_uchastniki;
// echo "<h1>$all_people</h1>";
$text_for_whatsup_link = urlencode($all_people);
// $whatsapp_link = "https://api.whatsapp.com/send?phone=79122020299&text=$all_people";
// $whatsapp_link = "https://api.whatsapp.com/send?chat=IfrYSG5N4AILo0FPfWTMD8/send?&text=$all_people";
$whatsapp_link = "https://api.whatsapp.com/send?text=$text_for_whatsup_link";

echo <<<HTML
<div class = "whatsup_text">
$all_people
<br><br>
<div class = "whatsup_link">
<a href ="$whatsapp_link" target ="_blank">Отправить поздравление в WhatsUp</a>
</div>
</div>
HTML;

} else  {
    echo "В БАЗЕ ДАННЫХ НЕТ УЧАСТНИКОВ С ДНЕМ РОЖДЕНИЯ $date";
}



// Формируем ссылку на whatsapp

//*********************************** */




$start_date = date('Y-m-d', strtotime($date . ' +1 day'));
$stop_date = date('Y-m-d', strtotime($date . ' +7 day'));
echo "<h1>Дни Рождения на следующие 7 дней с ($start_date) по ($stop_date)</h1>";



for ($i=1; $i<=7; $i++) {
    $stop_date = date('Y-m-d', strtotime($date . '+'.$i.' day'));
    $table_data_temp[] = Get_birthsday_users_for_one_day($pdo, $stop_date);
}

foreach ($table_data_temp as $temp_item) {
    foreach($temp_item as $item) {
        $table_data_7[] = $item;
    }
}
// echo  "<pre>";                                                    
// print_r($table_data_7);
print_users_table($table_data_7);



function Get_birthsday_users_for_one_day($pdo, $date) {
    $stmt = $pdo->prepare("SELECT * FROM `spisok`  WHERE MONTH(`born_date`) = MONTH('$date') AND  DAY(`born_date`) = DAY('$date') ORDER BY `fio` ASC");
    $stmt->execute([]);
    $table_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $table_data ;
}