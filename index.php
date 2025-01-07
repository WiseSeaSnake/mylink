<?php
require 'db.php';
session_start();
global  $pdo; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Учет платежей</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>


    </style>
</head>
<body>
<?php
//include "header/header.php";
include "nav/navbar.php";
?>
<div class="container mt-5">
    <h1>Платежи</h1>
    <a href="edit_organization.php?id=0" class="btn btn-primary mb-3" <?php
          echo ($_SESSION['role']=="admin" || $_SESSION['role']=="admin") ? "" : " hidden ";  ?>>  Добавить расчетный счет</a>
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th>Город</th>
            <th>Название</th>
            <!--th>Адрес</th>
            <th>Контакт</th-->
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $user_id=$_SESSION['user_id'];
        if ($user_id>0){
            $stmt = $pdo->query("SELECT o.id_city,o.id as id, c.name as city_name, o.name as name FROM organizations as o, city as c
                                       WHERE o.id_city=c.id_city and o.user_id=$user_id
                                       order by c.name,o.name;");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                            <td>{$row['city_name']}</td>
                            <td>{$row['name']}</td>
                            <!--td>{$row['address']}</td>
                            <td>{$row['contact']}</td-->
                            <td>
                                <a href='edit_organization.php?id={$row['id']}' class='btn btn-warning'>Редактировать</a>
                                <a href='payments.php?id={$row['id']}&org_id={$row['id']}' class='btn btn-info'>Платежи</a>
                                <a href='delete_organization.php?id={$row['id']}' class='btn btn-danger'>Удалить</a>
                                
                            </td>
                          </tr>";
            }

        }

        ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>