<?php 

    $host = "localhost";
    $dbname = "student";
    $user = "root";
    $password = "";
    try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $err){
    echo $err->getMessage();
}
?>
