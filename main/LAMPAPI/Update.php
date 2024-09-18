<?php
include '../php/global_functions.php';
include '../php/packets.php';

setCORSHeaders();
$inData = expectPacketType(new ContactEditPacket());

$conn = getSqlConnOrThrow();

$stmt = $conn->prepare("UPDATE Contacts SET Name=?, Phone=?, Email=? WHERE ID=? AND UserID=?");
$stmt->bind_param("sssii", $inData->name, $inData->phone_number, $inData->email_address, $inData->contact_id, $inData->user_id);

if (!$stmt->execute()) {
    $err = $stmt->error;
    $stmt->close();

    $conn->close();
    returnJsonHttpResponse(200, new ErrorPacket(ErrorCodes::MYSQL_NO_RESULT, $err));
    exit();
}
$stmt->close();


$stmt = $conn->prepare("SELECT * FROM Contacts WHERE ID=? AND UserID=?");
$stmt->bind_param("ii", $inData->contact_id, $inData->user_id);
$stmt->execute();
$res = $stmt->get_result();

if (!$res) {
    returnJsonHttpResponse(500, new ErrorPacket(ErrorCodes::MYSQL_NO_RESULT, "No such contact found."));
    $stmt->close();
    $conn->close();
    exit();
}

$updatedContact = $res->fetch_object('\SqlContact');
$stmt->close();
$conn->close();

if ($updatedContact)
    returnJsonHttpResponse(200, OutgoingContactObject::fromSqlContact($updatedContact));
else
    returnJsonHttpResponse(500, new ErrorPacket(ErrorCodes::MYSQL_NO_RESULT, "Could not find updated contact."));

