<?php
# not actually adding color, just whateer example
$inData = getRequestInfo(); # TODO
$id = 0;
$firstName = "";
$lastName = "";

# how to connect to sql server
$conn = new mysqli("localhost", "root", "password", "COP4331");

if ($conn->connect_error) {
    # do error stuff
}

$statement = $conn->prepare("SELECT ID, firstName, lastName FROM Contacts WHERE Login=? AND Password=?");
$statement->bind_param("ss", $inData['login'], $inData['password']);
$statement->execute();
$result = $statement->get_result();
$row = $result->fetch_assoc();

if ($row) {
    returnWithInfo($row['firstName'], $row['lastName'], $row['id']);
} else {
    returnWithError("No row found.");
}

function getRequestInfo() {
    return json_decode(file_get_contents('php://input'), true);
}

# once you have the api endpoints, you have to use a tool to test the API in absence of a frontend
# use "PostMan"
# could probably just use a json script