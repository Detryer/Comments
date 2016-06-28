<?php
require_once("db.php");

function viewComments() {
    global $mysqli;
    $query = "SELECT * FROM `comments` WHERE `parent_id`=0 ORDER BY `date` DESC";
    $mysqli->query("SET NAMES utf8");
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        getComment($row, 0);
    }
}

function getComment($row, $depth) {
    global $mysqli;
    static $depth;

    echo "<li class='comment'>";
    echo "<div class='name'>{$row['name']}</div>";
    echo "<div class='date'>{$row['date']}</div>";
    echo "<p class='comment_text'>{$row['text']}</p>";
    echo "<a href='#' class='delete' id='{$row['id']}'>Delete</a>";
    echo "<a href='#' class='reply' id='{$row['id']}'>Reply</a>";

    $query = ("SELECT * FROM `comments` WHERE `parent_id`='{$row['id']}'");
    $res = $mysqli->query($query);

    if ($res->num_rows > 0) {
        echo "<ul class='commentslist'>";
        while ($result = $res->fetch_assoc()) {
            if ($depth < 6) {
                getComment($result, $depth++);
            }
        }
        echo "</ul>";
    }

    echo "</li>";
    $depth++;
}


?>