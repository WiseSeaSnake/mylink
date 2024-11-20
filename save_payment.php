<?php
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
?>