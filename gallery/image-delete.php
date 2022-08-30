<?php
    $id = $_GET['id'];
    $extension = trim($_GET['extension']);
    $destination = $_GET['destination'];
require 'db.php';
$sql = 'SELECT * FROM image WHERE id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->execute(
        [
            'id' => $id,
        ]
        );
        $image = $stmt->fetch(); 

        $gallery_id = $image['gallery_id'];
        unlink($image);

unlink("./files/" . $id ."." . $extension);

$sql = 'DELETE FROM image WHERE image.id = :id';
$stmt = $conn->prepare($sql);
$stmt->execute(
    [
        'id' => $id,
    ]
);


if($destination == 1){
    

        header('Location: gallery-detail.php?id=' . $gallery_id);
        
}
else{
    header('Location: index.php');
}


exit;