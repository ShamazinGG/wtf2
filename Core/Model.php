<?php
include 'App/Config.php';
abstract class Model
{
    protected $storageFilePath;
    protected $attributeString = '';
    protected $attributes = [];
    protected $table;
    protected $select;
    protected $values;

    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
            // показывать предупреждение если есть ошибки
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $db;
    }

    function getAll()
    {
        $table = $this->table;
        $db = static::getDB();
        $attributes = $db->query("SELECT * FROM $table");
        return $attributes->fetchAll(PDO::FETCH_ASSOC);

        //return json_decode(file_get_contents($file), true);

    }

    function getById($id)
    {
        $attributes = $this->getAll();
        foreach ($attributes as $attribute) {
            if ($attribute['id'] == $id) {
                return $attribute;
            }
        }
        return null;
    }

    function putDB($data)
    {
        $attributes = implode(',', $this->attributes);
        $db = static::getDB();
        $stmt = "INSERT INTO $this->table ($attributes) VALUES (NULL, '$data')";
        $db->query($stmt);
    }


//    function putJson($attributes)
//    {
//        $table = $this->table;
//        $db = static::getDB();
//        //$file = $this->storageFilePath;
//        //file_put_contents( $file, json_encode($attributes  , JSON_PRETTY_PRINT));
//    }

    function create ()
    {

    }


//    function create($data)
//    {
//        $db = static::getDB();
//        $login = 'shamez';
//        $username = 'Nikita';
//        $birthdate = '18.06.1996';
//        $stmt = $db->prepare("INSERT INTO db.users (login, username, birthdate)
//        VALUES (:login,:username, :birthdate)");
//        $stmt->bindParam(':login', $login);
//        $stmt->bindParam(':username', $username);
//        $stmt->bindParam(':login', $birthdate);
//
//    }

    function update($data, $id)
    {
        $file = $this->storageFilePath;
        $attributes = $this->getAll();
        foreach ($attributes as $i => $attribute) {
            if ($attribute['id'] == $id) {
                $attributes[$i] = array_merge($attribute, $data);
            }
        }
        file_put_contents( $file, json_encode($attributes), JSON_PRETTY_PRINT);
    }

    function delete($id)
    {
        $attributes = $this->getAll();
        foreach ($attributes as $i => $attribute) {
            if ($attribute['id'] == $id) {
                array_splice($attributes, $i, 1);
            }
        }
        $this->putJson($attributes);
    }




    function validate($attribute, &$errors)
    {

    }
    public function getId()
    {
        $url = $_SERVER['REQUEST_URI'];
        $routeParts = explode('/', $url);
        $id = $routeParts[2];
        return $id;
    }




}