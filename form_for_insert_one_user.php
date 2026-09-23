<?php

require_once 'connect_db.php';

if ($userdata['admin_user'] <> 1) {
    header('Location: index.php', true, 301);
    exit();
}

echo <<<HTML
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/input_new_user.css">
    <title>Добавление участника</title>
</head>
<body>

<div class="wrapper">
    <form action="insert_one_user_insert.php" class="login" method="get">
        <p class="title">Добавление нового пользователя</p>

        <i>ФИО</i>
        <input required type="text" placeholder="ФИО" name="fio" autofocus>

        <i>Дата рождения</i>
        <input type="date" placeholder="Дата рождения" name="born_date">

        <i>Телефон</i>
        <input type="text" placeholder="Телефон" name="telephon">

        <i>Город</i>
        <input type="text" placeholder="Город" name="city">

        <i>Дата вступления</i>
        <input type="date" placeholder="Дата вступления" name="date_vstuplenia">

        <i>Оплата</i>
        <input type="number" placeholder="Оплата" name="paid">

        <i>Доп. поле</i>
        <input type="text" placeholder="Доп. поле" name="dop_pole">

        <i>Комментарий</i>
        <input type="text" placeholder="Комментарий" name="comment">

        <!-- Кнопка с type="submit" -->
        <button type="submit">
            <span class="state">➕ Добавить участника</span>
        </button>
    </form>

    <!-- Ссылка теперь стилизована как кнопка -->
    <a href="index.php" class="btn-back">← Вернуться на главную страницу</a>
</div>

</body>
</html>
HTML;
?>