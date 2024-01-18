<?php

/** @var mysqli $db */

//check if the data is correct and filled in, when not, show an error
$errors = [];

if ($name == "") {
    $errors['name'] = 'name cannot be empty';
}
if ($email == "") {
    $errors['email'] = 'e-mail cannot be empty';

}
if ($date == "") {
    $errors['date'] = 'date cannot be empty';
}

if ($phone == "") {
    $errors['phone'] = 'phone cannot be empty';
}

?>