<?php

    require 'db.php';


    $id = $_GET['id'];
    $gid = $_GET['gid'];
    if ($gid == 0){

        $sql = 'SELECT id FROM image ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $id_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $sql = 'SELECT id FROM image WHERE image.gallery_id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(
             [
                 'id' => $gid,
             ]
             );
             $id_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 $sql = 'SELECT * FROM image WHERE id = :id';
    $stmt = $conn->prepare($sql);                                   
    $stmt->execute(
        [
            'id' => $id,
        ]
    );                                     
    $image = $stmt->fetch();   
        

        if(strpos($_SERVER['HTTP_REFERER'], "gallery-detail.php"))
        {
            $destination = 1;
        }
        else
        {

            $destination = 0;

        }

    $id = $_GET['id'];
    



    $keys = array_keys($id_list);
    
   
      
    $key = array_search($id, $keys);

 
    $ids = [];
    foreach ($id_list as $di) {
        $ids[] = $di['id'];
    }



 while(current($ids) !== $id){
    next($ids);
 }
//$prevId = prev($ids);
//next($ids);
//$nextId = next($ids);





//  if (current($ids) == $ids[0])
//  {
//      $prevId = end($ids);
//      $nextId = $ids[1];
//  }
//  else if(current($ids) == end($ids))
//  {
//      $prevId = prev($ids);
//      $nextId = reset($ids);
//  }
//  else{
//      $prevId = prev($ids);
//      next($ids);
//      $nextId = next($ids);
//  }

if($destination == 1){
    
    $back = "gallery-detail.php?id=" . $gid;
    
}
else{

 $back = "index.php";

}


if (current($ids) == $ids[0])
 {
     $prevId = $back;
     $nextId = "img-detail.php?x&id=" . next($ids) . "&gid=" . $gid;

 }
 else if(current($ids) == end($ids)) 
 {
     $prevId = "img-detail.php?y&id=" . prev($ids) . "&gid=" . $gid;
     $nextId = $back;
 }
 else
 { 
     
     prev($ids);
     $prevId ="img-detail.php?z&id=" . prev($ids) . "&gid=" . $gid; 
     next($ids);
     $nextId = "img-detail.php?zz&id=" . next($ids) . "&gid=" . $gid;
        
 }

?>

<?php 
require 'header.php';
?>
<div id="neviem_uz">
    <h2 id="text-center"><?= $image['title']?></h2>
    <div class="delete-item delete-button-small">
          <a class="delete-item " href="image-delete.php?id=<?= $id?>&extension=<?=$image['extension']?>&destination=<?=$destination?>">
            <img src="./src/close.png" alt="">
            <h2>delete</h2>
        </a>
        
    </div>
      
</div>

    <div class="image-container">
    
    <div class="image-item">

    <img class="image-item" src="./files/<?= $id?>.<?= $image['extension']?>" alt="<?= $image['title']?>">
    
    </div>
    </div>
<div class="navbar-container">
    <nav class="img-navbar-container">
    <div class="img-navbar-item">
        <a href=<?=$prevId?>>
            <img id="mirror" src="./src/arrow.png" alt="">
        </a>
    </div>
    <div class="img-navbar-item delete-button-small">
        <button class="counter-plus">like</button>
        <h1 class="counter-display"></h1>
    </div>
    <div class="img-navbar-item like-item">
        <a href=<?=$nextId?>>
            <img src="./src/arrow.png" alt="">
        </a>
    </div>
    </nav>
</div>



<script>

let counterDisplayElem = document.querySelector('.counter-display');
let counterPlusElem = document.querySelector('.counter-plus');

let count = 0;

updateDisplay();

counterPlusElem.addEventListener("click",()=>{
    count++;
    updateDisplay();
}) ;

function updateDisplay(){
    counterDisplayElem.innerHTML = count;
};


</script>

</body>
</html>