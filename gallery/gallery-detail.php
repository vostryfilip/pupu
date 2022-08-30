<?php
require 'db.php';

    $id = $_GET['id'];
    if ($id == 0){

        $sql = 'SELECT * FROM image
        ORDER BY id ASC';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $images = $stmt->fetchAll();

    }
    else{
        $sql = 'SELECT * FROM image
                WHERE gallery_id = :id
                ORDER BY id ASC';
        $stmt = $conn->prepare($sql);
        $stmt->execute(
            [
                'id' => $id,
            ]
        );
        $images = $stmt->fetchAll();

    }

    $sql = 'SELECT image.id FROM image WHERE image.gallery_id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->execute(
         [
             'id' => $id,
         ]
         );
    $id_list = $stmt->fetchAll();

        
     
        


?>

<?php require 'header.php';?>
<h1></h1>

<div class="gallery-container">
    <?php foreach ($images as $i):?>
    <div class="gallery-item">
        <a href="img-detail.php?id=<?= next($i) ?>&gid=<?= $i['gallery_id'] ?>">
            <img id="hover-scale" src="./files/<?= $i['id']?>.<?= $i['extension']?>" alt="">
        </a>
        
    

    </div>
    <?php endforeach;?>
</div>






</body>
</html>