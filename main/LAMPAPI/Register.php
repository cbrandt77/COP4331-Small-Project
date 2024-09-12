<?php
include '../php/global_functions.php';
header("Access-Control-Allow-Origin: *");

$inData = getRequestInfo();

$conn = getSqlConn();

if ($conn->connect_error) {
    returnJsonHttpResponse(200, $conn->connect_error);
} else {
    $stmt = $conn->prepare("Insert Into Users (FirstName, LastName, Login, Password) VALUE (?, ?, ?, ?);");
    $stmt->bind_param("ssss", $inData["firstName"], $inData["lastName"], $inData["Login"], $inData["Password"]);
    $stmt->execute();

    if ($stmt->error) {
        echo $stmt->error;
    } else if ($stmt->get_result()) {
        echo $stmt->get_result();
    } else {
        echo "Successful Register";

    }
    $stmt->close();
    $conn->close();
}

function getRequestInfo()
{
    $input = file_get_contents("php://input");
    if(empty($input)) {
        echo "Welcome to the Registration Page";
    }
    return json_decode($input, true);
}
