<?php
require 'db.php';


$sql = 'SELECT * FROM gallery 
        ORDER BY id ASC';
$stmt = $conn->prepare($sql);
$stmt->execute();
$gallery = $stmt->fetchAll();

?>
<?php require 'header.php';?>

<h1 style="text-align:center;" >Galleries</h1>
<div class="album-container">


<div class="album-item">

<h2>all images</h2>

</div>


<?php foreach($gallery as $g): ?>
<div class="sub-item">

<div class="album-item">
    <a href="gallery-detail.php?id=<?= $g['id']?>">
<h3><?=substr($g['name_gallery'],0,12)?></h3>
</a>

</div>
<div class="delete-button-small">
    <a href="gallery-delete.php?id=<?= $g['id']?>">
        <img id="img" src="./src/close.png" alt="delete">
    </a>
</div>
</div>
<?php endforeach;?>


</div>



</body>
</html>