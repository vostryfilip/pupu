<?php 

require 'db.php';

if (isset($_POST['name_gallery'])){
    
    $sql = 'INSERT INTO gallery 
    SET name_gallery = :name_gallery';
    $stmt = $conn->prepare($sql);
    $stmt->execute([
    ':name_gallery' => $_POST['name_gallery'],
]);
}

header('Location: index.php');