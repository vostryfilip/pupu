<?php 

$id = $_GET['id'];
$gid = $_GET['gid'];



$_SESSION['liked_images'] = array_push($id);
array_unique($_SESSION['liked_images']);

var_dump($_SESSION['liked_images']);
//header('Location: img-detail.php?id=' . $id . "&gid=" . $gid);

//exit;

?>