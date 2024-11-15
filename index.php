<?php
echo "dfdgd  afgvqavgqa"; ?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </head>
    <body>
         <h1>Сочи</h1>
        <table class="table">

            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Login</th>
                <th scope="col">Word</th>
                <th scope="col">L/S</th>
                <th scope="col">Note</th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td><a href="https://lk.kuban.tns-e.ru/">ТНС Энерго</a></td>
                <td>230203158207 </td>
                <td>$+Standart</td>
                 <td>230203158207</td>
                  <td></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td><a href="https://abonent.sochi-ivc.ru/">МУП Сочи ГорИВЦ</a></td>
                <td>l208@bk.ru</td>
                <td>Standart</td>
                <td>538 983</td>
                    <td></td>

              </tr>
              <tr>
                <th scope="row">3</th>
                <td><a href="https://abonent.svdk.su/">Сочиводоканал</a></td>
                <td>9190929</td>
                <td>$+Standart</td>
                <td>9190929</td>
                    <td></td>
              </tr>

               <tr>
                <th scope="row">4</th>
                <td><a href="https://abonent.svdk.su/"></a></td>
                <td></td>
                <td>$+Standart</td>
                <td>9190929</td>
                <td></td>
              </tr>
            </tbody>
        </table>

        <h1>Краснодар</h1>
        <table class="table">

            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Login</th>
                <th scope="col">Word</th>
                <th scope="col">L/S</th>
                <th scope="col">Note</th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td><a href="https://lc.nesk.ru/">НЭСК</a></td>
                <td>l208@bk.ru</td>
                <td>$+Standart</td>
                 <td>232500016945</td>
                  <td></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td><a href="https://abonent.sochi-ivc.ru/">ГУК Краснодар</a></td>
                <td>l208@bk.ru</td>
                <td>Standart</td>
                <td>020069960</td>
                    <td></td>

              </tr>
              <tr>
                <th scope="row">3</th>
                <td><a href="https://мойгаз.смородина.онлайн/auth/sign-in">межрегионгаз Краснодар</a></td>
                <td>l208@bk.ru</td>
                <td>Standart</td>
                <td>340031215062</td>
                    <td></td>
              </tr>

               <tr>
                <th scope="row">4</th>
                <td><a href="https://abonent.svdk.su/"></a></td>
                <td>9190929</td>
                <td>$+Standart</td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
        </table>

         <h1>Загрузите изображение</h1>
         <form action="upload.php" method="post" enctype="multipart/form-data">
             <label for="file">Выберите изображение:</label>
             <input type="file" name="file" id="file" accept="image/*" required>
             <br><br>
             <input type="submit" value="Загрузить">
         </form>

    </body>
</html>