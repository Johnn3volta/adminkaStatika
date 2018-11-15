<?php

require_once 'functions.php';
header("Access-Control-Allow-Origin: *");
session_start();


function login($l, $p){
    $login = 'admin';
    $pass = 'UmM150';
    if($login == $l && $pass == $p){
        $_SESSION['login'] = $l;
        $_SESSION['pass'] = $p;

        return '{"status" : "true", "login" : "' . $l . '"}';
    }else{
        return '{"status" : "false"}';
    }
}

function update_session(){
    return isset($_SESSION['login']) ? '{"status" : "true", "login" : "'.$_SESSION['login'].'"}' : '{"status" : "false"}';
}

if(isset($_GET['login']) && isset($_GET['pass'])){
    echo login(sanitizeString($_GET['login']),sanitizeString($_GET['pass']) );
}

if(isset($_GET['update'])){
    echo update_session();
}

