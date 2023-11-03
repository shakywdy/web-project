<?php
/*
 * @Author: shaky
 * @Date: 2023-10-29 23:45:19
 * @LastEditTime: 2023-10-30 19:17:50
 * @FilePath: /web-project/student-index/open.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
if (isset($_POST['userid']) && isset($_POST['id'])) {
    $userid = $_POST['userid'];
    $id = $_POST['id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $query = "DELETE FROM studentdue WHERE id = '$id' AND userid = '$userid'";
    mysqli_query($db, $query);
    mysqli_close($db);
}
if (isset($_POST['title']) && isset($_POST['content'])&& isset($_POST['date'])&& isset($_POST['userid'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $userid = $_POST['userid'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "INSERT INTO studentdue (tittle,content,date,userid) VALUES ('$title','$content','$date','$userid')";
    mysqli_query($db, $sql);
    mysqli_close($db);
}
?>