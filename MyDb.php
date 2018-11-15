<?php


class MyDb extends SQLite3
{

    public $pass = 'LsrlWV4C';

    public $db;

    public $etiketki = [];

    public $popular_etiketki = [];

    public function __construct()
    {
        $this->open('marketrd.db');
        $this->exec('CREATE TABLE IF NOT EXISTS user (id INTEGER PRIMARY KEY,name TEXT, password TEXT)');
        $this->exec('CREATE TABLE IF NOT EXISTS etiketki (id INTEGER PRIMARY KEY, product_name TEXT, price FLOAT, price_box FLOAT )');
        $this->exec('CREATE TABLE IF NOT EXISTS popular_etiketki (id INTEGER PRIMARY KEY, product_name TEXT, price FLOAT, price_box FLOAT)');
    }

    public function addProduct(array $arr)
    {
        $answer = 'NO';

        $query = "INSERT INTO etiketki (product_name,price,price_box) VALUES ('" . strip_tags($arr['name']) . "','" . strip_tags($arr['price']) . "','" .strip_tags( $arr['boxprice']) . "')";

        if($this->exec($query)){
            $answer = 'OK';
        }

        return $answer;
    }

    public function getAllProduct()
    {
        $result = $this->query('SELECT * FROM etiketki');

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $this->etiketki[] = $row;
        }


        return json_encode($this->etiketki, JSON_UNESCAPED_UNICODE);
    }

    public function getAllPopularEtiketki()
    {
        $result = $this->query('SELECT * FROM popular_etiketki');

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $this->popular_etiketki[] = $row;
        }


        return json_encode($this->popular_etiketki, JSON_UNESCAPED_UNICODE);
    }

    public function getUser()
    {
        $query = $this->query('SELECT * FROM `user`');

        $result = $query->fetchArray(SQLITE3_ASSOC);

        return $result;
    }
}