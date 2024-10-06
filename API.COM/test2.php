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
if (isset($data)) {
    $old_username = $data['old_username'];
    $old_password = $data['old_password'];
    $new_username = $data['new_username'];
    $new_password = $data['new_password'];

    $email = $data['email'];
    $address = $data['address'];

} else {
    echo "Name key is missing";
}
$sql = "UPDATE user_data 
            SET username = '$new_username', password = '$new_password', mail = '$email', address = '$address' 
            WHERE username = '$old_username' AND password = '$old_password'";

$result = $connection->query($sql);





if ($result) {
    $userId = "SELECT user_id FROM user_data WHERE username = '$new_username' AND password = '$new_password'";
        $row = $connection->query($userId);
        if ($row->num_rows > 0) {
            $user = $row->fetch_assoc();
            echo json_encode(["success" => "User updated successfully", "affected_rows" => $user['user_id']]);
        } else {
            echo json_encode(["error" => "No rows updated. Check if old username and password are correct."]);
        }
   
} else {
    echo json_encode(["error" => "Error: " . $connection->error]);
}

$connection->close();
?>