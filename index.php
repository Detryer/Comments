<?php header('Content-Type: text/html; charset=utf-8') ?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <link rel='stylesheet' type='text/css' href='style.css' media='all'/>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
    <script src='ajax.js'></script>
    <meta http-equiv='content-type' content='text/html; charset=UTF-8'/>
    <title>Comments</title>
</head>
<body onload="depth()">
<div class='wrapper'>
    <form class='comment_form' method='post' action=''>
        <input type='text' id='name' placeholder='Your name' required>
        <textarea id='text' placeholder='Your text' required></textarea>
        <input type='hidden' name='parent_id' id='parent_id' value='0'>
        <button id='add' onclick="addComment()">Add</button>
    </form>
    <div class='output'>
        <h2>Comments</h2>
        <ul class='commentslist'>
            <?php include_once('view.php');
            viewComments() ?>
        </ul>
    </div>
</div>
</body>
</html>