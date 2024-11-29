<?php global $pdo, $organization; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать платеж</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script>
        function saveMonth() {

            var selectElement = document.getElementById("monthSelect");
            var inputElement = document.getElementById("month");
            inputElement.value = selectElement.value;
        }

    </script>
</head>
<body>
<div class="container mt-5">
    <h1>Редактировать платеж  </h1>
    <?php
    require 'db.php';
    $pay_id = $_GET['pay_id'];
    $org_id=$_GET['org_id'];
    $stmt = $pdo->prepare("SELECT * FROM payments WHERE id = :id");
    $stmt->execute(['id' => $pay_id]);
    $payment = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($pay_id>0){
        $year= $payment['year'];
        $month = $payment['month'];
        $date= $payment['date'];

    } else {
        $date = new DateTime();
        $year = $date->format('Y');
        $month = $date->format('m');
    }


   // $outdate=$date->format('d-m-Y');
    ?>
    <form action="update_payment.php" method="POST" enctype="multipart/form-data">
        <!--type="hidden" -->
        <input  name="pay_id" id ="pay_id" value="<?php echo $pay_id; ?>">
        <input  name="org_id" id ="org_id" value="<?php echo $org_id; ?> ">
        <input  name="month" id ="month" value="<?php echo $month; ?> ">

        <div class="input-group">
            <span class="input-group-text">Год:</span>
            <input type="number" id="year" name="year" class="form-control" value="<?php echo $year; ?>" required>
            <span class="input-group-text">Месяц:</span>
            <select id="monthSelect" class="form-control" onchange="saveMonth()">
                    <option value="1" <?php if ($month==1 ) echo "selected" ?>>Январь</option>
                    <option value="2" <?php if ($month==2 ) echo "selected" ?>>Февраль</option>
                    <option value="3" <?php if ($month==3 ) echo "selected" ?>>Март</option>
                    <option value="4" <?php if ($month==4 ) echo "selected" ?>>Апрель</option>
                    <option value="5" <?php if ($month==5 ) echo "selected" ?>>Май</option>
                    <option value="6" <?php if ($month==6 ) echo "selected" ?>>Июнь</option>
                    <option value="7" <?php if ($month==7 ) echo "selected" ?>>Июль</option>
                    <option value="8" <?php if ($month==8 ) echo "selected" ?>>Август</option>
                    <option value="9" <?php if ($month==9 ) echo "selected" ?>>Сентябрь</option>
                    <option value="10" <?php if ($month==10 ) echo "selected" ?>>Октябрь</option>
                    <option value="11" <?php if ($month==11 ) echo "selected" ?>>Ноябрь</option>
                    <option value="12" <?php if ($month==12 ) echo "selected" ?>>Декабрь</option>
            </select>

            <span class="input-group-text">Сумма:</span>
            <input type="number" id="amount" name="amount" class="form-control" value="<?php echo $payment['amount']; ?>" required>


                <span class="input-group-text">Дата:</span>
                <input type="date" id="date" name="date" class="form-control" value="<?php echo $payment['date']; ?>" required>

        </div>




        <div class="form-group">
            <label for="receipt">Чек:</label>
            <input type="file" id="receipt" name="receipt" class="form-control">
            <small>Текущий чек: <img src="<?php echo $payment['receipt']; ?>" alt="Receipt" style="width: 100px;"></small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="payments.php?org_id=<?php echo $payment['organization_id']; ?>" class="btn btn-secondary">Назад к платежам</a>
    </form>
</div>
</body>
</html>