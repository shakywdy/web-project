<?php
/*
 * @Author: shaky
 * @Date: 2023-10-29 23:45:19
 * @LastEditTime: 2023-11-02 17:46:40
 * @FilePath: /web-project/staff-index/open.php
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
if (isset($_POST["dateid"])){
   $id = $_POST["dateid"];
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "mydatabase";
   $db = mysqli_connect($servername, $username, $password, $dbname);
   $delfile = "SELECT link FROM worklink WHERE id = $id";
   $result = mysqli_query($db,$delfile);
   $row = mysqli_fetch_assoc($result);
   $link = $row["link"];
   unlink($link);

   $sql = "DELETE FROM worklink WHERE id = $id";
   mysqli_query($db, $sql);
   mysqli_close($db);
}
if(isset($_POST['filename'])&& isset($_POST['courseid'])&& isset($_POST['area'])&& isset($_POST['id'])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $filename =$_POST['filename'];
    $courseid= $_POST['courseid'];
    $area = $_POST['area'];
    $id = $_POST['id'];
    $link = '../work/' . $courseid . '/' . $area . '/' . $filename;
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "INSERT INTO worklink (link, filename, courseid,header) VALUES ('$link','$filename','$courseid','$id')";   
    $db->query($sql);
    mysqli_close($db);
}

if(isset($_POST['dbcid'])&& isset($_POST['courseheader'])&& isset($_POST['coursecontent'])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $dbcid =$_POST['dbcid'];
    $courseheader= $_POST['courseheader'];
    $coursecontent = $_POST['coursecontent'];
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "UPDATE coursework SET header='$courseheader', content='$coursecontent' WHERE id='$dbcid'";
    $db->query($sql);
    mysqli_close($db);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseid = $_POST['courseid']; 
    $header = $_POST['header']; 
    if ($_FILES['files']['error'][0] === UPLOAD_ERR_OK) {
      $uploadDir = '../work/'.$courseid.'/'.$header.'/';
      if (!file_exists($uploadDir)) {
          mkdir($uploadDir, 0777, true);
        }
      for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
        $fileName = $_FILES['files']['name'][$i];
        $fileTmpName = $_FILES['files']['tmp_name'][$i];
        $fileDestination = $uploadDir . $fileName;
        if (move_uploaded_file($fileTmpName, $fileDestination)) {
  
          echo "ok" . $fileName . "<br>";
        } else {
          echo "error" . $fileName . "<br>";
        }
      }
    }
  }
?>