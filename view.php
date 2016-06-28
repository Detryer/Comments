<?php
require_once ("db.php");

function viewComments() {
    global $mysqli;
    $query = "SELECT * FROM `comments` WHERE `parent_id`=0 ORDER BY `date` DESC";
    $mysqli->query("SET NAMES utf8");
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        getComment($row);
    }
}

function getComment($row){
    global $mysqli;

    echo "<li class='comment'>";
    echo "<div class='name'>{$row['name']}</div>";
    echo "<div class='date'>{$row['date']}</div>";
    echo "<p class='comment_text'>{$row['text']}</p>";
    echo "<a href='#' class='delete' id='{$row['id']}'>Delete</a>";
    echo "<a href='#' class='reply' id='{$row['id']}'>Reply</a>";

    $query = ("SELECT * FROM `comments` WHERE `parent_id`='{$row['id']}'");
    $res = $mysqli->query($query);

    $i = 0;
    if($res->num_rows > 0 && $i < 5){
        echo "<ul class='commentslist'>";
        while($result = $res->fetch_assoc()){
            getComment($result);
        }
        echo "</ul>";
        $i++;
    }

    echo "</li>";
}

?>