<?php

function print_users_table($table_data) {
    
echo "<table class = \"resp-tab\">";
echo "<tr>";
echo "<th> пп </th>";
echo "<th> ФИО </td>";
echo "<th><a href=\"make_small_spisok.php\"> ССП </a></td>"; // Дополнительный список 300 человек
echo "<th> ДР </th>";
echo "<th> телефон </th>";
echo "<th> ДВ </th>";
echo "<th> Город </th>";
echo "<th> Оплата </th>";
echo "<th> Билеты </th>";
echo "<th> ДопИнфо </th>";
echo "<th> Коммент </th>";
echo "<th> Upd </th>";

echo "</tr>";
$i=1;
foreach ($table_data as $item ){
echo "<tr>";
echo "<td>$i</td>";
echo "<td  class=\"left_text\">".$item['fio']."</td>";
echo "<td class=\"center_text\" >".$item['small_spisok']."</td>";
echo "<td class=\"center_text\" >".$item['born_date']."</td>";
echo "<td >".$item['telephon']."</td>";
echo "<td class=\"center_text\" >".$item['date_vstuplenia']."</td>";
echo "<td class=\"center_text\" >".$item['city']."</td>";
echo "<td class=\"center_text\"> ".$item['paid']."</td>";

echo "<td class=\"center_text\"><a href=\"form_for_update_tickets_for_user.php?id={$item['id']}\"> ".$item['count_ticket']."</a></td>"; // количество приобретенных билетоы

echo "<td class=\"center_text\"> ".$item['dop_pole']."</td>";
echo "<td class=\"center_text low_width\"> ".$item['comment']."</td>";
echo "<td class=\"center_text\"> "."<a name=\"ankor-".$item['id']."\" href=\"form_for_update_one_user.php?id=".$item['id']."\">
        <img src=\"pics/update_info.jpg\"> </a>"."
        </td>";


echo "</tr>";
$i++;
}


echo "</table>";
}

function print_users_table_low_right($table_data) {
    
        echo "<table class = \"resp-tab\">";
        echo "<tr>";
        echo "<th> пп </th>";
        echo "<th> ФИО </td>";
        echo "<th> ДР </th>";
        echo "<th> телефон </th>";
        echo "<th> ДВ </th>";
        echo "<th> Город </th>";
        echo "<th> Оплата </th>";
        

        
        echo "</tr>";
        $i=1;
        foreach ($table_data as $item ){
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td  class=\"left_text\">".$item['fio']."</td>";
        echo "<td class=\"center_text\" >".$item['born_date']."</td>";
        echo "<td >".$item['telephon']."</td>";
        echo "<td class=\"center_text\" >".$item['date_vstuplenia']."</td>";
        echo "<td class=\"center_text\" >".$item['city']."</td>";
        
        echo "<td class=\"center_text\"> ".$item['paid']."</td>";
     
      
        
        
        echo "</tr>";
        $i++;
        }
}