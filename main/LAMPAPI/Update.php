<?php
include '../php/global_functions.php';

header("Access-Control-Allow-Origin: *");
$inData = getRequestInfo();


$conn = getSqlConn();

if ($conn->connect_error)
{
    returnWithError( $conn->connect_error );
}
else
{
    $stmt = $conn->prepare("UPDATE Contacts SET Name=?, Phone=?, Email=? WHERE ID=? AND UserID=?");
    $stmt->bind_param("sssii", $inData["name"], $inData["phone"], $inData["email"], $inData["contactId"], $inData["userId"]);
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
