<?php
/*
 * @Author: shaky
 * @Date: 2023-10-26 17:20:57
 * @LastEditTime: 2023-11-02 21:26:29
 * @FilePath: /web-project/data/upload.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userid = $_POST['userid']; 
  $courseid = $_POST['courseid']; 
  $header = $_POST['header']; 
  if ($_FILES['files']['error'][0] === UPLOAD_ERR_OK) {
    $uploadDir = '../work/'.$userid.'/'.$courseid.'/'.$header.'/';
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
if(isset($_POST['userid'])&& isset($_POST['courseid'])&& isset($_POST['header'])&& isset($_POST['filename'])&& isset($_POST['keyid'])&& isset($_POST['studentname'])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $studentid=$_POST['userid'];
    $courseid=$_POST['courseid'];
    $header=$_POST['header'];
    $filename=$_POST['filename'];
    $currentdate = date('Y-m-d H:i:s');
    $link = '../work/' . $userid . '/' . $courseid . '/' . $header . '/' . $filename;
    $keyid=$_POST['keyid'];
    $studentname=$_POST['studentname'];
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "INSERT INTO submit (studentid, courseid,header,filename,date,link,keyid,studentname) VALUES ('$studentid', '$courseid','$header','$filename','$currentdate','$link','$keyid','$studentname')";   
    $db->query($sql);
    
    mysqli_close($db);
}
?>