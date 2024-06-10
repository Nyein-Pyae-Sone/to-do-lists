<?php

require 'Validator.php';
$config = require('config.php');
$db = new Database($config['database']);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle DELETE request
    if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
        $db->query('DELETE FROM lists WHERE id = :id', [
            'id' => $_POST['id'],
        ]);
    } 

    // Handle UPDATE request
    elseif (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
        if (isset($_POST['name']) && Validator::string($_POST['name'], 1, 100)) {
            $db->query('UPDATE lists SET name = :name WHERE id = :id', [
                'name' => $_POST['name'],
                'id' => $_POST['id'],
            ]);
        } else {
            $errors['name'] = 'The body of no more than 100 characters is required';
        }
    } 
    
    // Handle ADD request
    elseif (isset($_POST['name'])) {
        if (Validator::string($_POST['name'], 1, 100)) {
            $db->query('INSERT INTO lists (name) VALUES (:name)', [
                'name' => $_POST['name'],
            ]);
        } else {
            $errors['name'] = 'The body of no more than 100 characters is required';
        }
    }
}

// Fetch the list items
$lists = $db->query('SELECT * FROM lists')->get();

require "views/index.view.php";







