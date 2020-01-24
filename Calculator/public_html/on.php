<?php

//
$input = $_REQUEST["save"];

$calcArray = json_decode( $input, true);


//Check whether this is from a POST request
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $calcArray[0];
    $purchase = $calcArray[1];
    $deposit = $calcArray[2];
    $year = $calcArray[3];
    $rate = $calcArray[4];
    
    echo "name: $name, $purchase, $deposit, $year, $rate";
    
    //Make Database connection
    $servername = "localhost";
    $username = "id12331285_lifecheq";
    $password = "DBPassword";
    $dbname = "id12331285_calcdb";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        //die("Connection failed: " . $conn->connect_error);
        echo $conn->connect_error;
    }
    
    //Create SQL Query
    $sql = "INSERT INTO Calcs (name, purchase, deposit, year, rate) VALUES ('$name', '$purchase', '$deposit', '$year', '$rate')";

    //Perfrom SQL Query on Database
    if( $conn->query( $sql)){
        echo "Successfully saved";
    } else{
        echo "Execution unsuccessful";
    }
    
}

?>
