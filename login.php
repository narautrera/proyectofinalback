<?php
$user = $_POST ["user"];
$pass = $_POST ["pass"];

$usuario = "narautrera";
$contrasena = "backend2022";

if ($usuario == $user && $contrasena == $pass) {
  header ("location:tabla.php");
} else {
  print ("Acceso permitido sólo para administradores");
}

 ?>
