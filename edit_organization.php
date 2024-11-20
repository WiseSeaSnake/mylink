<?php global$pdo; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать организацию</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Редактировать организацию</h1>
    <?php
    require 'db.php';
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM organizations WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $organization = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <form action="update_organization.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $organization['id']; ?>">
        <div class="form-group">
            <label for="name">Название:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $organization['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Адрес:</label>
            <input type="text" id="address" name="address" class="form-control" value="<?php echo $organization['address']; ?>" required>
        </div>
        <div class="form-group">
            <label for="contact">Контакт:</label>
            <input type="text" id="contact" name="contact" class="form-control" value="<?php echo $organization['contact']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="index.php" class="btn btn-secondary">Назад к списку организаций</a>
    </form>
</div>
</body>
</html>