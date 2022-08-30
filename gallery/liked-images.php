<?php 

require 'header.php';
require 'db.php';


$sql = 'SELECT * FROM image
ORDER BY id ASC';
$stmt = $conn->prepare($sql);
$stmt->execute();
$images = $stmt->fetchAll();
//var_dump($images);
var_dump($_SESSION['liked_images']);

$ids = array_search($_SESSION['liked_images'], $images);
//var_dump($ids);
?>




<div class="gallery-container">
<?php foreach ($images as $img): ?>
    <div class="gallery-item">
      <a href="img-detail.php?id=<?= $img['id']?>&gid=0">
    <img id="hover-scale" src="files/<?= $img['id'] ?>.<?= $img['extension'] ?>"
         alt="<?= $img['title'] ?>">
    </a>  
    </div>
<?php endforeach; ?>
</div>
</body>
</html>