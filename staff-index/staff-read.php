<?php
require_once '../control.php';
staffchecklogin();
if (isset($_SESSION['user_id'])) {
    $userid = $_SESSION['user_id'];
    $db = loadingdb();
}
$sql = "SELECT DISTINCT courseid FROM course WHERE staffid = $userid";
$result = mysqli_query($db, $sql);
$coursebutton = '';
$studentarea = '';
$firstIteration = true; 

while ($row = mysqli_fetch_assoc($result)) {
$userlist = '';
 $courseid = $row["courseid"];
 $coursebutton .= '<button onclick="showarea(\'' . $courseid . '\')">' . $courseid . '</button>';
 $stsql = "SELECT studentid FROM course WHERE courseid = '$courseid'";
 $stresult = mysqli_query($db, $stsql);
 while($strow = mysqli_fetch_assoc($stresult)) {
   $stid = $strow["studentid"];
   $userlist .= '<button onclick="showdate(\'' . $stid . '\')">' . $stid . '</button>';
 }

 if ($firstIteration) {
   
  $studentarea .= '<div class="content-area" id="' . $courseid . '">' . $userlist . '</div>';
  $firstIteration = false;
} else {

  $studentarea .= '<div class="content-area hidden" id="' . $courseid . '">' . $userlist . '</div>';
}
}

// while ($row = mysqli_fetch_assoc($result)) {
//     $courseid = $row["courseid"];
//     $studentid = $row["studentid"];
//     
//     $coursebutton .= '<button onclick="showarea(\'' . $courseid . '\')">' . $courseid . '</button>';
    
//     $stsql = "SELECT  studentid FROM course WHERE studentid = $studentid";
//     $stresult = mysqli_query($db, $stsql);

//     while ($strow = mysqli_fetch_assoc($stresult)) {
//         $stid = $strow["studentid"];
//         $userlist .= '<button onclick="showdate(\'' . $stid . '\')">' . $stid . '</button>';
//     }

  

//     if ($firstIteration) {
   
//         $studentarea .= '<div class="content-area" id="' . $courseid . '">' . $userlist . '</div>';
//         $firstIteration = false;
//     } else {

//         $studentarea .= '<div class="content-area hidden" id="' . $courseid . '">' . $userlist . '</div>';
//     }
// }

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/staff-read.css">
</head>
<body>
    <div class="container"> 
     <div class="left">
     <div class="left-container">

      <div class="left-container-top">
      <div class="button-area">
        <?php echo $coursebutton ?>
      </div>

      <div class="student-area">
       <div class="student-area-header">
        Your students
       </div>

         <div class="student-area-content">
      <?php echo $studentarea ?>
         </div>
      </div>
      </div>

      <div class="left-container-bot">

       <div class="container-bot-header">
       Student Assessment Calendar
      </div>
      <div class="bot-content">
      <div class="bot-content-area" id="bot-content-area">
       <div class="bot-area-init"> Please select a student</div>
      </div>
     </div>


     </div>
    </div>
     </div>
     <div class="right">
      <div class="right-container">
        <div class="right-area">
        <div class="right-header">
        User student
       </div>
       <div class="right-content">
        <div class="content-header">
        <div class="list-header">
          <div class="header-name">Name</div><div class="header-id">Student Id</div><div class="header-time">Last login time</div>
        </div>
        </div>
        <div class="content-list" id="targetSection">
         <div class="list" >

           <!-- xml area  -->
   
         </div>
         

        </div>
       </div>
        </div>
      </div>
      </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function showarea(courseId) {
  var element = document.getElementById(courseId);
  if (element) {
    element.classList.remove('hidden');
  }
  var areas = document.getElementsByClassName('content-area');
  for (var i = 0; i < areas.length; i++) {
    var area = areas[i];
    if (area.id !== courseId) {
      area.classList.add('hidden');
    }
  }
}
function showdate(studentid){
    $.ajax({
    url: "./score.php",
    type: "POST",
    data: {
    seestudentid:studentid
    },
    success: function(response) {
    $('.bot-content-area').html(response);
    console.log(response);
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });

}

const xmlFile = '../xml/student.xml';
fetch(xmlFile)
  .then(response => response.text())
  .then(xmlData => {
    const parser = new DOMParser();
    const xmlDoc = parser.parseFromString(xmlData, 'application/xml');
    const students = xmlDoc.getElementsByTagName('student');

    for (let i = 0; i < students.length; i++) {
      const student = students[i];
      const name = student.getElementsByTagName('name')[0].textContent;
      const id = student.getElementsByTagName('id')[0].textContent;
      const time = student.getElementsByTagName('lastlogin')[0].textContent;

      renderData(name, id, time);
    }
  })
  .catch(error => {
    console.error('Error fetching XML file:', error);
  });

function renderData(name, id, time) {
  // console.log(`Name: ${name}`);
  // console.log(`ID: ${id}`);
  // console.log(`Last Login Time: ${time}`);
// }
  const container = document.createElement('div');
  container.classList.add('list');

  const nameDiv = document.createElement('div');
  nameDiv.classList.add('list-name');
  nameDiv.textContent = name;

  const idDiv = document.createElement('div');
  idDiv.classList.add('list-id');
  idDiv.textContent = id;

  const timeDiv = document.createElement('div');
  timeDiv.classList.add('list-time');
  timeDiv.textContent = time;

  container.appendChild(nameDiv);
  container.appendChild(idDiv);
  container.appendChild(timeDiv);

  const targetSection = document.getElementById('targetSection');
  targetSection.appendChild(container);

}
    </script>