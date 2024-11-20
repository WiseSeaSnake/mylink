<?php global$pdo; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать платеж</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Редактировать платеж</h1>
    <?php
    require 'db.php';
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM payments WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $payment = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <form action="update_payment.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $payment['id']; ?>">
        <input type="hidden" name="organization_id" value="<?php echo $payment['organization_id']; ?>">
        <div class="form-group">
            <label for="amount">Сумма:</label>
            <input type="number" id="amount" name="amount" class="form-control" value="<?php echo $payment['amount']; ?>" required>
        </div>
        <div class="form-group">
            <label for="date">Дата:</label>
            <input type="date" id="date" name="date" class="form-control" value="<?php echo $payment['date']; ?>" required>
        </div>
        <div class="form-group">
            <label for="receipt">Чек:</label>
            <input type="file" id="receipt" name="receipt" class="form-control">
            <small>Текущий чек: <img src="<?php echo $payment['receipt']; ?>" alt="Receipt" style="width: 100px;"></small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="payments.php?id=<?php echo $payment['organization_id']; ?>" class="btn btn-secondary">Назад к платежам</a>
    </form>
</div>
</body>
</html>