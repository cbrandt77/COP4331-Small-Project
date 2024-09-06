
<?php
include '../php/globals.php';

header("Access-Control-Allow-Origin: *");

$inData = getRequestInfo();

if ($inData == null) {
    http_response_code(400);
    returnWithError("Unable to parse request body as JSON.");
    return;
}

$id = 0;
$firstName = "";
$lastName = "";

$conn = getSqlConn();
if( $conn->connect_error )
{
	returnWithError( $conn->connect_error );
}
else
{
	$stmt = $conn->prepare("SELECT ID,firstName,lastName FROM Users WHERE Login=? AND Password=?");
	$stmt->bind_param("ss", $inData["login"], $inData["password"]);
	$stmt->execute();
	$result = $stmt->get_result();

	if( $row = $result->fetch_assoc()  )
	{
        // Spec: /ts/networkhandling.ts:Packets.LoginResponsePacket
		returnJsonHttpResponse(200, [
            'firstName' => $row['firstName'],
            'lastName' => $row['lastName'],
            'id'=> $row['ID']
        ]);
	}
	else
	{
		returnWithError("No Records Found");
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

function returnWithInfo( $firstName, $lastName, $id )
{
	$retValue = '{"id":' . $id . ',"firstName":"' . $firstName . '","lastName":"' . $lastName . '","error":""}';
	sendResultInfoAsJson( $retValue );
}