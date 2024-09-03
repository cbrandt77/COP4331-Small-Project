<?php
$inData = getRequestInfo();

# how to connect to sql server
$conn = null;
try {
    $conn = new mysqli("localhost", "root", "e07f8731fe94aa4551956316f59dfc788e62b91fcb851dc1", "COP4331", null, "/var/run/mysqld/mysqld.sock");
} catch (Exception $ex) {
    mysqli_errno($conn);
    returnWithError($ex);
    exit();
}

if ($conn->connect_error) {
    returnWithInfo('error', 'error', 'error');
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

    }
}

function getRequestInfo()
{
    return json_decode(file_get_contents('php://input'), true);
}

function returnWithInfo($x, $y, $z)
{
    returnJsonHttpResponse(200, [
        'firstName' => $x,
        'lastName' => $y,
        'id' => $z
    ]);
}

function returnWithError($errorcode) {
    header('Content-Type: application/json; charset=utf-8');
    $errorcode = json_encode($errorcode);
    returnJsonHttpResponse(200, ['error'=>$errorcode]);
}

/*
 * returnJsonHttpResponse, source: https://stackoverflow.com/a/62834046
 * @param $success: Boolean
 * @param $data: Object or Array
 */
function returnJsonHttpResponse($httpCode, $data)
{
    // remove any string that could create an invalid JSON
    // such as PHP Notice, Warning, logs...
    ob_start();
    ob_clean();

    // this will clean up any previously added headers, to start clean
    header_remove();

    // Set the content type to JSON and charset
    // (charset can be set to something else)
    // add any other header you may need, gzip, auth...
    header("Content-type: application/json; charset=utf-8");

    // Set your HTTP response code, refer to HTTP documentation
    http_response_code($httpCode);


    // encode your PHP Object or Array into a JSON string.
    // stdClass or array
    echo json_encode($data);

    // making sure nothing is added
    exit();
}

# once you have the api endpoints, you have to use a tool to test the API in absence of a frontend
# use "PostMan"