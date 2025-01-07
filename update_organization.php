<?php
global $pdo;
session_start();
require 'db.php';
$id_city = $_POST['id_city'];
$name = $_POST['name'];
$link = $_POST['link'];
$account=$_POST['account'];
$login = $_POST['login'];
$pass=$_POST['pass'];
$address = $_POST['address'];
$contact = $_POST['contact'];

if ((int)$_POST['id']>0) {
    $id = $_POST['id'];
    $sql = "UPDATE organizations SET  id_city=:id_city,  name =:name, link=:link, account=:account, login=:login, pass=:pass, address = :address, contact = :contact WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_city'=>$id_city, 'name' => $name, 'link'=>$link, 'account'=>$account, 'login'=>$login, 'pass'=>$pass, 'address' => $address, 'contact' => $contact, 'id' => $id]);
} else {
    $sql = "INSERT INTO organizations (user_id, id_city, name, link, account, login, pass, address, contact)
                             VALUES (:user_id,:id_city ,:name, :link, :account,:login,:pass, :address, :contact)";
    $stmt = $pdo->prepare($sql);
    //var_dump($_SESSION);
    $stmt->execute(['user_id'=>$_SESSION['user_id'], 'id_city'=>$id_city, 'name' => $name, 'link'=>$link,'account'=>$account, 'login'=>$login, 'pass'=>$pass, 'address' => $address, 'contact' => $contact]);
}
header("Location: index.php");
?>


