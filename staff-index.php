<!--
/*
 * @Author: shaky
 * @Date: 2023-09-26 23:45:57
 * @LastEditTime: 2023-11-09 21:25:39
 * @FilePath: /web-project/staff-index.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
 
-->

<!-- // require_once 'control.php';
// studentchecklogin() -->
<?php
require_once 'control.php';
staffchecklogin();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  $db = loadingdb();
  // get name
  $query = "SELECT name FROM staff WHERE id = '$user_id'";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $studentName = $row['name'];
    // content
    $queryContent = "SELECT id,content,type,name,userid,date,readme FROM message WHERE studentid = '$user_id'";
    $resultContent = mysqli_query($db, $queryContent);
    
  }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
    <link rel="stylesheet" type="text/css" href="css/student-index.css">
	</head>
	<body>

    <!-- header -->
    <div class="top">
      <!-- green -->
       <div class="top-left"></div>
        <!-- green end-->

        <!-- yellow -->
       <div class="top-right">
       <button class="message-button" id="mebutton" onclick="setRead('<?php echo $user_id; ?>')">
      
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
        </svg>
        <?php
              if (mysqli_num_rows($resultContent) > 0) {
                $noread = "SELECT COUNT(*) AS count FROM message WHERE studentid = '$user_id' AND readme = 0";
                $total = mysqli_query($db, $noread);
                $row = mysqli_fetch_assoc($total);
                $rowCount = $row['count'];
                if($rowCount > 0){
                echo '<div>' . $rowCount . '</div>';
                }
              }
              ?>
        </button>
      <!-- yellow end-->

        <!-- message-box -->
        <div class="message-box" >
          <div class="message-box-header">
           <span>Notification</span>
           <button class="close-button">X</button>
          </div>
          <div class="message-box-content"id="message-box-content">
            
              <!-- li list -->
              <?php
              if (mysqli_num_rows($resultContent) > 0) {
                while ($row = mysqli_fetch_assoc($resultContent)) {    
                  $fdid= $row['userid'] ;
                  $messageid=$row['id'];
                  $fdname=$row['name'];
                  $mscontent=$row['content'];
                  $date =$row['date'];
                  
                  echo '<ul id="message-list">
                    <div class="me-time">' .  $date . '</div>
                      <li data-id="' . $messageid . '">
                          <div class ="me-content">
                            <div class="me-from"> Be from:<span>' . $fdname . ' </span>  </div>
                             <div class="me-text"> ' .  $mscontent . '</div>
                             <div class="button-container">';
              //userid ==fd id
                  if ($row['type'] == 1) {
                    echo ' <button class="okbutton"  onClick="addfd(' . $user_id . ', \'' . $fdid . '\');delthis(' . $messageid. ')" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                    </svg></button>';
                      echo '<button class="nobutton" onClick="deltemp(' . $user_id . ', \'' . $fdid . '\');delthis(' . $messageid. ')">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                      <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg></button></div>
                    </li>
                </ul>';
                  }
                else{
                  echo '<button onClick="delthis(' . $messageid. ')" class="delete-button">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                              </svg></button> </div></div>
                      </li>
                  </ul>';
                }
              }
            }
              else 
              {
                echo '<p>You didn\'t get the notification</p>';
              }
              ?>
          
          </div>
        </div>
        
        <!-- message-box end-->

        <!-- info setting -->
        <div class="btn-group">
          <?php echo '<span>'.$studentName .' </span>'; ?>
          <?php echo '<span>'.$user_id .' </span>'; ?>
        </div>
         <!-- info setting end-->
       </div>
      <!-- yellow end-->

    </div>
    <!-- header end -->
   
    <!-- this is a left list -->
    <div class="left-box">
    <div class="left">
      <div class="leftheader">    
      <img src="hsuhk.png" width="50" height="50">
     </div>
     <div class="left-content">
     <button class="left-content-list active" onclick="changeFrame('staff-index/staff-course.php')">Home</button>
     <button class="left-content-list" onclick="changeFrame('staff-index/staff-read.php')">Students</button>
     </div>
    </div> 
    </div>
    
	 <div class="right">
      <div class="right-main" id="frame" >
      <iframe id="iframe"src="staff-index/staff-course.php"></iframe>
      </div>

     </div> 
        <!-- this is a left list end -->
	</body>
  <script src="js/student-index.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
  <script>
    function changeFrame(src) {
      var iframe = document.getElementById('iframe');
      gsap.to(iframe, {
        opacity: 0,
        duration: 0.2,
        onComplete: function() {
          iframe.src = src;
          gsap.to(iframe, { opacity: 1, duration: 0.2 });
        }
      });
    }
    var acitvebuttons = document.querySelectorAll('.left-content-list');
acitvebuttons.forEach(function(button) {
  button.addEventListener('click', function() {
    acitvebuttons.forEach(function(btn) {
      btn.classList.remove('active');
    });
    this.classList.add('active');
  });
});
</script>
</html>

