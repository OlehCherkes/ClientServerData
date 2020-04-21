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


$mysql = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
$rows = [];
if($data['type'] == 'user') {
    $row = mysqli_query($mysql,"SELECT * FROM users");
    while ($t = $row->fetch_assoc())
        $rows[] = $t;
    echo json_encode($rows);
}
else if($data['type'] == 'car') {
    $row = mysqli_query($mysql,"SELECT * FROM products");
    while ($t = $row->fetch_assoc())
        $rows[] = $t;
    echo json_encode($rows);
}else{
    echo json_encode(["error" => "no that type"]);
}
mysqli_close($mysql);
