<?php


require_once 'connect_db.php';

if ($userdata['admin_user'] <> 1) {
    header('Location: index.php', true, 301);
    exit();
}


$id = $_GET['id'];
// Вычитываем данные по пользователю
$stmt = $pdo->prepare("SELECT * FROM `spisok` WHERE `id` = $id ");
$stmt->execute([]);
$data_user = $stmt->fetchAll(PDO::FETCH_ASSOC);

$fio = $data_user[0]['fio'];
$born_date = $data_user[0]['born_date'];
$telephon = $data_user[0]['telephon'];
$city = $data_user[0]['city'];
$date_vstuplenia = $data_user[0]['date_vstuplenia'];
$paid = $data_user[0]['paid'];
$dop_pole = $data_user[0]['dop_pole'];
$comment = $data_user[0]['comment'];
$count_ticket_in_db = $data_user[0]['count_ticket'];

$date_now = date('Y-m-d');




// echo "<pre>";
// print_r($data_user_tickets);

// Если есть признак, что вернулись из формы добавления билетов, то ->
if (isset($_GET['priz'])) {
    if (($_GET['priz'] == 'ready_for_update_tickets')) {
        // обновляем количество полученных билетов
        $count_ticket_for_spisok = $count_ticket_in_db + $_GET['count_ticket'];
        $count_ticket = $_GET['count_ticket'];
        $sql = "UPDATE `spisok` SET `count_ticket` = :count_ticket WHERE `id` = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array('count_ticket' => $count_ticket_for_spisok));

        // Добавляем в таблицу билетов данные, о получении билетов
        $count_ticket = $_GET['count_ticket'];
        $date_ticket = $_GET['date_ticket'];
        $id_user = $id;   
        $nazvanie_meropriatia = $_GET['nazvanie_meropriatia'];
     
        
            $sql = "INSERT INTO `tickets` SET 
            `id_user` = :id_user, 
            `count_ticket` = :count_ticket, 
            `date_ticket` = :date_ticket,
            `nazvanie_meropriatia` = :nazvanie_meropriatia";
        
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute(array('id_user'  => $id_user,
        'count_ticket'     => $count_ticket,
        'date_ticket'   => $date_ticket,
        'nazvanie_meropriatia' => $nazvanie_meropriatia
                
        ));
    }
}

// Вычитываем данные по билетам
$stmt = $pdo->prepare("SELECT * FROM `tickets` WHERE `id_user` = $id ");
$stmt->execute([]);
$data_user_tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);




echo <<<HTML
 <link rel="stylesheet" href="css/tickets_table.css">

<div class="wrapper">
  <form action="#" class="login" method="get">
  <input type="hidden"  name="id"  value = "$id">
  <input type="hidden"  name="priz"  value = "ready_for_update_tickets">
   
    <p class=" update_user title">Добавить билеты участнику: $fio</p>
    
    <i class="fa fa-user">Дата получения билетов</i>
    <input required type="date" placeholder="$date_now" name="date_ticket" value = "$date_now"/>
   
       
    <i class="fa fa-user">Количество билетов</i>
    <input required type="number" placeholder="Количество билетов" name="count_ticket" value = ""/>
   
    <i class="fa fa-user">Название мероприятия </i>
    <input type="text" placeholder="Название мероприятия" name="nazvanie_meropriatia" value = ""/>
   
   
    <button>
      <i class="spinner"></i>
      <span class="state">обновить данные по билетам</span>
    </button>

  </form>


  </p>
<a href="index.php#ankor-$id">Вернуться на главную станицу</a>

</div>

HTML;


echo <<<HTML

<div class="wrapper">
 <table class="resp-tab center_text">
<tr>

<th>пп</th>
<th>Дата</th>
<th>Кол-во билетов</th>
<th>Мероприятие</th>
</tr>
HTML;
$i=1;
foreach  ($data_user_tickets as $tickets)  {
    echo "<tr>";    
echo "<td>$i</td>";
echo "<td>{$tickets['date_ticket']}</td>";
echo "<td>{$tickets['count_ticket']}</td>";
echo "<td>{$tickets['nazvanie_meropriatia']}</td>";
echo "</tr>";    
$i++;
}


echo <<<HTML
</table>
     
    
</div>

HTML;
