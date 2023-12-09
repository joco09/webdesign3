<?php

$password = "password1";
 echo $password ."<br>";

$hashedpass = password_hash($password, PASSWORD_DEFAULT);

$verify = password_verify($password,$hashedpass);


if($verify == 1){
    echo "you are in";
}