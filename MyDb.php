<?php


class MyDb extends SQLite3
{

    public $pass = 'LsrlWV4C';

    public $etiketki = array();

    public $popular_etiketki = array();

    public function __construct()
    {
        $this->open('marketrd.db');
        $this->exec('CREATE TABLE IF NOT EXISTS user (id INTEGER PRIMARY KEY,name TEXT, password TEXT)');
        $this->exec('CREATE TABLE IF NOT EXISTS etiketki (id INTEGER PRIMARY KEY, product_name TEXT, price FLOAT, price_box FLOAT )');
        $this->exec('CREATE TABLE IF NOT EXISTS popular_etiketki (id INTEGER PRIMARY KEY, product_name TEXT, price FLOAT, price_box FLOAT)');
    }

    public function addProduct(array $arr)
    {
        $query = "INSERT INTO etiketki (product_name,price,price_box) VALUES ('" . strip_tags($arr['name']) . "','" . strip_tags($arr['price']) . "','" . strip_tags($arr['boxprice']) . "')";

        $this->exec($query);

    }

    public function addPopularProduct(array $arr)
    {
        $query = "INSERT INTO popular_etiketki (product_name,price,price_box) VALUES ('" . strip_tags($arr['name']) . "','" . strip_tags($arr['price']) . "','" . strip_tags($arr['boxprice']) . "')";

        $this->exec($query);

    }

    public function updateProduct(array $arr)
    {
        $query = "UPDATE etiketki SET product_name = '" . strip_tags($arr['name']) . "', price = '" . strip_tags($arr['price']) . "',price_box='" . strip_tags($arr['boxprice']) . "' WHERE id = '" . (int) $arr['id'] . "'";

        $this->exec($query);
    }

    public function updatePopularProduct(array $arr)
    {
        $query = "UPDATE popular_etiketki SET product_name = '" . strip_tags($arr['name']) . "', price = '" . strip_tags($arr['price']) . "',price_box='" . strip_tags($arr['boxprice']) . "' WHERE id = '" . (int) $arr['id'] . "'";

        $this->exec($query);
    }

    public function getAllProduct()
    {
        $result = $this->query('SELECT * FROM etiketki');

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $this->etiketki[] = $row;
        }


        return json_encode($this->etiketki);
    }

    public function getAllPopularProduct()
    {
        $result = $this->query('SELECT * FROM popular_etiketki');

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $this->popular_etiketki[] = $row;
        }


        return json_encode($this->popular_etiketki);
    }

    public function getUser()
    {
        $query = $this->query('SELECT * FROM `user`');

        $result = $query->fetchArray(SQLITE3_ASSOC);

        return $result;
    }
}