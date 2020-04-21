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
if($data['type'] == 'user') {
    if (!isset($data['login']) || $data['login'] == '') {
        echo json_encode(["error" => "invalid login"]);
        exit();
    }
    $mysql = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    $query = "SELECT * FROM users WHERE login='".$data['login']."' LIMIT 1";
    $row = mysqli_query($mysql, $query);
    if (mysqli_num_rows($row) == 0)
        echo json_encode(["error" => "no that user"]);
    else{
        echo json_encode($row->fetch_assoc());
    }
    mysqli_close($mysql);
}
else if($data['type'] == 'car') {
    if (!isset($data['title']) || $data['title'] == '') {
        echo json_encode(["error" => "invalid title"]);
        exit();
    }
    $mysql = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    $query = "SELECT * FROM products WHERE title='".$data['title']."'";
    $row = mysqli_query($mysql, $query);
    if (mysqli_num_rows($row) == 0)
        echo json_encode(["error" => "no that car"]);
    else{
        $rows = [];
        while($t = $row->fetch_assoc())
            $rows[] = $t;
        echo json_encode($rows);
    }
    mysqli_close($mysql);
}else{
    echo json_encode(["error" => "no that type"]);
}