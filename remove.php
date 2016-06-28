<?php
require_once("db.php");

global $mysqli;

$id = $_POST['id'];
$query = "DELETE FROM `comments` WHERE `id`={$id}";
$mysqli->query("SET NAMES utf8");
$result = $mysqli->query($query);
if($result){
    removeChild($id);
} else {
    echo "Error: $mysqli->error";
}

function removeChild($parent_id) {
    global $mysqli;

    $query = ("SELECT `id` FROM `comments` WHERE `parent_id`='{$parent_id}'");
    $res = $mysqli->query($query);

    while ($result = $res->fetch_assoc()) {
        $delete = ("DELETE FROM `comments` WHERE `id`={$result['id']}");
        $res = $mysqli->query($delete);
        if($res){
            removeChild($result['id']);
        } else {
            echo "Error: $mysqli->error";
        }
    }
}

?>