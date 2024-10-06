
<?php header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');

   $server="localhost";
    $username="root";
    $password="";
    $database="r_com";

    $connection= new mysqli($server,$username,$password,$database);

    if ($connection->connect_error) {
        die("connection error".$connection->connect_error);
    }




$data=json_decode(file_get_contents("php://input"), true);

$user_id=$data['user_id'];


 $sql = 'DELETE FROM user_data WHERE user_id = "'.$user_id.'";
';


  $result=$connection->query($sql);
?>