<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/common.js"></script>
<!--  <script type="text/javascript" src="server.js"></script>-->
    <?php require_once 'functions.php'; ?>
    <?php require_once 'MyDb.php'; ?>
</head>
<body>
<div id="form" style="display: none">
  <div class="form-header">Авторизация</div>
  <div class="form">
    <div class="error"><span id="error-text">Неправильно введен логин или пароль!</span>
    </div>
    <div class="form-items">
      <label for="login">Логин:</label>
      <input type="text" value="" id="login" placeholder="Введите логин"
             onkeypress="project.checkAuth()"
             required>
      <label for="pass">Пароль:</label>
      <input type="password" value="" id="pass" required
             placeholder="Введите пароль" onkeypress="project.checkAuth()"><br>
      <button type="button" id="authBtn"
              onclick=" user.auth(jQuery('#login').val(),jQuery('#pass').val());" disabled>ВХОД
      </button>
    </div>
  </div>
</div>
<div id="hello" style="display: none;">
  <div class="admin-head">
    <ul class="head-list">
      <li><img src="img/admin-icon.png" alt="Иконка Админа"></li>
      <li><span id="userName"></span></li>
      <li>
        <button id="logOut">Выйти <img src="img/logout.png" alt=""></button>
      </li>
    </ul>
  </div>
  <hr>
  <h2 style="text-align: center">Этикетки</h2>
  <hr>
  <div class="product-table">
    <div class="item-table">
      <table align="center" id="ProductTable">
        <tr id="productHeader ">
          <th>Название товара</th>
          <th>Цена за ролик</th>
          <th>Цена за коробку</th>
          <th></th>
        </tr>
        <tr>
          <td>

            <input type="text" name="product" placeholder="Название товара" value="" id="product" onkeypress="project.check()">
          </td>
          <td>

            <input type="number" name="price" placeholder="Цена за Ролик" min="1" value="" id="price" onkeypress="project.check()">
          </td>
          <td>
            <input type="number" name="priceBox" placeholder="Цена за коробку" min="1" value="" id="priceBox" onkeypress="project.check()">
          </td>
          <td>
            <input type="button" id="addProduct" value="Добавить товар" disabled
                     onclick="product.addProduct(jQuery('#product').val(),jQuery('#price').val(),jQuery('#priceBox').val())">
          </td>
        </tr>
        <tr>
          <td colspan="4"><hr></td>
        </tr>

          <?php #getProducts(); ?>



      </table>
    </div>
  </div>
  <hr>
  <h2 style="text-align: center;">Популярные Этикетки</h2>
  <hr>
  <div class="product-table">
    <div class="item-table">
<!--      <table align="center">-->
<!--        <tr>-->
<!--          <th>Название товара</th>-->
<!--          <th>Цена за ролик</th>-->
<!--          <th>Цена за коробку</th>-->
<!--          <th></th>-->
<!--        </tr>-->
<!--        <tr>-->
<!--          <td>-->
<!--            <span class="gg">$popName0</span><input type="text" name="product" placeholder="Название товара" value="" id="popProduct" onkeypress="checkPop()">-->
<!--          </td>-->
<!--          <td><span class="gg">$popPrice0</span><input type="number" name="price" min="1" value=""-->
<!--                                                      id="popPrice" onkeypress="checkPop()"></td>-->
<!--          <td><span class="gg">$popPriceBox0</span><input type="number" name="priceBox" min="1" value=""-->
<!--                                                       id="popPriceBox" onkeypress="checkPop()"></td>-->
<!--          <td><input type="button" id="addPopular" value="Добавить товар"-->
<!--                     disabled-->
<!--                     onclick="addPopular($('popProduct').value,$('popPrice').value,$('popPriceBox').value)">-->
<!--          </td>-->
<!--        </tr>-->
<!--          --><?php //getPopular(); ?>
<!--      </table>-->
      <hr>
      <div class="footer" >
        Подвал админки
      </div>
    </div>
  </div>
</div>
</body>
</html>

<?php

//$db = new MyDb();
//$db->exec('CREATE TABLE user (id INTEGER PRIMARY KEY,name TEXT, password TEXT)');
//$db->exec('CREATE TABLE etiketki (id INTEGER PRIMARY KEY, product_name TEXT, price DECIMAL, price_box DECIMAL)');
//$db->exec('CREATE TABLE popular_etiketki (id INTEGER PRIMARY KEY, product_name TEXT, price DECIMAL, price_box DECIMAL)');
//$db->exec("INSERT INTO etiketki (product_name, price, price_box) VALUES ('Этикетка самоклеющаяся полуглянец 100*150 (250) 40 втулка','2,31','138,6')");
//$db->exec("INSERT INTO popular_etiketki (product_name, price, price_box) VALUES ('ЭТИКЕТКА ТЕРМОЭКО 100*210 (50) 60 втулка','2,1','126')");
////$db->exec("INSERT INTO popular_etiketki (product_name, price, price_box) VALUES ('ЭТИКЕТКА ТЕРМОЭКО 100*210 (50) 60 втулка','2,1','122')");
//$result = $db->query('SELECT * FROM etiketki');
//$resultPr = $db->query('SELECT id FROM popular_etiketki');
//echo '<pre>';
//print_r($result->fetchArray(SQLITE3_ASSOC));
//echo '<pre>';
//print_r($resultPr->fetchArray());


//$db = new MyDb();
//$pass = sha1('LsrlWV4C');
//$db->exec("INSERT INTO `user` (`name`,`password`) VALUES ('admin','".$pass."')");

//echo '<pre>';
//print_r($db->getUser());
//echo '<pre>';
//print_r($db->getAllPopularEtiketki());
//foreach($db->getAllEtiketki() as $gg){
//  print_r(json_decode($gg));
//}


?>