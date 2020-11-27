<?php
//namespace App\Models;
include_once 'Core/Model.php';
class UserModel extends Model
{
    protected $attributes = [
        'login', 'username', 'surname', 'birthdate', 'email', 'address', 'id'
        //
    ];
    protected $attributeString = 'login, username, surname, birthdate, email,address,id';
    protected $table = 'users';




    function getAll()
    {
        return parent::getAll(); // TODO: Change the autogenerated stub
    }


    function putDB($attributes)
    {
        $attributeString = $this->attributeString;
        $db = static::getDB();
        $login = 'shamez';
        $username = 'Nikita';
        $birthdate = '18.06.1996';
        $stmt = $db->prepare("INSERT INTO db.users (login, username, birthdate) 
        VALUES (:login,:username, :birthdate)");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':login', $birthdate);
//        if ($stmt->execute()) {
//           var_dump("Успех");
//        } else {
//            var_dump("Провал");
//        }



        //$db->prepare($stmt)->execute($attributes);
    }

//    function create($data)
//    {
//        $attributes = $this->getAll();
//        $db = static::getDB();
//        $this->putDB($attributes);
//        return $data;
//
//    }
//    function putDB($attributes)
//    {
//        $values = $this->values;
//        $db = static::getDB();
//        $table = $this->table;
//        $stmt = $db->query("INSERT into $table ($attributes) VALUES (?,?,?,?,)");
//        $db->prepare($stmt)->execute($attributes);
//    }

    function validate($attribute, &$errors)
    {
        $isValid = true;
        //Начало валидации
        if (!$attribute['login'] || strlen($attribute['login']) < 5 || strlen($attribute['login']) > 20) {
            $isValid = false;
            $errors['login'] = 'Поле "Логин" обязательно и должно содержать от 5 до 20 символов';
        }
        if (!$attribute['name']) {
            $isValid = false;
            $errors['name'] = 'Поле "Имя" обязательно';
        }

        if (!$attribute['birthdate']) {
            $isValid = false;
            $errors['birthdate'] = '"Дата рождения" введена некорректно';

        }
        // Конец валидации

        return $isValid;

    }
}


