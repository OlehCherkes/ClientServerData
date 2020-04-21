<?php
require_once "resourses.php";
if(!isset($_GET['data'])) {
    echo json_encode(["error" => "no data"]);
    exit();
}

$data = json_decode($_GET['data'], true);
//var_dump($data);echo "<br>";

if(!isset($data['type']) || $data['type'] == '' || ($data['type'] != 'car' && $data['type'] != 'user')){
    echo json_encode(["error" => "invalid type"]);
    exit();
}
if(!isset($data['id']) || $data['id'] == ''){
    echo json_encode(["error" => "invalid id"]);
    exit();
}

if($data['type'] == 'user') {
    $mysql = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    $query = "SELECT * FROM users WHERE id='".$data['id']."' LIMIT 1";
    $row = mysqli_query($mysql, $query);
    if (mysqli_num_rows($row) == 0)
        echo json_encode(["error" => "no that user"]);
    else{
        $query = "DELETE FROM `users` WHERE `id`=".$data['id'];
        mysqli_query($mysql, $query);
    }
    mysqli_close($mysql);
}
else if($data['type'] == 'car') {
    $mysql = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    $query = "SELECT * FROM products WHERE id='".$data['id']."'";
    $row = mysqli_query($mysql, $query);
    if (mysqli_num_rows($row) == 0)
        echo json_encode(["error" => "no that car"]);
    else{
        $query = "DELETE FROM `products` WHERE `id`=".$data['id'];
        mysqli_query($mysql, $query);
    }
    mysqli_close($mysql);
}else{
    echo json_encode(["error" => "no that type"]);
}