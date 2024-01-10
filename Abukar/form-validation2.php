<?php


/** @var mysqli $db */

//check if the data is correct and filled in, when not, show an error
$errors = [];
if ($first_name == "") {
    $errors['first_name'] = 'name cannot be empty';
}
if ($last_name == "") {
    $errors['last_name'] = 'name cannot be empty';
}
if ($mail == "") {
    $errors['mail'] = 'e-mail cannot be empty';

}
?>

