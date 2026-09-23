<?php

require_once 'connect_db.php';

if ($userdata['admin_user'] <> 1) {
    header('Location: index.php', true, 301);
    exit();
}

$id = $_GET['id'];

// echo "<pre>";
// print_r($_GET);

if (isset($_GET['priz']) && $_GET['priz'] == 'ready_for_update') {
  // echo "ddddddddddddddddd";

  // die();

    $fio = $_GET['fio'];
    $born_date = $_GET['born_date'];
    $telephon = $_GET['telephon'];
    $city = $_GET['city'];
    $date_vstuplenia = $_GET['date_vstuplenia'];
    $paid = $_GET['paid'];
    $dop_pole = $_GET['dop_pole'];
    $comment = $_GET['comment'];
    $small_spisok = $_GET['small_spisok'];

    $sql = "UPDATE `spisok` SET 
            `fio` = :fio, 
            `born_date` = :born_date, 
            `telephon` = :telephon, 
            `city` = :city, 
            `date_vstuplenia` = :date_vstuplenia,
            `paid` = :paid,
            `dop_pole` = :dop_pole,
            `small_spisok` = :small_spisok,
            `comment` = :comment 
            WHERE `id` = $id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'fio'             => $fio,
        'born_date'       => $born_date,
        'telephon'        => $telephon,
        'city'            => $city,
        'date_vstuplenia' => $date_vstuplenia,
        'paid'            => $paid,
        'dop_pole'        => $dop_pole,
        'small_spisok'    => $small_spisok,
        'comment'         => $comment,
    ]);
}

$stmt = $pdo->prepare("SELECT * FROM `spisok` WHERE `id` = $id");
$stmt->execute();
$data_user = $stmt->fetchAll(PDO::FETCH_ASSOC);

$fio           = $data_user[0]['fio'];
$born_date     = $data_user[0]['born_date'];
$telephon      = $data_user[0]['telephon'];
$city          = $data_user[0]['city'];
$date_vstuplenia = $data_user[0]['date_vstuplenia'];
$paid          = $data_user[0]['paid'];
$dop_pole      = $data_user[0]['dop_pole'];
$small_spisok  = $data_user[0]['small_spisok'];
$comment       = $data_user[0]['comment'];

echo <<<HTML
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/input_new_user.css">
    <title>Редактирование участника</title>
</head>
<body>

<div class="wrapper">
    <!-- ССЫЛКА НАЗАД (теперь вверху) -->
    <a href="index.php#ankor-$id" class="back-link">← Вернуться на главную страницу</a>

    <form action="#" class="login" method="get">
        <input type="hidden" name="id" value="$id">
        <input type="hidden" name="priz" value="ready_for_update">
       
        <p class="title">Редактирование данных участника</p>

        <div class="label_text">ФИО</div>
        <input type="text" placeholder="ФИО" name="fio" value="$fio" autofocus>

        <div class="label_text">Добавить участника в мини список 300 человек</div>
        <select name="small_spisok">
HTML;

if ($small_spisok == 1) {
    echo "<option selected value=\"1\">ДА</option>";
    echo "<option value=\"0\">НЕТ</option>";
} else {
    echo "<option value=\"1\">ДА</option>";
    echo "<option selected value=\"0\">НЕТ</option>";
}

echo <<<HTML
        </select>

        <i>Дата рождения</i>
        <input type="date" name="born_date" value="$born_date">

        <i>Телефон</i>
        <input type="text" placeholder="Телефон" name="telephon" value="$telephon">

        <i>Город</i>
        <input type="text" placeholder="Город" name="city" value="$city">

        <i>Дата вступления</i>
        <input type="date" name="date_vstuplenia" value="$date_vstuplenia">

        <i>Оплата</i>
        <input type="number" placeholder="Оплата" name="paid" value="$paid">

        <i>Доп. поле</i>
        <input type="text" placeholder="Доп. поле" name="dop_pole" value="$dop_pole">

        <i>Комментарий</i>
        <input type="text" placeholder="Комментарий" name="comment" value="$comment">

        <button type="submit">
            <span class="state">💾 Сохранить изменения</span>
        </button>

        <!-- Разделитель и кнопка удаления -->
        <div class="delete-section">
            <a href="delete_one_user.php?id=$id" 
               onclick="return confirm('Вы уверены, что хотите удалить участника {$fio}?');" 
               class="delete-link">
                🗑 Удалить участника
            </a>
        </div>
    </form>
</div>

</body>
</html>
HTML;
?>