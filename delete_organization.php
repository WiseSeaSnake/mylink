<?php
global $pdo;
require 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM organizations WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: index.php");
?>