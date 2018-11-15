<?php
function sanitizeString($str){
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);

    return $str;
}

function getProducts(){
    $f = file('base.php');
    for ($i = 0; $i < count($f); $i++) {
        $g = $i;
        $product = explode(';', $f[$i]);
        $prod = str_replace('$prName'.++$g.'=\'', '', $product[0]);
        $prod = str_replace('\'', '', $prod);
        if(array_key_exists(1, $product)){
            $price = str_replace('$prPrice' . $g . '=\'', '', $product[1]);
            $price = str_replace('\'', '', $price);
        }else{
            $price = '';
        }
        if(array_key_exists(2, $product)){
            $priceBox = str_replace('$priceBox' . $g . '=\'', '', $product[2]);
            $priceBox = str_replace('\'', '', $priceBox);
        }else{
            $priceBox = '';
        }

        if($i != 0){
            echo "<tr id='$i'> 
<input type='hidden' value='" . (int) $i . "' id='id$i'>" . "<td>\$prName$g<input type='text' name='product$i' id='product$i' value='$prod'  onfocus=\"checkChange($('refresh$i'))\"></td>" . "<td>\$prPrice$g<input type='number' id='price$i' min='1' name='price$i' value='" . (float) $price . "'  onfocus=\"checkChange($('refresh$i'))\"></td>" . "<td>\$priceBox$g<input type='number' id='priceBox$i' min='1' name='priceBox$i' value='" . (float) $priceBox . "'  onfocus=\"checkChange($('refresh$i'))\"></td>" . "<td><input type='button' id='refresh$i' value='Обновить' onclick=\"updateProduct($('id$i').value,$('product$i').value,$('price$i').value,$('priceBox$i').value)\" disabled ></td>
</tr>";
        }
    }
}

function getPopular(){
    $f = file('popular.php');
    for ($i = 0; $i < count($f); $i++) {
        $g = $i;
        $product = explode(';', $f[$i]);
        $prod = str_replace('$popName'.++$g.'=\'', '', $product[0]);
        $prod = str_replace('\'', '', $prod);
        if(array_key_exists(1, $product)){
            $price = str_replace('$popPrice' . $g . '=\'', '', $product[1]);
            $price = str_replace('\'', '', $price);
        }else{
            $price = '';
        }
        if(array_key_exists(2, $product)){
            $priceBox = str_replace('$popPriceBox' . $g . '=\'', '', $product[2]);
            $priceBox = str_replace('\'', '', $priceBox);
        }else{
            $priceBox = '';
        }

        if($i != 0){
            echo "<tr id='$i'> 
<input type='hidden' value='" . (int) $i . "' id='idPop$i'>" . "<td>\$popName$g<input type='text' name='product$i' id='popProduct$i' value='$prod'  onfocus=\"checkChange($('popRefresh$i'))\"></td>" . "<td>\$popPrice$g<input type='number' id='popPrice$i' min='1' name='price$i' value='" . (float) $price . "'  onfocus=\"checkChange($('popRefresh$i'))\"></td>" . "<td>\$popPriceBox$g<input type='number' id='popPriceBox$i' min='1' name='priceBox$i' value='" . (float) $priceBox . "'  onfocus=\"checkChange($('popRefresh$i'))\"></td>" . "<td><input type='button' id='popRefresh$i' value='Обновить' onclick=\"updatePopular($('idPop$i').value,$('popProduct$i').value,$('popPrice$i').value,$('popPriceBox$i').value)\" disabled ></td>
</tr>";
        }
    }
}

function updateProduct($id, $product, $price,$priceBox){
    $pn = $id;
    $str = '$prName'.++$pn.'=\''.$product.'\'' . ';' . '$prPrice'.$pn.'=\''. $price.'\';$priceBox'.$pn.'=\''.$priceBox.'\';';
    $f = file('base.php');
    $f[$id] = $str . PHP_EOL;
    file_put_contents('base.php', join('', $f));
}
function updatePopular($id, $product, $price,$priceBox){
    $pn = $id;
    $str = '$popName'.++$pn.'=\''.$product.'\'' . ';' . '$popPrice'.$pn.'=\''. $price.'\';$popPriceBox'.$pn.'=\''.$priceBox.'\';';
    $f = file('popular.php');
    $f[$id] = $str . PHP_EOL;
    file_put_contents('popular.php', join('', $f));
}

function numberProduct ($n){
    if($n == 0) $num = 1;
    else $num = ++$n;

    return $num;
}