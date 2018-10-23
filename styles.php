<?php 
 if ( isset($_COOKIE['mystyle']) ) setcookie("mystyle", "", time()-3600);
 
 if ( $_GET['style']==2 ) setcookie("mystyle", 2, time()+86400*120);
 else setcookie("mystyle", 1, time()+86400*120);

 header("Location: index.php");
 ?> 