<?php
    $host = '127.0.0.1';
   $user = 'root';
   $password = '';
   $port = 3306;
   $DBname = 'assurance';

$conx = mysqli_connect($host,$user,$password);

if($conx->connect_error){
    http_response_code(500);
    echo 'connnection failed: '.mysqli_connect_error() ."<br>";
}

if (!mysqli_query($conx,"CREATE DATABASE IF NOT EXISTS ".$DBname)) {
    http_response_code(500);
    echo "Error creating the database:". mysqli_error($conx) ."<br>";
    mysqli_close($conx);
}

if (!mysqli_query($conx,"use ".$DBname)) {
    http_response_code(500);
    echo "Error selecting the database:". mysqli_error($conx) ."<br>" ;
    mysqli_close($conx);
}

$table = "CREATE TABLE IF NOT EXISTS CONTACT(
    id INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(90) NOT NULL,
    Secteur VARCHAR(70) NOT NULL,
    N_Telephone VARCHAR(15) NOT NULL,
    Ville VARCHAR(10),
    reg_date VARCHAR(100));";

if (!mysqli_query($conx,$table)) {
    echo "Error creating the table:". mysqli_error($conx)  ."<br>";
    mysqli_close($conx);
}


if (isset($_POST["Contact_Name"])) {
    echo "the was founded <br>";
    $name = mysqli_real_escape_string($conx, $_POST["Contact_Name"]);
    $secteur = mysqli_real_escape_string($conx, $_POST["secteur"]);
    $phone = mysqli_real_escape_string($conx, $_POST["Phone_Number"]);
    $Ville = mysqli_real_escape_string($conx, $_POST["City"]);
    $date = mysqli_real_escape_string($conx,date("Y-m-d H:i:s"));

    $insertValues = "INSERT INTO CONTACT (Nom,Secteur,N_Telephone,Ville,reg_date) VALUES ('$name','$secteur','$phone','$Ville','$date')";
    if (!mysqli_query($conx,$insertValues)) {
        echo "Error inserting the data:". mysqli_error($conx) ."<br>";
        mysqli_close($conx);
        echo "the insert is not  working <br>";
    }else{
        http_response_code(200);
        echo "the insert is  working <br>";
    }
}else{
    echo "Not post was founded! <br>";
    http_response_code(400);
}
 
?>
