<?php
/*
 * @Author: shaky
 * @Date: 2023-11-03 16:03:08
 * @LastEditTime: 2023-11-06 16:16:00
 * @FilePath: /web-project/staff-index/score.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
if (isset($_POST['stid']) && isset($_POST['csid'])&& isset($_POST['crid'])&& isset($_POST['score'])) {
    $stid=$_POST['stid'];
    $csid=$_POST['csid'];
    $crid=$_POST['crid'];
    $score=$_POST['score'];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "INSERT INTO grade (courseid,studentid,header,score) VALUES ('$csid','$stid','$crid','$score')";
    mysqli_query($db, $sql);
    mysqli_close($db);
}
if (isset($_POST['gradeid'])&& isset($_POST['cgrade'])) {
    $id=$_POST['gradeid'];
    $score=$_POST['cgrade'];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sql="UPDATE grade SET score='$score' WHERE id ='$id'";
    mysqli_query($db, $sql);
    mysqli_close($db);
}
if (isset($_POST["seestudentid"])) {
    $id=$_POST["seestudentid"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $dueDates = []; 
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $studentdue ="SELECT * FROM studentdue WHERE userid = '$id'";
    $stresule = mysqli_query($db, $studentdue);
    while ($row = mysqli_fetch_assoc($stresule)) {
     $dueDates[] = $row;
    }
    $sqlcourse = "SELECT courseid FROM course WHERE studentid = $id";
    $result = mysqli_query($db, $sqlcourse);
    while ($row = mysqli_fetch_assoc($result)) {
      $courseiddate = $row['courseid'];
      $due = "SELECT * FROM duedate WHERE tittle = '$courseiddate'";
      $dueresult = mysqli_query($db, $due);
  
      while ($duedateRow = mysqli_fetch_assoc($dueresult)) {
          $dueDates[] = $duedateRow;  
       }
    }
    //  sort duedate 
    usort($dueDates, function ($a, $b) {
    return strtotime($a['date']) - strtotime($b['date']);
    });
    $duehtml='';
    foreach ($dueDates as $row) {
    $duehtml .='
    <div class="bot-content-card">
    <div class="card-date"><span>Date:</span>'.$row['date'].'</div>
    <div class="card-header"><span>Title:</span>'.$row['tittle'].'</div>
    <div class="card-content"><span>'.$row['content'].'</span></div>
   </div>       
    </div> 
    ';
    }
    echo $duehtml;
    mysqli_close($db);

}
?>