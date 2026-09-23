<?php
require_once 'connect_db.php';

require_once 'PHPExcel-1.8/Classes/PHPExcel.php';
require_once 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';
require_once 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';


    $xls = new PHPExcel();
    $xls->setActiveSheetIndex(0);
    $sheet = $xls->getActiveSheet();
    $sheet->setTitle('Дни рождения');
    $sheet->getColumnDimension("A")->setWidth(7);
    $sheet->getColumnDimension("B")->setWidth(78);
      $sheet->getColumnDimension("C")->setWidth(18);
      $sheet->getColumnDimension("D")->setWidth(18);

    $sheet->setCellValue("A1", "пп");
    $sheet->setCellValue("B1", "ФИО");
    $sheet->setCellValue("C1", "дата рождения");
    $sheet->setCellValue("D1", "телефон");
    
$i=2;
// делаем выборку всех участников
$Year = date('Y');
$month = date('m', strtotime('+1 month'));

// Количество дгнй
$day_count = cal_days_in_month(CAL_GREGORIAN, $month, date('Y')); 
// дата начала
$start_date = date('Y')."-".$month."-01";
// дата конца
$stop_date = date('Y')."-".$month."-".$day_count;


for ($isd = 1; $isd <= $day_count; $isd++) {
    $one_date = date('Y')."-".$month."-".$isd;
    $table_data_temp[] = Get_birthsday_users_for_one_day($pdo, $one_date);
}

foreach ($table_data_temp as $temp_item) {
    foreach($temp_item as $item) {
        $table_data[] = $item;
    }
}
// echo  "<pre>";                                                    
// print_r($table_data_7);



/***************************
 * выбиаем именниннокв
 **********************/
function Get_birthsday_users_for_one_day($pdo, $date) {
    $stmt = $pdo->prepare("SELECT * FROM `spisok`  WHERE `delete_user` <> 1 AND MONTH(`born_date`) = MONTH('$date') AND  DAY(`born_date`) = DAY('$date') ORDER BY `fio` ASC");
    $stmt->execute([]);
    $table_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $table_data ;
}

// echo "<pre>";
// print_r($table_data);
// die();
$pp_number = 1;
foreach ($table_data as $user) {
    $sheet->setCellValue("A".$i, $pp_number);
    $sheet->setCellValue("B".$i, $user['fio']);
    $sheet->setCellValue("C".$i, $user['born_date']);
    $sheet->setCellValue("D".$i, $user['telephon']);
    $pp_number ++;
$i++;
}

// границы таблицы

$border = array(
	'borders'=>array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => '000000')
		)
	)
);
 $i--;
$sheet->getStyle("A1:D".$i)->applyFromArray($border);



    $objWriter = new PHPExcel_Writer_Excel2007($xls);
    $file_path = 'report/file_month_birthday.xlsx';
    $objWriter->save($file_path);



    ob_end_clean();
 
    $file = 'report/file_month_birthday.xlsx';
     
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($file));
     
    readfile($file);
    exit();


