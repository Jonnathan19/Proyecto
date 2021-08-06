<?php
$servername = "127.0.0.1";

$dbname = "sensor";

$username = "root";

$password = "";

$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $temperatura= $evento= $date= $name = $type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $temperatura = test_input($_POST["val"]);
	    $evento = test_input($_POST["event"]);
        $date = test_input($_POST["date"]);
        $name = test_input($_POST["name"]);
        $type = test_input($_POST["type"]);

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO sensors (val,event,date, name,type) VALUES ('$temperatura','$evento','$date','$name','$type')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
