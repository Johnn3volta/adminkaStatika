var user = {
    login: '',
    pass: '',
    initialize: function () {

        user.load();
        user.logOut();
        project.keyUpAuthForm();
    },
    load: function () {
        var login, pass, ls = window.localStorage;
        if (ls.login) {
            login = ls.getItem('login');
            pass = ls.getItem('pass');
            user.auth(login, pass);
        } else jQuery('#form').css('display', 'block')
    },
    save: function () {
        var login, pass, ls = window.localStorage;
        login = ls.setItem('login', this.login);
        pass = ls.setItem('pass', this.pass);
    },

    auth: function (login, pass) {
        jQuery.post("actions.php", {
            action: 'login',
            login: login,
            pass: pass
        }).done(function (data) {
            var ans = JSON.parse(data);
            if (ans.answer === true) {
                project.loginForm(ans.login);
                user.login = login;
                user.pass = pass;
                user.save();
            } else {
                jQuery('#login').val('');
                jQuery('#pass').val('');
                jQuery('#error-text').css('display','block')
            }
        }).fail(function () {
            alert('Ошибка подключения')
        })
    },
    logOut: function () {
        jQuery('#logOut').click(function () {
            localStorage.clear();
            location.reload();
        })
    }
};

var project = {
    keyUpAuthForm:function(){
        document.onkeyup = function (e) {
            e = e || window.event;
            if (e.keyCode === 13) {
                user.auth(jQuery('#login').val(),jQuery('#pass').val());
            }
            // Отменяем действие браузера
            return false;
        };
    },
    loginForm: function (userName) {
        jQuery('#form').css('display', 'none');
        jQuery('#userName').text(userName);
        jQuery('#hello').css('display', 'block')

    },
    checkAuth: function () {
        var inp = jQuery('#login').val(),
            inp2 = jQuery('#pass').val();
        if (inp && inp2) {
            jQuery('#authBtn').removeAttr('disabled')
        } else {
            jQuery('#authBtn').disabled = true
        }
    },
    check: function () {
        var inp1 = jQuery('#product').val(),
            inp2 = jQuery('#price').val(),
            inp3 = jQuery('#priceBox').val();
        if (inp1 && inp2 && inp3) {
            jQuery('#addProduct').removeAttr('disabled')
        } else {
            jQuery('#addProduct').disabled = true
        }
    },
    checkPopular: function () {
        var inp1 = jQuery('#popProduct').val(),
            inp2 = jQuery('#popPrice').val(),
            inp3 = jQuery('#popPriceBox').val();
        if (inp1 && inp2 && inp3) {
            jQuery('#addPopular').removeAttr('disabled')
        } else {
            jQuery('#addPopular').disabled = true
        }
    },
    createTable:function (data) {
        jQuery.each(data,function (i) {
            var tr = jQuery('<tr>',{
                id:'Etiketka'+this.id,
                html:"<td>"+ (i + 1) + "</td><td><input type='text' name='product"+ this.id +"' id='product" + this.id +"' value='" + this.product_name +"' onfocus='product.checkChange(jQuery("+'refresh' + this.id +"))'></td><td><input type='number' id='price"+ this.id +"' min='1' name='price"+ this.id +"' value='"+ this.price +"' onfocus='product.checkChange(jQuery("+'refresh' + this.id+"))'></td><td><input type='number' id='priceBox"+ this.id +"' min='1' name='priceBox"+ this.id +"' value='" + this.price_box +"' onfocus='product.checkChange(jQuery("+'refresh' + this.id +"))'></td><td><input disabled type='button' id='refresh"+ this.id +"' value='Обновить' onclick='product.productUpdate(jQuery("+'product'+ this.id +").val(),jQuery("+'price'+ this.id +").val(),jQuery("+'priceBox'+ this.id +").val(),\"updateProduct\","+ this.id +")' ></td>"
            });
            jQuery('#ProductTable').append(tr)
        })
    },
    createPopularTable:function (data) {
        jQuery.each(data,function (i) {
            var tr = jQuery('<tr>',{
                id:'PopularEtiketka'+this.id,
                html:"<td>"+ (i + 1) + "</td><td><input type='text' name='popProduct"+ this.id +"' id='popProduct" + this.id +"' value='" + this.product_name +"' onfocus='product.checkChange(jQuery("+'popRefresh' + this.id +"))'></td><td><input type='number' id='popPrice"+ this.id +"' min='1' name='popPrice"+ this.id +"' value='"+ this.price +"' onfocus='product.checkChange(jQuery("+'popRefresh' + this.id+"))'></td><td><input type='number' id='popPriceBox"+ this.id +"' min='1' name='popPriceBox"+ this.id +"' value='" + this.price_box +"' onfocus='product.checkChange(jQuery("+'popRefresh' + this.id +"))'></td><td><input disabled type='button' id='popRefresh"+ this.id +"' value='Обновить' onclick='product.productUpdate(jQuery("+'popProduct'+ this.id +").val(),jQuery("+'popPrice'+ this.id +").val(),jQuery("+'popPriceBox'+ this.id +").val(),\"updatePopularProduct\","+ this.id +")' ></td>"
            });
            jQuery('#ProductPopularTable').append(tr)
        })
    }
};

var product = {
    addProduct: function (name, price, boxprice,act) {
        jQuery.post('actions.php', {
            action: act,
            name: name,
            price: price,
            boxprice: boxprice
        }).done(function (data) {
          alert(data);
            location.reload();
        })
    },
    productUpdate:function(name,price,boxprice,act,id){
        jQuery.post('actions.php',{
            action:act,
            id:id,
            name:name,
            price:price,
            boxprice:boxprice
        }).done(function (data) {
            alert(data);
            location.reload();
        })
    },
    showProducts: function () {
        jQuery.post('actions.php', {
            action: 'showProducts'
        }).done(function (data) {
            var ans = JSON.parse(data);
            if (ans.length != 0) {
                project.createTable(ans)
            }
        })
    },
    showPopularProducts: function () {
        jQuery.post('actions.php', {
            action: 'showPopularProducts'
        }).done(function (data) {
            var ans = JSON.parse(data);
            if (ans.length != 0) {
                project.createPopularTable(ans)
            }
        })
    },
    checkChange: function (id) {
        id.removeAttr('disabled')
    }
};


jQuery(document).ready(function () {
    user.initialize();
    product.showProducts();
    product.showPopularProducts()
});
