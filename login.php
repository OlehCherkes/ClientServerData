<?php
require_once "resourses.php";
if(!isset($_GET['data'])) {
    echo json_encode(["error" => "no data"]);
    exit();
}

$data = json_decode($_GET['data'], true);
//var_dump($data);echo "<br>";

if(!isset($data['login']) || $data['login'] == '') {
    echo json_encode(["error" => "invalid login"]);
    exit();
}
if(!isset($data['password']) || $data['login'] == ''){
    echo json_encode(["error"=>"invalid password"]);
    exit();
}


$mysql = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
$query = "SELECT * FROM users WHERE login='".$data['login']."' AND password='".$data['password']."' LIMIT 1";
if(mysqli_num_rows(mysqli_query($mysql, $query)) == 0)
    echo json_encode(["error"=>"no such user"]);
mysqli_close($mysql);