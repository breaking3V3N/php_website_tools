<?php
/*
php program attempts to conenct to THEATRE database

Tasks:

    (1) define enviornment variables:
        (a) db_server
        (b) db_username
        (c) db_pass 
        (d) db_name
    (2) create link variable
    (3) check whether connection is successfull or not
*/


define('DB_SERVER','127.0.0.1');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','theatres');


$theatre_link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($theatre_link == false)
    {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }


?>