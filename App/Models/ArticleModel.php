<?php
//namespace App\Models;
include_once 'Core/Model.php';
class ArticleModel extends Model
{
    protected $attributes = [ 'title', 'body', 'date', 'author', 'id'
    ];
    protected $table = 'articles';


    public function validate($attribute, &$errors)
    {
        $isValid = true;
        if (!$attribute['title']) {
            $isValid = false;
            $errors['title'] = 'Поле "Название статьи" обязательно';
        }
        if (!$attribute['body'] || strlen($attribute['body']) < 20 || strlen($attribute['body']) > 200) {
            $isValid = false;
            $errors['body'] = 'Поле "Тело статьи" обязательно и должно содержать от 20 до 200 символов ';
        }

        if (!$attribute['author']) {
            $isValid = false;
            $errors['author'] = 'Имя автора статьи обязательно';

        }
        // Конец валидации

        return $isValid;
    }


}