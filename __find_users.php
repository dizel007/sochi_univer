<?php


require_once 'connect_db.php';
require_once 'functions.php';

echo <<<HTML
 <link rel="stylesheet" href="css/main_table.css">
HTML;



if (isset($_GET['fio'])) {
 $fio = $_GET['fio'];   
} else {
    $fio = ''; 
}




echo <<<HTML
 <link rel="stylesheet" href="css/input_new_user.css">



<div class="wrapper_30">
  <form action="find_users.php" class="login_30" method="get">
    <p class = "update_user title"> Найти участника</p>
     <div class="label_text"></div>
        <input type="text" placeholder="ФИО или телефон"  name="fio"  value = "$fio" autofocus/>
      <button>
          <i class="spinner"></i>
          <span class="state">Найти участников</span>
    </button>
  </form>
  </p>
</div>

HTML;



$stmt = $pdo->prepare("SELECT *
FROM `spisok`
WHERE (`fio` LIKE '%$fio%' 
   OR REPLACE(`telephon`, ' ', '') LIKE '%$fio%')
  AND `delete_user` <> 1
ORDER BY `fio` ASC;");
$stmt->execute([]);
$table_data = $stmt->fetchAll(PDO::FETCH_ASSOC);



print_users_table($table_data);
