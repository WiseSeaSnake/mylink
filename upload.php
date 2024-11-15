<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";

    // Получаем текущее время и форматируем его для имени файла
    $dateTime = new DateTime();
    $formattedDateTime = $dateTime->format('Ymd_His'); // Формат: ГГГГММДД_ЧЧММСС
    $imageFileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

    // Создаем имя файла с датой и временем
    $target_file = $target_dir . $formattedDateTime . '.' . $imageFileType;
    $uploadOk = 1;
    $maxFileSize = 5 * 1024 * 1024; // Максимальный размер файла 5 МБ

    // Проверка на наличие файла
    if (empty($_FILES["file"]["name"])) {
        echo "Ошибка: Вы не выбрали файл.<br>";
        $uploadOk = 0;
    }

    // Проверка размера файла
    if ($_FILES["file"]["size"] > $maxFileSize) {
        echo "Ошибка: Файл слишком большой. Максимальный размер: 5 МБ.<br>";
        $uploadOk = 0;
    }

    // Проверка типа файла
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedTypes)) {
        echo "Ошибка: Только файлы форматов JPG, JPEG, PNG и GIF допускаются.<br>";
        $uploadOk = 0;
    }

    // Проверка, является ли файл изображением
    $is_image = getimagesize($_FILES["file"]["tmp_name"]);
    if ($is_image === false) {
        echo "Ошибка: Файл не является изображением.<br>";
        $uploadOk = 0;
    }

    // Создание папки для загрузок, если она не существует
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Если все проверки пройдены, загружаем файл
    if ($uploadOk == 1) {
        // Проверка на существование файла
        if (file_exists($target_file)) {
            echo "Ошибка: Файл с таким именем уже существует.<br>";
        } else {
            // Перемещение загруженного файла
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "Файл " . htmlspecialchars(basename($target_file)) . " был успешно загружен.<br>";
            } else {
                echo "Ошибка: Произошла ошибка при загрузке файла.<br>";
            }
        }
    } else {
        echo "Ошибка: Загрузка файла отменена из-за вышеуказанных ошибок.<br>";
    }
} else {
    echo "Ошибка: Некорректный запрос.<br>";
}
?>