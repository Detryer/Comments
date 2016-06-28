<?php
require_once("db.php");

global $mysqli;

$name = $mysqli->real_escape_string(trim($_POST['name']));
$text = $mysqli->real_escape_string(trim($_POST['text']));
$parent_id = $_POST['parent_id'];
$date = date("Y-m-d H:i:s");

$query = "INSERT INTO `comments`(`text`, `name`, `parent_id`, `date`)  VALUES ('{$text}','{$name}', '{$parent_id}', '{$date}')";
$mysqli->query("SET NAMES utf8");
$result = $mysqli->query($query);

$new = $mysqli->query("SELECT `id` FROM `comments` WHERE `name`='{$name}' AND `text`='{$text}' AND `parent_id`='{$parent_id}'");
$id = $new->fetch_assoc();

echo $id['id'];

if($result){
    echo json_encode(array("name" => $name, "text" => $text, "parent_id" => $parent_id, "date" => $date));
}