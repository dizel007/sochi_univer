<?php
require_once 'connect_db.php';

require_once 'PHPExcel-1.8/Classes/PHPExcel.php';
require_once 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';
require_once 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';


    $xls = new PHPExcel();
    $xls->setActiveSheetIndex(0);
    $sheet = $xls->getActiveSheet();
    $sheet->setTitle('Список НУ');
    $sheet->getColumnDimension("A")->setWidth(7);
    $sheet->getColumnDimension("B")->setWidth(78);
    

    $sheet->setCellValue("A1", "пп");
    $sheet->setCellValue("B1", "ФИО");
    
$i=2;
// делаем выборку всех участников
$stmt = $pdo->prepare("SELECT * FROM `spisok` WHERE `delete_user` <> 1 ORDER BY `fio` ASC");
$stmt->execute([]);
$table_data = $stmt->fetchAll(PDO::FETCH_ASSOC);


$pp_number = 1;
foreach ($table_data as $user) {
    $sheet->setCellValue("A".$i, $pp_number);
    $sheet->setCellValue("B".$i, $user['fio']);
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
$sheet->getStyle("A1:B".$i)->applyFromArray($border);



    $objWriter = new PHPExcel_Writer_Excel2007($xls);
    $file_path = 'report/file.xlsx';
    $objWriter->save($file_path);



    ob_end_clean();
 
    $file = 'report/file.xlsx';
     
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($file));
     
    readfile($file);
    exit();


