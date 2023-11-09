<?php
/*
 * @Author: shaky
 * @Date: 2023-11-04 16:09:22
 * @LastEditTime: 2023-11-05 18:17:29
 * @FilePath: /web-project/staff-index/create.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
$courseid = $_POST['courseid'];
$newtype = $_POST['newtype'];
$newheader = $_POST['newheader'];
$newcontent = $_POST['newcontent'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";
$db = mysqli_connect($servername, $username, $password, $dbname);
$date = isset($_POST['newdate']) ? $_POST['newdate'] : null;
if ($date) {
    $date = date('Y-m-d H:i:s', strtotime($date));
    $sql = "INSERT INTO coursework (courseid, type, header, content, date) VALUES ('$courseid', '$newtype', '$newheader', '$newcontent', '$date')"; 
    adddue($newheader, $newcontent, $date, $courseid, $servername, $username, $password, $dbname);  
} else {
    $sql = "INSERT INTO coursework (courseid, type, header, content) VALUES ('$courseid', '$newtype', '$newheader', '$newcontent')";   
}

$db->query($sql);
$insertedId = mysqli_insert_id($db); 

mysqli_close($db);

echo $insertedId;

function adddue($newheader, $newcontent, $date, $courseid, $servername, $username, $password, $dbname){
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "INSERT INTO duedate (tittle, content, date, userid) VALUES ('$courseid', '$newcontent', '$date', '$courseid')";   
    $db->query($sql);
    mysqli_close($db);
    sendmessage($courseid,$date, $servername, $username, $password, $dbname);
}
function sendmessage($courseid,$date, $servername, $username, $password, $dbname){
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $message = "SELECT studentid FROM course WHERE courseid = '$courseid'";
    $messageresult = mysqli_query($db, $message);
    $currentTime = date('Y-m-d');
    $type = 0;
    while ($row = mysqli_fetch_assoc($messageresult)) {
        $newcontent = "I have posted a new job with a deadline of " . $date;
        $studentid = $row['studentid'];
        $db = mysqli_connect($servername, $username, $password, $dbname);
        $sql = "INSERT INTO message (studentid, content, name, type, userid, date) VALUES ('$studentid', '$newcontent', '$courseid', '$type', '$courseid', '$currentTime')";
        $db->query($sql);
    }
}

?>