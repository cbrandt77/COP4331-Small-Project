<?php
include '../php/global_functions.php';
include '../php/packets.php';

setCORSHeaders();

$inData = expectPacketType(new ContactDeletePacket());

$conn = getSqlConnOrThrow();

$stmt = $conn->prepare("DELETE FROM Contacts WHERE ID=? AND UserID=?;"); // delete specific contact
$stmt->bind_param("ss", $inData->contact_id, $inData->user_id);

$wasSuccessful = !$stmt->execute();

$stmt->execute();
$stmt->close();
$conn->close();

if (!$wasSuccessful)
    returnJsonHttpResponse(500, new ErrorPacket(ErrorCodes::MYSQL_NO_RESULT, "Could not delete contact."));
else
    http_response_code(200);

