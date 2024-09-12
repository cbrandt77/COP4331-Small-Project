<?php
include '../php/global_functions.php';

header("Access-Control-Allow-Origin: *");
$inData = getRequestInfo();

// Added first name, last name, phone number, email fields
$name = $inData["name"];
$phone = $inData["phone"];
$email = $inData["email"];
$userId = $inData["userId"];
$contactId = $inData["contactId"];

$conn = getSqlConn();

if ($conn->connect_error)
{
    returnWithError( $conn->connect_error );
}
else
{
    $stmt = $conn->prepare("UPDATE Contacts SET Name='$name', Phone='$phone', Email='$email' WHERE UserId='userId' AND ID='contactId'"); // added extra fields into insertion
    $stmt->execute();
    $stmt->close();
    $conn->close();
    returnWithError("");
}

function sendResultInfoAsJson( $obj )
{
    header('Content-type: application/json');
    echo $obj;
}

function returnWithError( $err )
{
    $retValue = '{"error":"' . $err . '"}';
    sendResultInfoAsJson( $retValue );
}