<?php

$hostname = "localhost";
$banco = "site1";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $banco);
if ($mysqli->connect_errno) {
    echo "Falha ao conectar : ($mysqli->errno) $mysqli->connect_error";
}