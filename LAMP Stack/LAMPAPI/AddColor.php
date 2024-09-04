<?php
include '../php/globals.php';

header("Access-Control-Allow-Origin: *");
	$inData = getRequestInfo();
	
	// Added first name, last name, phone number, email fields
	$firstName = $inData["firstName"];
	$lastName = $inData["lastName"];
	$phoneNumber = $inData["phoneNumber"];
	$email = $inData["email"];
	$userId = $inData["userId"];

	$conn = getSqlConn();

    if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$stmt = $conn->prepare("INSERT into Contacts (UserId, FirstName, LastName, PhoneNumber, Email) VALUES (?, ?, ?, ?, ?)"); // added extra fields into insertion
		$stmt->bind_param("sssss", $userId, $firstName, $lastName, $phoneNumber, $email); // added extra fields
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
	
?>