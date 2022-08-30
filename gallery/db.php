<?php

$conn = new PDO('mysql:host=localhost:3336;dbname=gallery',
    'root',
    '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
$conn->query('SET NAMES utf8');
