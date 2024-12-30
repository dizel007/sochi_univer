<?php


require_once 'connect_db.php';

if ($userdata['admin_user'] <> 1){
  header('Location: index.php', true, 301);
  exit();
}

// echo "<pre>";
// print_r($data_user);


echo <<<HTML
 <link rel="stylesheet" href="css/input_new_user.css">


<div class="wrapper">
  <form action="insert_one_user_insert.php" class="login" method="get">
    <p class="insert_user title">Добавление нового пользователя</p>
    <i class="fa fa-user">ФИО</i>
    <input required type="text" placeholder="ФИО"  name="fio" required autofocus/>
   

    <i class="fa fa-user">Дата рождения</i>
    <input type="date" placeholder="Дата рождения" name="born_date" />
   


    <i class="fa fa-user">Телефон</i>
    <input type="text" placeholder="Телефон"name="telephon" />
   
    <i class="fa fa-user">Город</i>
    <input type="text" placeholder="Город"name="city" />
   
   
    <i class="fa fa-user">Дата вступления</i>
    <input type="date" placeholder="Дата вступления" name="date_vstuplenia" />
   
    <i class="fa fa-user">Оплата</i>
    <input type="number" placeholder="Оплата" name="paid" />
   
   
    <i class="fa fa-user">Доп. поле</i>
    <input type="text" placeholder="Доп. поле" name="dop_pole" />
   
   
    <i class="fa fa-user">Комментарий</i>
    <input type="text" placeholder="Комментарий" name="comment" />
   
   
    <button>
      <i class="spinner"></i>
      <span class="state">Добавить участника</span>
    </button>
  </form>
  </p>
<a href="index.php"> Вернуться на главную станицу</a>
</div>

HTML;

