<?php
global $pdo;
require 'db.php';



$id = $_POST['pay_id'];
$year = $_POST['year'];
$month= $_POST['month'];
$amount = $_POST['amount'];
$date = $_POST['date'];
$org_id = $_POST['org_id'];

$target_dir = "uploads/";
if (!is_dir($target_dir)) {mkdir($target_dir);}
$target_dir = $target_dir . $year. "/";
if (!is_dir($target_dir)) {mkdir($target_dir);}
$target_dir = $target_dir . $month . "/";
if (!is_dir($target_dir)) {mkdir($target_dir);}




if ((int)$id>0 ){
    // Проверяем, загружен ли новый файл
    if ($_FILES["receipt"]["name"]) {
        // Загрузка нового файла
        $target_file = $target_dir . basename($_FILES["receipt"]["name"]);
        move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file);
        $sql = "UPDATE payments SET year= :year, month= :month,amount = :amount, date = :date, receipt = :receipt WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['year'=>$year,'month'=>$month, 'amount' => $amount, 'date' => $date, 'receipt' => $target_file, 'id' => $id]);
    } else {
        // Если файл не был загружен, просто обновляем другие поля
        $sql = "UPDATE payments SET year= :year, month= :month, amount = :amount, date = :date WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['year'=>$year,'month'=>$month,'amount' => $amount, 'date' => $date, 'id' => $id]);
    }
} else {
// Загрузка файла
    $target_file = $target_dir . basename($_FILES["receipt"]["name"]);
    move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file);

    $sql = "INSERT INTO payments (organization_id, year, month, amount, date, receipt) 
                        VALUES (:organization_id, :year, :month, :amount, :date, :receipt)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['organization_id' => $org_id, 'year'=>$year, 'month'=>$month, 'amount' => $amount, 'date' => $date, 'receipt' => $target_file]);
}

header("Location: payments.php?org_id=" . $org_id);
?>

<?php
/*
global $pdo;
require 'db.php';

$organization_id = $_POST['organization_id'];
$amount = $_POST['amount'];
$date = $_POST['date'];

// Загрузка файла
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["receipt"]["name"]);
move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file);

$sql = "INSERT INTO payments (organization_id, amount, date, receipt) VALUES (:organization_id, :amount, :date, :receipt)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['organization_id' => $organization_id, 'amount' => $amount, 'date' => $date, 'receipt' => $target_file]);

header("Location: payments.php?id=" . $organization_id);
*/
?>
