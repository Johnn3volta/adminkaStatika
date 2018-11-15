<?

require_once 'functions.php';

if(isset($_GET['act'])){
    if($_GET['act'] == 'addProduct'){
        $prod = sanitizeString($_GET['product']);
        $price = sanitizeString($_GET['price']);
        $priceBox = sanitizeString($_GET['priceBox']);
        $cs = count(file('base.php'));
        $np = numberProduct($cs);
        $f = fopen('base.php', 'a+');
        fwrite($f, '$prName'.$np.'=\''.$prod.'\';$prPrice'.$np.'=\'' . $price.'\';$priceBox'.$np.'=\''.$priceBox.'\''.';'. "\n");
        fclose($f);
        echo "Успешно сохранено";
    }elseif($_GET['act'] == 'refresh'){
        $prod = sanitizeString($_GET['product']);
        $price = sanitizeString($_GET['price']);
        $id = sanitizeString((int) $_GET['id']);
        $productBox = sanitizeString( $_GET['priceBox']);
        updateProduct($id, $prod, $price,$productBox);
        echo 'Товар обновлен';
    }elseif($_GET['act'] == 'addPopular'){
        $prod = sanitizeString($_GET['popProduct']);
        $price = sanitizeString($_GET['popPrice']);
        $priceBox = sanitizeString($_GET['popPriceBox']);
        $cs = count(file('popular.php'));
        $np = numberProduct($cs);
        $f = fopen('popular.php', 'a+');
        fwrite($f, '$popName'.$np.'=\''.$prod.'\';$popPrice'.$np.'=\'' . $price.'\';$popPriceBox'.$np.'=\''.$priceBox.'\''.';'. "\n");
        fclose($f);
        echo "Успешно сохранено";
    }elseif($_GET['act'] == 'popRefresh'){
        $prod = sanitizeString($_GET['popProduct']);
        $price = sanitizeString($_GET['popPrice']);
        $id = sanitizeString((int) $_GET['id']);
        $productBox = sanitizeString( $_GET['popPriceBox']);
        updatePopular($id, $prod, $price,$productBox);
        echo 'Товар обновлен';
    }
}else{
    echo 'Не известный запрос !';
}