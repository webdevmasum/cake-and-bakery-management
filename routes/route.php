<?php
 
 if(isset($_GET["r"])){
  
   $page=$_GET["r"];    

    $folder="routes";
    foreach (glob("{$folder}/*_route.php") as $filename)
    {
        include $filename;
        file_put_contents("route.txt",$filename.PHP_EOL,FILE_APPEND);
    }

    if(!isset($found)){
        include("views/pages/404.php");
    }

 }

?>