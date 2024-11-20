<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить платеж</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Добавить платеж</h1>
    <form action="save_payment.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="organization_id" value="<?php echo $_GET['id']; ?>">
        <div class="form-group">
            <label for="amount">Сумма:</label>
            <input type="number" id="amount" name="amount" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date">Дата:</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="receipt">Чек:</label>
            <input type="file" id="receipt" name="receipt" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="payments.php?id=<?php echo $_GET['id']; ?>" class="btn btn-secondary">Назад к платежам</a>
    </form>
</div>
</body>
</html>