<?php


require_once 'connect_db.php';

$id = $_GET['id'];





$sql = "UPDATE `spisok` SET     `delete_user` = :delete_user WHERE `id` = $id";


$stmt = $pdo->prepare($sql);

$stmt->execute(array('delete_user'  => 1));


header("Location: index.php"); exit();