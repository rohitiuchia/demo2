
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$server = "localhost";
$username = "root";
$password = "";
$database = "r_com";

$connection = new mysqli($server, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection error: " . $connection->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);
if (isset($data['name'])) {
    $name = $data['name'];
    $password = $data['password'];
    $user_id = $data['user_id'];
    $mail = $data['mail'];
    $address = $data['address'];
} else {
    echo "Name key is missing";
}
$sql = 'INSERT INTO user_data (username, password, user_type, mail, address) VALUES ("' . $name . '", "' . $password . '", "' . $user_id . '", "' . $mail . '", "' . $address . '")';

$result = $connection->query($sql);

if ($result) {
    echo json_encode(["success" => "User added successfully"]);
} else {
    echo json_encode(["error" => "Error: " . $connection->error]);
}

$connection->close();
?>
