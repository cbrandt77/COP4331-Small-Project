<?php
include '../php/globals.php';

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
		$stmt = $conn->prepare("DELETE FROM Contact WHERE ID = ?;"); // delete specific contact
		$stmt->bind_param("ssss", $contactId);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		returnWithError("");
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
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}