<?php
include '../php/globals.php';

header("Access-Control-Allow-Origin: *");
$username = $_POST['username'];
$password = $_POST['password'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];

$conn = getSqlConn();

if ($conn->connect_error) {
    returnJsonHttpResponse(200, $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO Users (FirstName, LastName, Login, Password) VALUE (?, ?, ?, ?);");
    $stmt->bind_param("ssss", $firstName, $lastName, $username, $password);
    $stmt->execute();

    if ($stmt->error) {
        echo $stmt->error;
    } else if ($stmt->get_result()) {
        echo $stmt->get_result();
    } else {
        echo "thing happened at least";

    }
    $stmt->close();
    $conn->close();
}

/*
function getRequestInfo()
{
    return json_decode(file_get_contents('php://input'), true);
}

function sendResultInfoAsJson( $obj )
{
    header('Content-type: application/json');
    echo $obj;
}

function returnWithError( $err )
{
    $retValue = '{"firstName":"","lastName":"","username":"","password":"","error":"' . $err . '"}';
    sendResultInfoAsJson( $retValue );
}

function returnWithInfo( $searchResults )
{
    $retValue = '{"results":[' . $searchResults . '],"error":""}';
    sendResultInfoAsJson( $retValue );
*/