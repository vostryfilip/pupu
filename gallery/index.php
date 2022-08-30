<?php
    
require 'db.php';                                                          

$sql = 'SELECT * FROM image                                     
        ORDER BY created_at ASC';                                  
$stmt = $conn->prepare($sql);                                   
$stmt->execute();                                   
$images = $stmt->fetchAll();                                    
                                        
$sql = 'SELECT * FROM gallery                                       
        ORDER BY id ASC';                                   
$stmt = $conn->prepare($sql);                                       
$stmt->execute();                                   
$gallery = $stmt->fetchAll();                                   


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/style.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;0,800;0,900;1,800;1,900&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet"> 
</head>
<body>
<nav>
<div class="menu-container">
    <div class="menu-item"><a href="index.php">Nahrát</a></div>
    <div class="menu-item"><a href="gallery.php">Galerie</a></div>
    <div class="menu-item"><a href="index.php">Oblíbené</a></div>

</div>
</nav>


<div class="add">
<form method="post"
      enctype="multipart/form-data"
      action="upload.php">
    <div>
        <label for="title">
            comment
            <input type="text" name="title" id="title">
        </label>
    </div>
    <div>
        <label for="file">
            File: <input type="file"
                           id="file"
                           name="file"
                           accept="image/*">
        </label>
    </div>
    <div>
    <select value="1" name="gallery_id" >
    <?php foreach($gallery as $g):?>
 
        <option value="<?= $g['id']?>"> <?= $g['name_gallery']?></option>
    
    <?php endforeach;?>
   </select>
    </div>
    <div class="send-button">
        <button>upload</button>
    </div>
    
</form>



<form action="new-gallery.php" method="POST">
<h3>Přidat novou galerii</h3>
<div>
<input name="name_gallery" placeholder="název galerie" type="text">
</div>
<button>Přidat</button>
</form>




</div>
<h2>Newest images:</h2>
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