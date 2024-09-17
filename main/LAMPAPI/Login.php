<?php
include '../php/global_functions.php';
include '../php/packets.php';

setCORSHeaders();

$inData = expectPacketType(new LoginPacket());

$conn = getSqlConn();

if ($conn->connect_error) {
    returnJsonHttpResponse(500, new ErrorPacket(1, "unable to connect to sql database"));
} else {
    $statement = $conn->prepare("SELECT ID, FirstName, LastName FROM COP4331.Users WHERE Login=? AND Password=?");
    $statement->bind_param("ss", $inData['username'], $inData['password']);
    $statement->execute();
    $result = $statement->get_result();

    /** @var SqlUser $row */
    $row = $result->fetch_assoc();

    if ($row) {
        returnJsonHttpResponse(200, new LoginConfirmedPacket($row->ID, $row->FirstName, $row->LastName));
    } else {
        returnWithError(0, "Username or password incorrect.");
    }
}
