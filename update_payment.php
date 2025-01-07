<?php
global $pdo;
require 'db.php';



$id = $_POST['pay_id'];
$year = $_POST['year'];
$month= $_POST['month'];
$amount = $_POST['amount'];
$date = $_POST['date'];
$org_id = $_POST['org_id'];

$target_dir = "receipt/";
if (!is_dir($target_dir)) {mkdir($target_dir, 0777, true);}
$target_dir = $target_dir . $year. "/";
if (!is_dir($target_dir)) {mkdir($target_dir, 0777, true);}
$target_dir = $target_dir . trim($month) . "/";
if (!is_dir($target_dir)) {mkdir($target_dir, 0777, true);}

$targetExt = pathinfo($_FILES['receipt']['name'], PATHINFO_EXTENSION);
$targetFile = sprintf('s-%s-%04d-%02d.%s', getOrgName($org_id), $year, $month, $targetExt);

$invoiceExt = pathinfo($_FILES['payment_invoice']['name'], PATHINFO_EXTENSION);
$invoiceFile = sprintf('k-%s-%04d-%02d.%s', getOrgName($org_id), $year, $month, $targetExt);
/*
var_dump($target_dir);
var_dump($targetFile);
var_dump($invoiceFile);*/

if ((int)$id>0 ){
    $param= ['year'=>$year,'month'=>$month, 'amount' => $amount, 'date' => $date, 'id' => $id];
    $sql="UPDATE payments SET year= :year, month= :month,amount = :amount, date = :date";
    if ($_FILES["receipt"]["name"]) {
        $sql.=", receipt = :receipt";
        $param['receipt'] = $target_dir . $targetFile;
        //var_dump($sql, $param);
        move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_dir . $targetFile);
    }
    if ($_FILES["payment_invoice"]["name"]) {
        $sql.=", payment_invoice = :payment_invoice";
        $param['payment_invoice'] = $target_dir . $invoiceFile;
        //var_dump($sql, $param);
        move_uploaded_file($_FILES["payment_invoice"]["tmp_name"], $target_dir . $invoiceFile);
    }
    $sql  .= " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($param);

} else {

    $sqlInsert="INSERT INTO payments (organization_id, year, month, amount, date";
    $sqlValues=") VALUES (:organization_id, :year, :month, :amount, :date";
    $param=['organization_id' => $org_id, 'year'=>$year, 'month'=>$month, 'amount' => $amount, 'date' => $date];
    if ($_FILES["receipt"]["name"]) {
        move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_dir.$targetFile);
        $sqlInsert .= ", receipt";
        $sqlValues.=", :receipt";
        $param['receipt'] = $target_dir . $targetFile;
    }
    if ($_FILES["payment_invoice"]["name"]) {
        $sqlInsert.=", payment_invoice";
        $sqlValues.=", :payment_invoice";
        $param['payment_invoice'] = $target_dir . $invoiceFile;
        //var_dump($sql, $param);
        move_uploaded_file($_FILES["payment_invoice"]["tmp_name"], $target_dir . $invoiceFile);
    }
    $sql=$sqlInsert . $sqlValues . ");";
    var_dump($sql);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($param);
}
header("Location: payments.php?org_id=" . $org_id);
?>
