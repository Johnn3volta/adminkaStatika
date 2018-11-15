var user = {
    login: '',
    pass: '',
    initialize: function () {

        user.load();
        user.logOut();
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
    showProducts: function () {
        jQuery.post('actions.php', {
            action: 'showProducts'
        }).done(function (data) {
            var ans = JSON.parse(data);
            if (ans.length != 0) {
                project.createTable(ans)
                // jQuery.each(ans,function () {
                //     console.log(this)
                //     // jQuery.each(this,function (key,val) {
                //     //     console.log(this)
                //     // })
                // });
                console.log(ans)
            }
            console.log(ans)
        })
    },
    createTable:function (data) {
        jQuery.each(data,function () {
            var tr = jQuery('<tr>',{
                id:'Etiketka'+this.id,
                html:"<input type='hidden' value='"+ this.id +"' id='"+ this.id +"'><td><input type='text' name='product "+ this.id +"' id='product" + this.id +"' value='" + this.product_name +"'></td><td><input type='number' id='price"+ this.id +"' min='1' name='price"+ this.id +"' value='"+ this.price +"'></td><td><input type='number' id='priceBox"+ this.id +"' min='1' name='priceBox"+ this.id +"' value='" + this.price_box +"'></td><td><input type='button' id='refresh"+ this.id +"' value='Обновить' disabled ></td>"
            });
            jQuery('#ProductTable').append(tr)
            // console.log(tr)
        })
    }
};

var product = {
    addProduct: function (name, price, boxprice) {
        jQuery.post('actions.php', {
            action: 'addProduct',
            name: name,
            price: price,
            boxprice: boxprice
        }).done(function (data) {
            alert(data);
            location.reload()
        })
    }
};


jQuery(document).ready(function () {
    user.initialize();
    project.showProducts()
});
