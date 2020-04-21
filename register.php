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
if(!isset($data['lvl_access']) || $data['lvl_access'] == ''){
    echo json_encode(["error"=>"invalid lvl access"]);
    exit();
}


$mysql = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
$query = "SELECT * FROM users WHERE login='".$data['login']."'";
if (mysqli_num_rows(mysqli_query($mysql, $query)) > 0) {
    echo json_encode(["error" => "a user with that name already exists"]);
    exit();
}
$query = "INSERT INTO `users`(`id`, `login`, `password`, `lvl_access`) VALUES (0,'".$data['login']."','".$data['password']."','".$data['lvl_access']."')";
    mysqli_query($mysql, $query);
mysqli_close($mysql);