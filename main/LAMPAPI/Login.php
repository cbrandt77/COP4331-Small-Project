<?php
include '../php/global_functions.php';

header("Access-Control-Allow-Origin: *");

$inData = getRequestInfo();

# how to connect to sql server
$conn = null;
try {
    $conn = new mysqli("localhost", "root", "e07f8731fe94aa4551956316f59dfc788e62b91fcb851dc1", "COP4331", null, "/var/run/mysqld/mysqld.sock");
} catch (Exception $ex) {
    returnWithError($ex, 0xB4D);
    exit();
}

if ($conn->connect_error) {
    returnWithError("unable to connect to sql database", 0xB4D);
    # do error stuff
} else {
    $statement = $conn->prepare("SELECT ID, FirstName, LastName FROM COP4331.Users WHERE Login=? AND Password=?");
    $statement->bind_param("ss", $inData['login'], $inData['password']);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        returnWithInfo($row['firstName'], $row['lastName'], $row['id']);
    } else {
        returnWithError("Username or password incorrect.", 0);
    }
}


function returnWithInfo($x, $y, $z)
{
    returnJsonHttpResponse(200, [
        'first_name' => $x,
        'last_name' => $y,
        'id' => $z
    ]);
}

function returnWithError($error, $code) {
    $error = json_encode($error);
    returnJsonHttpResponse(200, ['error_code'=>$code, 'reason'=>$error]);
}
