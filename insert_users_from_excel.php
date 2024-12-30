<?php
require_once 'connect_db.php';






$xls = PHPExcel_IOFactory::load("files/zzz.xlsx");
$xls->setActiveSheetIndex(0);
$sheet = $xls->getActiveSheet();

$j = 1;
$number = 0;
do {
  

    $temp = $sheet->getCellByColumnAndRow(1, $j)->getValue();
    // echo "$temp <br>";
    if ($temp == '') {break;}

    $arr_data[$number]['fio'] =  $sheet->getCellByColumnAndRow(1, $j)->getValue();
 
    $arr_data[$number]['born_date'] = date_excel_to_date_sql ($sheet->getCellByColumnAndRow(2, $j)->getValue());

    $arr_data[$number]['telephone'] =   $sheet->getCellByColumnAndRow(3, $j)->getValue();
    $arr_data[$number]['date_vstuplenia'] =    date_excel_to_date_sql ($sheet->getCellByColumnAndRow(4, $j)->getValue());
    $arr_data[$number]['city'] =   $sheet->getCellByColumnAndRow(5, $j)->getValue();
    $arr_data[$number]['paid'] =   $sheet->getCellByColumnAndRow(6, $j)->getValue();
   


 $number++;
 $j++;

} while ($temp != '');






// echo "$viruchka"."<br>";

echo "<pre>";


print_r($arr_data);


foreach ($arr_data as $item_for_update) {


$sql = "INSERT INTO `spisok` SET     `fio` = :fio, 
                                `born_date` = :born_date, 
                                `telephon` = :telephon, 
                                `city` = :city, 
                                `date_vstuplenia` = :date_vstuplenia,
                                `paid` = :paid";

$stmt = $pdo->prepare($sql);

$stmt->execute(array('fio'     => $item_for_update['fio'],
                     'born_date'     => $item_for_update['born_date'],
                     'telephon'   => $item_for_update['telephone'],
                     'city'   => $item_for_update['city'],
                     'date_vstuplenia' => $item_for_update['date_vstuplenia'],
                     'paid'   => $item_for_update['paid']));

$info = $stmt->errorInfo();
print_r($info);
}




die();


function date_excel_to_date_sql ( $excel_date) {
   if ($excel_date == '') return '';

    $processDate = $excel_date - 25569;
    $dateVal = strtotime("+$processDate days", mktime(0,0,0,1,1,1970));
    $dateVal = date('Y-m-d',$dateVal);

    return $dateVal;
}