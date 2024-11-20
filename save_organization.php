<?php
global $pdo;
require 'db.php';

$name = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];

$sql = "INSERT INTO organizations (name, address, contact) VALUES (:name, :address, :contact)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $name, 'address' => $address, 'contact' => $contact]);

header("Location: index.php");
?>