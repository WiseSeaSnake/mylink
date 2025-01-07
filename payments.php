<?php
require 'db.php';
$org_id = $_GET['org_id'];


global $pdo;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Платежи организации</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <style>
        /* Стили для модального окна */
        .modal {
            display: none; /* Скрыто по умолчанию */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            text-align: center;
        }

        .modal-content img {
            max-width: 100%;
            height: auto;
        }

        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        .download-btn {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .download-btn:hover {
            background-color: #45a049;
        }
    </style>

    <script>
        async function copyToClipboard(i) {

            const textToCopy = document.getElementById(i).value;
            try {
                await navigator.clipboard.writeText(textToCopy);
                alert("Скопировано в буфер обмена: " + textToCopy);
            } catch (err) {
                console.error("Ошибка при копировании: ", err);
            }
        }

        function openModal(imageUrl) {
            document.getElementById("modalImage").src = imageUrl; // Устанавливаем источник изображения
            document.getElementById("downloadLink").href = imageUrl; // Устанавливаем ссылку для скачивания
            document.getElementById("myModal").style.display = "block"; // Показываем модальное окно
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none"; // Скрываем модальное окно
        }

        // Закрытие модального окна при клике вне его
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <?php
            $stmt = $pdo->prepare("SELECT * FROM organizations WHERE id = :id");
            $stmt->execute(['id' => $org_id]);
            $org = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <h1><a href=<?php echo $org['link']; ?>><?php echo $org['name']; ?></a></h1>


        <div class="input-group">
            <span class="input-group-text">Лицевой счет</span>
            <input type="text" aria-label="Лицевой счет" class="form-control" name="account" id="account" value=<?php echo $org['account'] ?>>
            <button class="btn btn-outline-secondary" onclick="copyToClipboard('account')"><i class="fas fa-copy"></i></button>

            <span class="input-group-text">Логин</span>
            <input type="text" aria-label="Логин" class="form-control" name="login" id="login" value=<?php echo $org['login'] ?>>
            <button class="btn btn-outline-secondary" onclick="copyToClipboard('login')"><i class="fas fa-copy"></i></button>

            <span class="input-group-text">Пароль</span>
            <input type="text" aria-label="Логин" class="form-control" name="pass" id="pass" value=<?php echo $org['pass'] ?>>
            <button class="btn btn-outline-secondary" onclick="copyToClipboard('pass')"><i class="fas fa-copy"></i></button>
        </div>
        <br>


        <a href="edit_payment.php?pay_id=0&org_id=<?php echo $org_id; ?>" class="btn btn-primary mb-3">Добавить платеж</a>
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>Сумма</th>
                <th>Дата</th>
                <th>Счет</th>
                <th>Чек</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $stmt = $pdo->prepare("SELECT * FROM payments WHERE organization_id = :organization_id");
            $stmt->execute(['organization_id' => $org_id]);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                                <td>{$row['amount']}</td>
                                <td>{$row['date']}</td>
                             
                                <td><a href='{$row['payment_invoice']}'><avatars src='{$row['payment_invoice']}' width='100px' alt=''></a></td>
                                <td><a href='{$row['receipt']}'><avatars src='{$row['receipt']}' width='100px' alt=''></a></td>
                                
                                
                                <td>
                                    
                                    <a href='edit_payment.php?pay_id={$row['id']}&org_id={$row['organization_id']}' class='btn btn-warning'>Редактировать</a>
                                    <a href='delete_payment.php?id={$row['id']}' class='btn btn-danger'>Удалить</a>
                                </td>
                              </tr>";
            }
            ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Назад к списку организаций</a>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="Modal Image">
            <br>
            <a id="downloadLink" class="download-btn" download>Сохранить изображение</a>
        </div>
    </div>


</body>
</html>