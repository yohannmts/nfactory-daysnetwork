<?php
require('./../../src/inc/pdo.php');
require('./../../src/inc/functions.php');

$errors = [];
$trames = [];
$success = false;

session_start();

if (!isLogged()) $errors['user'] = 'Vous devez être connnecté avant d\'effectuer cette action.';

$logs = selectAll($pdo, 'nd_logs');

if (count($errors) == 0) {
    $id = 0;
    foreach ($logs as $trame) {
        $user = select($pdo, 'nd_users', 'mail', 'id', $trame['user_id']);
        $items = json_decode($trame['data']);
        foreach ($items as $item) {
            $item->id = $id;
            $item->user = $user;
            $trames[] = $item;
            $id++;
        }
    }
    $success = true;
}

$data = [
    'errors' => $errors,
    'success' => $success,
    'trames' => $trames
];

showJson($data);
