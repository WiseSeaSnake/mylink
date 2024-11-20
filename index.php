<?php global  $pdo; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Учет платежей</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Список организаций</h1>
    <a href="add_organization.php" class="btn btn-primary mb-3">Добавить организацию</a>
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th>Название</th>
            <th>Адрес</th>
            <th>Контакт</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require 'db.php';
        $stmt = $pdo->query("SELECT * FROM organizations");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['contact']}</td>
                            <td>
                                <a href='edit_organization.php?id={$row['id']}' class='btn btn-warning'>Редактировать</a>
                                <a href='payments.php?id={$row['id']}' class='btn btn-info'>Платежи</a>
                                <a href='delete_organization.php?id={$row['id']}' class='btn btn-danger'>Удалить</a>
                            </td>
                          </tr>";
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