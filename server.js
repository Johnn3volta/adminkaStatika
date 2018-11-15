var user = {
    login: '',
    pass: '',

    load: function () {
        var ls = window.localStorage;
        var login, pass;
        if (ls.login) {
            login = ls.getItem('login');
            pass = ls.getItem('pass');
            auth(login, pass);
        }else $('form').style.display = 'block';
    },
    save: function () {
        var ls = window.localStorage;
        var login, pass;

        login = ls.setItem('login', this.login);
        pass = ls.setItem('pass', this.pass);
    }
};

var send = function (url, params, func) {
    var ajax = new XMLHttpRequest();
    ajax.open('GET', url + params, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                func(ajax.responseText);
            }
        }
    };
    ajax.send(null);
};

function update_session() {
    send('server.php?', 'update=1', function (text) {
        text = JSON.parse(text);
        if (text.status == 'true') {
            hide_form(text.login)
        }
        console.log('Сессия:' + text.status)
    });
}

function auth(login, pass) {
    send('server.php?', 'login=' + login + '&pass=' + pass, function (text) {
        text = JSON.parse(text);
        if (text.status == 'true') {
            // console.log('Успешная авторизация');
            hide_form(text.login);
            user.login = login;
            user.pass = pass;
            user.save();
        } else {
            $('login').value = '';
            $('pass').value = '';
            $('error-text').style.display = 'block';
            // console.log('Ошибка авторизации')
        }
    })
}

function addProduct(product, price,priceBox) {
    send('db.php?', 'act=addProduct' + '&product=' + product + '&price=' + price + '&priceBox=' + priceBox, function (text) {
        // text = JSON.parse(text);
        if (text) {
            console.log(text);
            location.href = location.href
        } else {
            console.log('Неизвестная ошибка!')
        }
    })
}
function addPopular(product, price,priceBox) {
    send('db.php?', 'act=addPopular' + '&popProduct=' + product + '&popPrice=' + price + '&popPriceBox=' + priceBox, function (text) {
        // text = JSON.parse(text);
        if (text) {
            console.log(text);
            location.href = location.href
        } else {
            console.log('Неизвестная ошибка!')
        }
    })
}

function updateProduct(id, product, price,priceBox) {
    send('db.php?', 'act=refresh' + '&id=' + id + '&product=' + product + '&price=' + price + '&priceBox=' + priceBox, function (text) {
        // text = JSON.parse(text);
        if (text) {
            alert(text);
            location.href = location.href
        } else {
            console.log('Неизвестная ошибка!')
        }
    })
}
function updatePopular(id, product, price,priceBox) {
    send('db.php?', 'act=popRefresh' + '&id=' + id + '&popProduct=' + product + '&popPrice=' + price + '&popPriceBox=' + priceBox, function (text) {
        // text = JSON.parse(text);
        if (text) {
            alert(text);
            location.href = location.href
        } else {
            console.log('Неизвестная ошибка!')
        }
    })
}

var $ = function (id) {
    return document.getElementById(id);
};

var hide_form = function (userName) {
    $('form').style.display = 'none';
    $('userName').innerHTML = userName;
    $('hello').style.display = 'block';
};

function logout() {
    localStorage.clear();
    location.href = location.href;
}

function check() {
    var inp1 = $('product').value,
        inp2 = $('price').value,
        inp3 = $('priceBox').value;
    if (inp1 && inp2 && inp3) {
        $('addProduct').removeAttribute('disabled')
    } else {
        $('addProduct').disabled = true
    }
}
function checkPop() {
    var inp1 = $('popProduct').value,
        inp2 = $('popPrice').value,
        inp3 = $('popPriceBox').value;
    if (inp1 && inp2 && inp3) {
        $('addPopular').removeAttribute('disabled')
    } else {
        $('addPopular').disabled = true
    }
}

function checkAuth() {
    var inp1 = $('login').value,
        inp2 = $('pass').value;
    if (inp1 && inp2) {
        $('authBtn').removeAttribute('disabled')
    } else {
        $('authBtn').disabled = true
    }
}

document.onkeyup = function (e) {
    e = e || window.event;
    if (e.keyCode === 13) {
        auth($('login').value,$('pass').value);
    }
    // Отменяем действие браузера
    return false;
};


function checkChange(id) {
    id.disabled = false
}




