<?php
include '../php/global_functions.php';
include '../php/packets.php';

setCORSHeaders();

$inData = expectPacketType(new LoginPacket());

$conn = getSqlConnOrThrow();

$statement = $conn->prepare("SELECT ID, FirstName, LastName FROM COP4331.Users WHERE Login=? AND Password=?");
$statement->bind_param("ss", $inData->username, $inData->password);
$statement->execute();
$result = $statement->get_result();

$row = $result->fetch_object('\SqlUser');

if ($row) {
    returnJsonHttpResponse(200, new LoginConfirmedPacket($row->ID, $row->FirstName, $row->LastName));
} else {
    returnWithError(ErrorCodes::MYSQL_NO_RESULT, "Username or password incorrect.");
}

