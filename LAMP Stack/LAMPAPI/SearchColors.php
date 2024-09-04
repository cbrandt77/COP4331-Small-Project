<?php
include '../php/globals.php';

header("Access-Control-Allow-Origin: *");

$inData = getRequestInfo();

$searchResults = "";
$searchCount = 0;

$conn = getSqlConn();
if ($conn->connect_error)
{
    returnWithError( $conn->connect_error );
}
else
{
    $stmt = $conn->prepare("SELECT FirstName, LastName, PhoneNumber, Email FROM Contacts WHERE (FirstName LIKE ? OR LastName LIKE ?) AND UserID=?");
    $colorName = "%" . $inData["search"] . "%";
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $inData["userId"]);
    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc())
    {
        if( $searchCount > 0 )
        {
            $searchResults .= ",";
        }
        $searchCount++;
        $searchResults .= '{"firstName":"' . $row["FirstName"] . '", "lastName":"' . $row["LastName"] . '", "phoneNumber":"' . $row["PhoneNumber"] . '", "email":"' . $row["Email"] . '"}';
    }

    if( $searchCount == 0 )
    {
        returnWithError( "No Records Found" );
    }
    else
    {
        returnWithInfo( $searchResults );
    }

    $stmt->close();
    $conn->close();
}

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
    $retValue = '{"id":0,"firstName":"","lastName":"","phoneNumber":"","email":"","error":"' . $err . '"}';
    sendResultInfoAsJson( $retValue );
}

function returnWithInfo( $searchResults )
{
    $retValue = '{"results":[' . $searchResults . '],"error":""}';
    sendResultInfoAsJson( $retValue );
}