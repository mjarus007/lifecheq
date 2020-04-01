<?php

$input = "";
$request = "";

if( isset( $_REQUEST["save"] )){
$input = $_REQUEST["save"];
}

if( isset( $_REQUEST["request"])){
$request = $_REQUEST["request"];
}

$calcArray = json_decode( $input, true);
/*Hey comments can be blocks on PHP?
That's great!
Just like Java*/

//This is the cool feature that I added from the cool-feature branch

//Check whether this is from a POST request
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $calcArray[0];
    $purchase = $calcArray[1];
    $deposit = $calcArray[2];
    $year = $calcArray[3];
    $rate = $calcArray[4];
    
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
    
    if($input){
    //If the user wants to save the calculation data on DB
    
    //Create SQL Query
    $sql = "INSERT INTO Calcs (name, purchase, deposit, year, rate) VALUES ('$name', '$purchase', '$deposit', '$year', '$rate')";

    //Perfrom SQL Query on Database
    if( $conn->query( $sql)){
        echo "Successfully saved";
    } else{
        echo "Execution unsuccessful";
    }
    }
    
    if( $request){
        //If user wants to download DB data
        
        //Create SQL Query
        $sql = "SELECT * FROM Calcs";

        //Perfrom SQL Query on Database
        $result = $conn->query($sql);
        
        $returnArray = [];
        
       while($row =  $result->fetch_assoc()){
           array_push($returnArray, $row ) ;
        }
        
        $jsonText = json_encode($returnArray);
        
        echo $jsonText;
        
    }
    
    //Close the database connection
    $conn->close();
    
}

?>
