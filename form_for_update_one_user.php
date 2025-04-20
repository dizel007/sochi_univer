<?php


require_once 'connect_db.php';

if ($userdata['admin_user'] <> 1){
  header('Location: index.php', true, 301);
  exit();
}


$id = $_GET['id'];



if (isset($_GET['priz'])) {
if (($_GET['priz'] == 'ready_for_update')) {

$fio = $_GET['fio'];
$born_date = $_GET['born_date'];
$telephon = $_GET['telephon'];
$city = $_GET['city'];
$date_vstuplenia = $_GET['date_vstuplenia'];
$paid = $_GET['paid'];
$dop_pole = $_GET['dop_pole'];
$comment = $_GET['comment'];
$small_spisok = $_GET['small_spisok'];








    $sql = "UPDATE `spisok` SET     `fio` = :fio, 
    `born_date` = :born_date, 
    `telephon` = :telephon, 
    `city` = :city, 
    `date_vstuplenia` = :date_vstuplenia,
    `paid` = :paid,
    `dop_pole` = :dop_pole,
    `small_spisok` = :small_spisok,
    `comment` = :comment 
    WHERE `id` = $id";


// print_r($sql);

$stmt = $pdo->prepare($sql);
$stmt->execute(array('fio'     => $fio,
                    'born_date'     => $born_date,
                    'telephon'   => $telephon,
                    'city'   => $city,
                    'date_vstuplenia' => $date_vstuplenia,
                    'paid'   => $paid,
                    'dop_pole'   => $dop_pole,
                    'small_spisok'   => $small_spisok,
                    'comment'   => $comment,

));

}
}

// print_r($jj);



$stmt = $pdo->prepare("SELECT * FROM `spisok` WHERE `id` = $id ");
$stmt->execute([]);
$data_user = $stmt->fetchAll(PDO::FETCH_ASSOC);



$fio = $data_user[0]['fio'];
$born_date = $data_user[0]['born_date'] ;
$telephon = $data_user[0]['telephon'];
$city = $data_user[0]['city'];
$date_vstuplenia = $data_user[0]['date_vstuplenia'];
$paid = $data_user[0]['paid'];
$dop_pole = $data_user[0]['dop_pole'];
$small_spisok = $data_user[0]['small_spisok'];
$comment = $data_user[0]['comment'];

echo <<<HTML
 <link rel="stylesheet" href="css/input_new_user.css">



<div class="wrapper">
  <form action="#" class="login" method="get">
  <input type="hidden"  name="id"  value = "$id">
  <input type="hidden"  name="priz"  value = "ready_for_update">
   
    <p class=" update_user title"> Редактирование данных участника</p>
    <div class="label_text">ФИО</div>
    <input type="text" placeholder="ФИО"  name="fio"  value = "$fio" autofocus/>

    
    <div class="label_text">Добавить участника в мини список 300 человек</div>
    <select name="small_spisok">
HTML;
// Подставляем выбранно значение в срочку
if ($small_spisok == 1) {
 echo   "<option selected value = \"1\" >ДА</option>";
 echo    "<option value = \"0\">НЕТ</option>";
} else {
  echo   "<option  value = \"1\" >ДА</option>";
  echo    "<option selected value = \"0\">НЕТ</option>";
}

echo <<<HTML
    </select>

    <i class="fa fa-user">Дата рождения</i>
    <input type="date" placeholder="Дата рождения" name="born_date" value = "$born_date"/>
   


    <i class="fa fa-user">Телефон</i>
    <input type="text" placeholder="Телефон"name="telephon" value = "$telephon"/>
   
    <i class="fa fa-user">Город</i>
    <input type="text" placeholder="Город"name="city" value = "$city"/>
   
   
    <i class="fa fa-user">Дата вступления</i>
    <input type="date" placeholder="Дата вступления" name="date_vstuplenia" value = "$date_vstuplenia"/>
   
    <i class="fa fa-user">Оплата</i>
    <input type="number" placeholder="Оплата" name="paid" value = "$paid"/>
   
   
    <i class="fa fa-user">Доп. поле</i>
    <input type="text" placeholder="Доп. поле" name="dop_pole" value = "$dop_pole"/>
   
   
    <i class="fa fa-user">Комментарий</i>
    <input type="text" placeholder="Комментарий" name="comment" value = "$comment"/>
   
   
    <button>
      <i class="spinner"></i>
      <span class="state">Изменить данные участника</span>
    </button>

  </form>


  </p>
<a href="index.php#ankor-$id">Вернуться на главную станицу</a>



</div>

HTML;

echo <<<HTML
<div class="wrapper">
  <div class="login">
      <button>
            <a class="delete_button" href="delete_one_user.php?id=$id">УДАЛИТЬ УЧАСТНИКА</a>
    </button>
</div>
</div>


HTML;

