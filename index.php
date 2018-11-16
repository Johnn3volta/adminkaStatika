<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript" src="js/jQuery.js"></script>
  <script type="text/javascript" src="js/common.js"></script>
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
             onfocus="jQuery('#error-text').css('display','none')"
             required>
      <label for="pass">Пароль:</label>
      <input type="password" value="" id="pass" required
             onfocus="jQuery('#error-text').css('display','none')"
             placeholder="Введите пароль" onkeypress="project.checkAuth()"><br>
      <button type="button" id="authBtn"
              onclick=" user.auth(jQuery('#login').val(),jQuery('#pass').val());"
              disabled>ВХОД
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
          <th>#</th>
          <th>Название товара</th>
          <th>Цена за ролик</th>
          <th>Цена за коробку</th>
          <th></th>
        </tr>
        <tr>
          <td>№</td>
          <td>
            <input type="text" name="product" placeholder="Название товара"
                   value="" id="product" onkeypress="project.check()">
          </td>
          <td>
            <input type="number" name="price" placeholder="Цена за ролик"
                   min="1" value="" id="price" onkeypress="project.check()">
          </td>
          <td>
            <input type="number" name="priceBox" placeholder="Цена за коробку"
                   min="1" value="" id="priceBox" onkeypress="project.check()">
          </td>
          <td>
            <input type="button" id="addProduct" value="Добавить товар" disabled
                   onclick="product.addProduct(jQuery('#product').val(),jQuery('#price').val(),jQuery('#priceBox').val(),'addProduct')">
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <hr>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <hr>
  <h2 style="text-align: center;">Популярные Этикетки</h2>
  <hr>
  <div class="product-table">
    <div class="item-table">
      <table align="center" id="ProductPopularTable">
        <tr>
          <th>#</th>
          <th>Название товара</th>
          <th>Цена за ролик</th>
          <th>Цена за коробку</th>
          <th></th>
        </tr>
        <tr>
          <td>№</td>
          <td>
            <input type="text" name="product" placeholder="Название товара"
                   value="" id="popProduct" onkeypress="project.checkPopular()">
          </td>
          <td>
            <input type="number" name="price" placeholder="Цена за ролик"
                   min="1" value="" id="popPrice"
                   onkeypress="project.checkPopular()">
          </td>
          <td>
            <input type="number" name="priceBox" placeholder="Цена за коробку"
                   min="1" value="" id="popPriceBox"
                   onkeypress="project.checkPopular()">
          </td>
          <td>
            <input type="button" id="addPopular" value="Добавить товар" disabled
                   onclick="product.addProduct(jQuery('#popProduct').val(),jQuery('#popPrice').val(),jQuery('#popPriceBox').val(),'addPopularProduct')">
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <hr>
          </td>
        </tr>
      </table>
      <hr>
      <div class="footer">
        Подвал админки
      </div>
    </div>
  </div>
</div>
</body>
</html>

