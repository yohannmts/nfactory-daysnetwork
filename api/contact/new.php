<?php
require('../../src/inc/pdo.php');
require('../../src/inc/functions.php');
$errors = [];
$success = false;

session_start();

$firstname = checkXss($_POST['firstname']);
$lastname = checkXss($_POST['lastname']);
$mail = checkXss($_POST['mail']);
$subject = checkXss($_POST['subject']);
$message = checkXss($_POST['message']);

$errors = checkField($errors, $firstname, 'firstname', 2, 150);
$errors = checkField($errors, $lastname, 'lastname', 2, 150);
$errors = checkEmail($errors, $mail, 'mail');
$errors = checkField($errors, $mail, 'mail', 6, 200);
$errors = checkField($errors, $subject, 'subject', 10, 200);
$errors = checkField($errors, $message, 'message', 10, 2000);

if (count($errors) == 0) {
    insert($pdo, 'nd_contact', ['firstname',  'lastname', 'mail', 'subject', 'message', 'created_at'], [$mail, $firstname, $lastname, $subject, $message, now()]);
    $success = true;
}

$data = [
    'errors' => $errors,
    'success' => $success
];


