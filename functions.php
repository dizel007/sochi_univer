<?php

function print_users_table($table_data) {
    
echo "<table id=\"main-table\" class = \"resp-tab\">";
echo "<tr>";
echo "<th> пп </th>";
echo "<th> ФИО </td>";
echo "<th><a href=\"make_small_spisok.php\"> ССП </a></td>"; // Дополнительный список 300 человек
echo "<th> ДР </th>";
echo "<th> телефон </th>";
echo "<th> ДВ </th>";
echo "<th> Город </th>";
echo "<th> Опл_24 </th>";
echo "<th> Опл_25</th>";
echo "<th> Опл_26</th>";

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
echo "<td class=\"center_text date-cell\">".$item['born_date']."</td>";
echo "<td class=\"center_text date-cell phone-cell\">".$item['telephon']."</td>";
echo "<td class=\"center_text date-cell\">".$item['date_vstuplenia']."</td>";
echo "<td class=\"center_text\" >".$item['city']."</td>";
echo "<td class=\"center_text\"> ".$item['paid_2024']."</td>";
echo "<td class=\"center_text\"> ".$item['paid_2025']."</td>";
echo "<td class=\"center_text\"> ".$item['paid']."</td>";

echo "<td class=\"center_text\"><a href=\"form_for_update_tickets_for_user.php?id={$item['id']}\" class=\"ticket-link\" title=\"Нажмите для редактирования билетов\"> ".$item['count_ticket']."</a></td>";
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
    
        echo "<table id=\"main-table\" class = \"resp-tab\">";
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
        echo "<td class=\"center_text date-cell\">".$item['born_date']."</td>";
        echo "<td class=\"center_text date-cell phone-cell\">".$item['telephon']."</td>";
        echo "<td class=\"center_text date-cell\">".$item['date_vstuplenia']."</td>";
        echo "<td class=\"center_text\" >".$item['city']."</td>";
        
        echo "<td class=\"center_text\"> ".$item['paid']."</td>";
     
      
        
        
        echo "</tr>";
        $i++;
        }
}