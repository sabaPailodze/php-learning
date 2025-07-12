<?php

use Core\Validator;
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$errors = [];

if($_SERVER['REQUEST_METHOD']==='POST'){   

    if(! Validator::string($_POST['body'], 1, 100)){
        $errors['body'] = 'A body of no more than 100 characters is required.';
    }

    if(! empty($errors)){
        return view("notes/create.view.php", [
            'heading' => 'Create Note',
            'errors' => $errors,
          ]);
    }
    
    
    $db->query("INSERT INTO notes(body , user_id) VALUES(:body, :user_id)", [
        'body' => $_POST['body'],
        'user_id' => 1
    ]);

    header('location: /notes');
    die();

}

?>