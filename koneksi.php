<?php
    date_default_timezone_set('Asia/Jakarta');
    
    $_servername = "localhost";
    $username = "root";
    $password = "";
    $db = "webdailyjournal"; //nama database

    //create connection
    $conn = new mysqli($_servername, $username, $password, $db);

    //check connection
    if($conn -> connect_error){
        //jika ada, hentikan script dan tampilkan pesan error
        die("Connection failed: " . $conn->connect_error);
    }

    //echo "Connected successfully <hr>";
?>