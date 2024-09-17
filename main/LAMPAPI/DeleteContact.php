<?php
include '../php/global_functions.php';
include '../php/packets.php';

setCORSHeaders();

$inData = expectPacketType(new ContactDeletePacket());

$conn = getSqlConn();

if ($conn->connect_error)
{
    http_response_code(500);
    returnWithError(1, $conn->connect_error);
}
else
{
    $stmt = $conn->prepare("DELETE FROM Contacts WHERE ID=? AND UserID=?;"); // delete specific contact
    $stmt->bind_param("ss", $inData->contact_id, $inData->user_id);
    $stmt->execute();
    $stmt->close();

    $conn->close();

    http_response_code(200);
}
