<?php
/*$dsn = 'mysql:host=localhost;dbname=classicmodels';
$username = 'root';
$passwd = 'troiswa';
*/

try {

    $db = new PDO ('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'troiswa');
    //array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e){
    die('Error : '. $e ->getMessage());
}
/*
try {

    $db = new PDO ('mysql:host=127.0.0.1;dbname=blog;charset=utf8', 'root', '');
    //array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e){
    die('Error : '. $e ->getMessage());
}*/





/*class MyPDO extends PDO
{

    public function __construct($dsn, $username = NULL, $password = NULL, $options = [])
    {
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_merge($default_options, $options);
        parent::__construct($dsn, $username, $password, $options);
    }
    public function run($sql, $args = NULL)
    {
        $stmt = $this->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
$data = $pdo->run("SELECT * FROM categories")->fetchAll();*/

