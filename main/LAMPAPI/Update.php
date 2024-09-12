<?php
include '../php/global_functions.php';
include '../php/packets.php';

setCORSHeaders();
$inData = expectPacketType(new ContactEditPacket());

$conn = getSqlConn();

if ($conn->connect_error) {
    returnJsonHttpResponse(500, new ErrorPacket(1, $conn->connect_error));
} else {
    $stmt = $conn->prepare("UPDATE Contacts SET Name=?, Phone=?, Email=? WHERE ID=? AND UserID=?");
    $stmt->bind_param("sssii", $inData->name, $inData->phone_number, $inData->email_address, $inData->contact_id, $inData->user_id);
    $stmt->execute();
    if (!$stmt->get_result()) {
        $err = $stmt->error;
        $stmt->close();
        returnJsonHttpResponse(200, new ErrorPacket(4, $err));
    } else {
        $stmt->close();
    }


    $stmt = $conn->prepare("SELECT * FROM Contacts WHERE ID=? AND UserID=?");
    $stmt->bind_param("ii", $inData->contact_id, $inData->user_id);
    $stmt->execute();

    $updatedContact = $stmt->get_result()->fetch_object('\SqlContact');
    $stmt->close();
    $conn->close();

    returnJsonHttpResponse(200, OutgoingContactObject::fromSqlContact($updatedContact));
}
