<?php
require('../../src/inc/pdo.php');
require('../../src/inc/functions.php');
$errors = [];
$success = false;

session_start();

$password = checkXss($_POST['password']);
$passwordConfirm = checkXss($_POST['password-confirm']);

$errors = checkField($errors, $password, 'password', 6, 200);
$errors = checkField($errors, $passwordConfirm, 'password-confirm', 6, 200);

if ($password != $passwordConfirm) $errors['password-confirm'] == 'Les mots de passes ne sont pas identiques';
