<?php

$id = $_GET['id'];

require 'db.php';

$sql = 'SELECT * FROM image
        WHERE gallery_id = :id';

$stmt = $conn->prepare($sql);
$stmt->execute(
    [
        'id' => $id,
    ]
);
$images = $stmt->fetchALL();

foreach ($images as $i){

    unlink("./files/" . $i['id'] .".". $i['extension']);

};


$sql = 'DELETE FROM gallery WHERE id = :id';
$stmt = $conn->prepare($sql);
$stmt->execute(
    [
        'id' => $id,
    ]
);

header('Location: gallery.php');
exit;