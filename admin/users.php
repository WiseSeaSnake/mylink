<?php
session_start();
require "../db.php";
global $pdo;
try {
   // $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

// Обработка удаления пользователя
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $delete_id);
    $stmt->execute();
}

// Подготовка данных для редактирования
$user = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $edit_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

$sql="SELECT * FROM users";

if (isset($_SESSION['role']) && $_SESSION['role'] == 'user' ) {
    $sql.=" WHERE id = " . $_SESSION['user_id'];
}
var_dump($sql);
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Управление пользователями</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>

    <?php
       include "../nav/navbar.php";
    /*   if (isset($_SESSION['role']) && !($_SESSION['role'] == 'admin')) {

        //   if (isset($_SESSION['role']) && (($_SESSION['role'] == 'admin') || ($_SESSION['role'] == 'user'))  ) {
      // var_dump($_SESSION['role']);
       header("Location: ../index.php");
        //  header("Location: mylink.test");
       exit();
    }*/
    ?>

    <div class="container mt-5">
        <h2><?php echo ($_SESSION['role']=="admin") ? "Пользователи" : "Информация";  ?></h2>

        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#userModal" onclick="clearForm()" <?php

        echo ($_SESSION['role']=="admin") ? "" : " hidden ";  ?>>Добавить пользователя</button>

        <!-- Таблица пользователей -->
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя пользователя</th>
                <th>Роль</th>
                <th>Аватар</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var TYPE_NAME $users */
            foreach ($users as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td>
                        <?php if ($row['avatar']): ?>
                            <img src="<?php echo htmlspecialchars($row['avatar']); ?>" alt="Аватар" style="width: 50px;">
                            <?php /* var_dump(htmlspecialchars($row['avatar'])) */; ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['f']); ?></td>
                    <td><?php echo htmlspecialchars($row['i']); ?></td>
                    <td><?php echo htmlspecialchars($row['mail']); ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editUser(<?php echo htmlspecialchars(json_encode($row)); ?>)">Редактировать</button>
                        <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?'<?php
                           echo ($_SESSION['role']=="admin") ? "" : " hidden ";  ?>);">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>




    <!-- Модальное окно для добавления/редактирования пользователя -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Добавить/Редактировать пользователя</h5>


                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" action="update_user.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="userId">
                        <!--div class="row">
                                <div class="col-md-5 text-center"-->
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">&nbsp; Логин</span>
                                        <input type="text" class="form-control" aria-label="Логин"
                                               aria-describedby="inputGroup-sizing-sm" placeholder="Логин"
                                               id="username" name="username" required>
                                    </div>
                                <!--/div>

                                <div class="col-md-5"-->
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Пароль</span>
                                        <input type="password" class="form-control" aria-label="Пример размера поля ввода"
                                               aria-describedby="inputGroup-sizing-sm" alt="Оставьте пустым, если не хотите менять пароль"
                                               placeholder="Оставьте пустым, если не хотите менять пароль"
                                               id="password" name="password">
                                    </div>
                                <!--/div>
                        </div-->


                        <div class="form-group-sm mb-3">
                            <!--label for="role">Роль:</label-->
                            <select class="form-control" id="role" name="role" required>
                                <option value="guest">Гость</option>
                                <option value="user">Пользователь</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </div>

                        <div class="input-group-sm mb-3">
                            <span class="input-group-text">Аватар</span>
                            <!--label class="input-group-text" for="avatar">Аватар</label-->
                            <input type="file" class="form-control" id="avatar" name="avatar">
                        </div>

                        <!--div class="form-group">
                            <label for="avatar">Аватар:</label>
                            <input type="file" class="form-control-file" id="avatar" name="avatar">
                        </div-->

                        <?php if ($row['avatar']): ?>
                            <img src="<?php echo htmlspecialchars($row['avatar']); ?>" alt="Аватар" style="width: 50px;">
                            <?php /* var_dump(htmlspecialchars($row['avatar'])) */; ?>
                        <?php endif; ?>


                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text">Фамилия</span>
                                <input type="text" class="form-control" aria-label="Фамилия"
                                       aria-describedby="inputGroup-sizing-sm" placeholder="Не обязательно"
                                       id="f" name="f">
                            </div>

                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Имя</span>
                            <input type="text" class="form-control" aria-label="Имя"
                                   aria-describedby="inputGroup-sizing-sm" placeholder="Не обязательно"
                                   id="i" name="i">
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Отчевство</span>
                            <input type="text" class="form-control" aria-label="Отчевство"
                                   aria-describedby="inputGroup-sizing-sm" placeholder="Не обязательно"
                                   id="o" name="o">
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Email</span>
                            <input type="text" class="form-control" aria-label="Email"
                                   aria-describedby="inputGroup-sizing-sm" placeholder="Не обязательно"
                                   id="mail" name="mail">
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Телефон:</span>
                            <input type="text" class="form-control" aria-label="Email"
                                   aria-describedby="inputGroup-sizing-sm" placeholder="Не обязательно"
                                   id="phone" name="phone" maxlength="12">
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">WhatsApp:</span>
                            <input type="text" class="form-control" aria-label="WhatsApp"
                                   aria-describedby="inputGroup-sizing-sm" placeholder="Не обязательно"
                                   id="wathapp" name="wathapp" maxlength="12">
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Telegram:</span>
                            <input type="text" class="form-control" aria-label="Telegram"
                                   aria-describedby="inputGroup-sizing-sm" placeholder="Не обязательно"
                                   id="telegramm" name="telegramm" maxlength="12">
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function clearForm() {
            document.getElementById("userForm").reset();
            document.getElementById("userId").value = '';
            document.getElementById("userModalLabel").innerText = "Добавить пользователя";
        }

        function editUser(user) {
            document.getElementById("userId").value = user.id;
            document.getElementById("username").value = user.username;
            document.getElementById("role").value = user.role;
            document.getElementById("f").value = user.f;
            document.getElementById("i").value = user.i;
            document.getElementById("o").value = user.o;
            document.getElementById("mail").value = user.mail;
            document.getElementById("phone").value = user.phone;
            document.getElementById("wathapp").value = user.wathapp;
            document.getElementById("telegramm").value = user.telegramm;
            document.getElementById("userModalLabel").innerText = "Редактировать пользователя";
            $('#userModal').modal('show');
        }
    </script>

    </body>
    </html>

<?php
$pdo = null; // Закрываем соединение с базой данных
?>