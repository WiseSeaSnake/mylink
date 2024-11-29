<?php global$pdo;
require 'db.php';?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать организацию</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script>
        function saveCity() {
            var select = document.getElementById("citySelect");

            document.getElementById("id_city").value=select.options[select.selectedIndex].value;
          //  document.getElementById("id_city").value=document.getElementById("citySelect").options[select.selectedIndex].value;
           // alert("Выбран герой: " + select.options[select.selectedIndex].value);
        }
    </script>

</head>
<body>
<div class="container mt-5">

    <?php

        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM organizations WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $organization = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($id==0) {
            echo "<h1>Добавить организацию</h1>";
            $cur_city=2;
        }
        else {
            echo "<h1>Редактировать организацию</h1>";
            $cur_city=$organization['id_city'];
        }
    ?>


    <form action="update_organization.php" method="POST">

        <input name="id" value="<?php echo $organization['id']; ?>">
        <input name="id_city" id="id_city"  value="<?php echo $cur_city; ?>">
        <div class="form-group">
            <label for="citySelect">Город:</label>
            <select id="citySelect" class="form-control" onchange="saveCity()">
                <?php

                $stmt = $pdo->prepare("SELECT * FROM city ORDER BY name");
                var_dump($stmt);
                $stmt->execute();
                while ($cities = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  if ($cities['id_city']==$cur_city) {
                      echo "<option value=" . $cities['id_city'] . " selected>" . $cities['name'] ."</option>";

                  } else {
                      echo "<option value=" . $cities['id_city'] .">" . $cities['name'] ."</option>";
                  }
                }
                ?>
            </select>
        <div class="form-group">

            <label for="name">Название:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $organization['name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="link">Сайт:</label>
            <input type="text" id="link" name="link" class="form-control" value="<?php echo $organization['link']; ?>">
        </div>
        <div class="form-group">
            <label for="account">Адрес:</label>
            <input type="text" id="account" name="account" class="form-control" value="<?php echo $organization['account']; ?>">
        </div>
        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text" id="login" name="login" class="form-control" value="<?php echo $organization['login']; ?>">
        </div>
        <div class="form-group">
            <label for="pass">Пароль:</label>
            <input type="text" id="pass" name="pass" class="form-control" value="<?php echo $organization['pass']; ?>">
        </div>
        <div class="form-group">
            <label for="address">Адрес:</label>
            <input type="text" id="address" name="address" class="form-control" value="<?php echo $organization['address']; ?>">
        </div>
        <div class="form-group">
            <label for="contact">Контакт:</label>
            <input type="text" id="contact" name="contact" class="form-control" value="<?php echo $organization['contact']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="index.php" class="btn btn-secondary">Назад к списку организаций</a>
    </form>
</div>
</body>
</html>