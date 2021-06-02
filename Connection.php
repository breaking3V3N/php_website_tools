<?php
 /*database credentials. we will use these to attempt to connect to our sql database. 
    (1)Default username: root
    (2)Default password: ''  
 ]*/
 define('DB_SERVER','127.0.0.1');
 define('DB_USERNAME','root');
 define('DB_PASSWORD','');
 define('DB_NAME','demo');

 $link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

 #check whether or not connection to the database specified above connects. 

 if($link == false){
     die("ERROR: Could not connect. " . mysqli_connect_error());
 }
 
?>