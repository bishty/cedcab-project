<?php 'header.php'?>
<?php 

 if(isset($_SESSION['user']) && $_SESSION['user']['is_admin']==0){
    
    }else{
    die("Sorry you are not allowed to enter!!!");
    }?>