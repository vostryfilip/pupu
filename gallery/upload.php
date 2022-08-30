<?php 

if(!isset($_POST['title'])){
    die ('něco je špatně');

}

$allowedMimeTypes = [
    'image/jpeg',
    'image/png',
    'image/jpg',
    'video/mp4',
    'video/mov',
    'video/webm',

];

$fileMimeType = $_FILES['file']['type'];

if (in_array($fileMimeType, $allowedMimeTypes) === false)
{
    die('špatný formát souboru' . $fileMimeType);
}

require 'db.php';


$filename = $_FILES['file']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

$sql = 'INSERT INTO image 
        SET original_name = :original_name, extension = :extension, title = :title, created_at = now(), gallery_id = :gallery_id';
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':original_name' => $filename,
    ':extension' => $ext,
    ':title' => $_POST['title'],
    ':gallery_id' => $_POST['gallery_id'],
]);

$lastId = $conn->lastInsertId();

$tmpPath = $_FILES['file']['tmp_name'];

$origName = $_FILES['file']['name'];


$destPath = sprintf('files/%s.%s', $lastId, $ext);

var_dump($tmpPath, $destPath);

move_uploaded_file($tmpPath, $destPath);

header('Location: index.php');

die;

