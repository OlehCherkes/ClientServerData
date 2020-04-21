<?php
require_once "resourses.php";
if(!isset($_GET['data'])) {
    echo json_encode(["error" => "no data"]);
    exit();
}
$data = json_decode($_GET['data'], true);
var_dump($data);echo "<br>";
if(!isset($data['type']) || $data['type'] == '' || $data['type'] != 'car') {
    echo json_encode(["error" => "invalid type"]);
    exit();
}
if(!isset($data['title']) || $data['title'] == ''){
    echo json_encode(["error"=>"invalid title"]);
    exit();
}
if(!isset($data['price']) || $data['price'] == ''){
    echo json_encode(["error"=>"invalid price"]);
    exit();
}


$mysql = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
$query = "INSERT INTO `products`(`id`, `title`, `price`) VALUES (0,'".$data['title']."','".$data['price']."')";
    mysqli_query($mysql, $query);
mysqli_close($mysql);