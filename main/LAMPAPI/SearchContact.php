<?php
include '../php/global_functions.php';

header("Access-Control-Allow-Origin: *");
$inData = getRequestInfo();

// get ID of contact to be deleted
$contactId = $inData["contactId"];

$conn = getSqlConn();

if ($conn->connect_error)
{
    returnWithError( $conn->connect_error );
}
else
{
    $stmt = $conn->prepare("DELETE FROM Contacts WHERE ID = ?;"); // delete specific contact
    $stmt->bind_param("i", $contactId);
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