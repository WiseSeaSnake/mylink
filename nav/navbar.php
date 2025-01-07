    <?php
   /* ob_start();
   session_start();*/
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Устанавливаем цвет фона навигационной панели */
        .navbar-custom {
            background-color: #28A4E5;
            padding: 0;
        }

        .navbar-nav .nav-link:hover {
           background-color: #1e7cba; /* Цвет текста при наведении */

        }

        .dropdown-menu {
            background-color: #28A4E5; /* Цвет фона выпадающего меню */
        }

        /* Цвет элементов выпадающего меню при наведении */
        .dropdown-item:hover {
            background-color: #1e7cba; /* Цвет фона при наведении */
        }

        /* Меняем цвет кнопки при наведении */
        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Прозрачный белый фон при наведении */
        }
    </style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="img/logo.png" alt="Логотип" style="width: 40px; height: 40px; margin-right: 5px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Переключить навигацию">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php?action=about">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Мероприятия</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Фото</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Видео</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Музыка</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Контакты</a>
                </li>
            </ul>
            <!-- Правый блок меню -->

            <ul class="navbar-nav navbar-right">
            <?php
            var_dump($_SESSION);
               if ($_SESSION['role'] == 'admin') {?>
                   <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Админка
                       </a>
                       <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                           <a class="dropdown-item" href="../admin/users.php" target="_blank">Юзвери</a>
                           <a class="dropdown-item" href="../admin/posts.php?id=1" target="_blank">Лента</a>
                           <a class="dropdown-item" href="#">Левая</a>
                           <!--div class="dropdown-divider"></div-->
                           <a class="dropdown-item" href="#">Правая</a>
                       </div>
                   </li>
            <?php ;}
                if ($_SESSION['role'] == 'admin' or $_SESSION['role'] == 'user') {?>
                <li class="nav-item">
                    <!--a class="nav-link" href="#"><?php echo $_SESSION['username']; ?></a-->
                    <a class="nav-link" href="../admin/users.php" target="_blank"><?php echo $_SESSION['username']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="../admin/logout.php" class="btn btn-outline-light" role="button">Выход</a> <!-- Перенаправление на login.php -->
                </li>

                <?php ;} else {?>
                <li class="nav-item">
                    <a href="../admin/login.php" class="btn btn-outline-light" role="button">Вход</a> <!-- Перенаправление на login.php -->
                </li>
                <?php } ?>



            </ul>
        </div>
   </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
