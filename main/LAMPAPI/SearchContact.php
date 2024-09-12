<?php
include '../php/global_functions.php';

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
    $stmt = $conn->prepare("select Name from Contacts where Name like ? and UserID=?");
    $contactName = "%" . $inData["search"] . "%";
    $stmt->bind_param("ss", $contactName, $inData["userId"]);
    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc())
    {
        if( $searchCount > 0 )
        {
            $searchResults .= ",";
        }
        $searchCount++;
        $searchResults .= '{"name":"' . $row["Name"] . '", "phone":"' . $row["Phone"] . '", "email":"' . $row["Email"] . '"}';
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


function sendResultInfoAsJson( $obj )
{
    header('Content-type: application/json');
    echo $obj;
}

function returnWithError( $err )
{
    $retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
    sendResultInfoAsJson( $retValue );
}


function returnWithInfo( $searchResults )
{
    $retValue = '{"results":[' . $searchResults . '],"error":""}';
    sendResultInfoAsJson( $retValue );
}
