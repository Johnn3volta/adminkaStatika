<?php

require_once 'MyDb.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    print_r(action($_POST));
}

function action(array $arr)
{
    $output = '';
    $db = new MyDb();

    if($arr['action'] == 'login'){
        $output = verificateUser($arr);
    }
    if($arr['action'] == 'addProduct'){
        $db->addProduct($arr);
        $output =  'Товар добавлен';
    }
    if($arr['action'] == 'addPopularProduct'){
        $db->addPopularProduct($arr);
        $output =  'Товар добавлен';
    }
    if($arr['action'] == 'showProducts'){
        $output = $db->getAllProduct();
    }
    if($arr['action'] == 'showPopularProducts'){
        $output = $db->getAllPopularProduct();
    }
    if($arr['action'] == 'updateProduct'){
        $db->updateProduct($arr);
        $output= 'Товар обновлен';
    }
    if($arr['action'] == 'updatePopularProduct'){
        $db->updatePopularProduct($arr);
        $output= 'Товар обновлен';
    }


    return $output;


}

function verificateUser(array $arr)
{
    $json = array();
    $login = '';
    $pass = '';
    if(array_key_exists('login', $arr)){
        $login = strip_tags($arr['login']);
    }
    if(array_key_exists('pass', $arr)){
        $pass = sha1(strip_tags($arr['pass']));
    }

    $db = new MyDb();

    $user = $db->getUser();
    if($user['name'] === $login && $user['password'] === $pass){
        $json['answer'] = true;
        $json['login'] = strip_tags($arr['login']);
    }else{
        $json['answer'] = false;
    }

    return json_encode($json);

}