<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Платежи организации</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Платежи для организации</h1>
    <a href="add_payment.php?id=<?php echo $_GET['id']; ?>" class="btn btn-primary mb-3">Добавить платеж</a>
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th>Сумма</th>
            <th>Дата</th>
            <th>Чек</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require 'db.php';
        $organization_id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM payments WHERE organization_id = :organization_id");
        $stmt->execute(['organization_id' => $organization_id]);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                            <td>{$row['amount']}</td>
                            <td>{$row['date']}</td>
                            <td><img src='{$row['receipt']}' alt='Receipt' style='width: 100px;'></td>
                            <td>
                                <a href='edit_payment.php?id={$row['id']}' class='btn btn-warning'>Редактировать</a>
                                <a href='delete_payment.php?id={$row['id']}' class='btn btn-danger'>Удалить</a>
                            </td>
                          </tr>";
        }
        ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary">Назад к списку организаций</a>
</div>
</body>
</html>