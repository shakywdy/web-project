<?php 
/*
 * @Author: shaky
 * @Date: 2023-10-24 00:08:47
 * @LastEditTime: 2023-11-04 02:28:48
 * @FilePath: /web-project/student-index/student-course.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
require_once '../control.php';
studentchecklogin();
if (isset($_SESSION['user_id'])) {
    $userid = $_SESSION['user_id'];
    echo '<script>
        var userid = ' . $userid . ';
    </script>';
    $db = loadingdb();
    $sql = "SELECT courseid FROM course WHERE studentid = $userid";
    $result = mysqli_query($db, $sql);
    $query = "SELECT name FROM students WHERE id = '$userid'";
    $result2 = mysqli_query($db, $query);
    if (mysqli_num_rows($result2) > 0) {
      $row = mysqli_fetch_assoc($result2);
      $studentname = $row['name'];
    }
    $coursebutton = '';
    $counter = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $counter++;
        $courseid=$row['courseid'];
        $buttonId = 'change' . chr(64 + $counter); 
        $dateid='course' . chr(64 + $counter); 
        $isActive = ($counter === 1) ? ' active' : ''; 
        $coursebutton .= '<button class="course-button' . $isActive . '" id="' . $buttonId . '" data-target="'.$dateid.'">'.$courseid .'</button>';
        $courseworkSql = "SELECT * FROM coursework WHERE courseid = '$courseid'";
        $courseworkResult = mysqli_query($db, $courseworkSql);  
        // this html print   
        $work='';
        $link='';
        $navbutton='';
        while ($crRow = mysqli_fetch_assoc($courseworkResult)) {
        // courseid and worktitle
        $crcourseid=$crRow['courseid'];
        $crheader =$crRow['header'];
        $crid =$crRow['id'];
        $navbutton .= '<button class="nav-button" onclick="goto(\'' . $crheader . '\')">' . $crheader . '</button>';
        if($crRow['type']==0){
        //this is get file
        $filelink ="SELECT* FROM worklink WHERE courseid ='$crcourseid'AND header='$crid'";
        $filelinkresult = mysqli_query($db, $filelink);
        while ($flrow = mysqli_fetch_assoc($filelinkresult)) {
        $link .='           
        <div title="'.$flrow['id'].'" class="left-course-class-content-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
         <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
         <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
        </svg> 
        <a  class="left-course-a" href="'.$flrow['link'] .'" download="'.$flrow['filename'].'">'.$flrow['filename'] .'</a>
        </div>
        ';
        }
        // get file html end 
        $work .= '
        <div class="left-course-class" id="'.$crheader .'">      
        <div class="left-course-class-header">
        '.$crRow['header'] .'
        </div>
        <div class="left-course-class-content">
        <span> '.$crRow['content'] .'</span>'
        .$link.
        '</div>    
        </div>';
        }
        else{
            $workSql = "SELECT * FROM submit WHERE courseid = '$courseid' AND keyid ='$crid' AND studentid='$userid' ";
            $workResult = mysqli_query($db, $workSql);
            $worklink='';
            $link='';
            $filelink ="SELECT* FROM worklink WHERE courseid ='$crcourseid'AND header='$crid'";
            $filelinkresult = mysqli_query($db, $filelink);
            while ($flrow = mysqli_fetch_assoc($filelinkresult)) {
            $link .='
            <div class="left-course-class-content-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
             <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
             <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
            </svg> 
            <a  class="left-course-a"href="'.$flrow['link'] .'">'.$flrow['filename'] .'</a>
            </div>
            ';
            }
            //this student sumbited area
            while ($wkRow = mysqli_fetch_assoc($workResult)) {
            $worklink .='  <div class="file-com-content"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
            <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
            <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
           </svg><a href="'.$wkRow['link'].'"download="'.$wkRow['filename'].'">'.$wkRow['filename'].'</a>
            <div class="com-content-text">'.$wkRow['date'].'</div></div>';
            }
           $grade='<div class="submited-grade"><div class="grade-tittle">Score:</div><div class="grade-score">no grade</div></div>';
           $stgrade = "SELECT score FROM grade WHERE studentid = '$userid' AND courseid = '$crcourseid' AND header = '$crid';";
           $stgraderesult = mysqli_query($db, $stgrade);
           $addfile='';
           if (mysqli_num_rows($stgraderesult) > 0) {
           while ($grow = mysqli_fetch_assoc($stgraderesult)){
            $grade='<div class="submited-grade"><div class="grade-tittle">Score:</div><div class="grade-score">'.$grow['score'].'</div></div>';
           }
           }
           else{
          $addfile= ' 
          <!-- submit-area -->
            <div class="submit-area">
           <!-- <input type="file"> -->
            <div class="submit-area-header">
             Sumbit you work
            </div>
              <div class="file-area">
              <button class="file-sumbit" >   
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
              </svg> 
               <input type="file" id="file" oninput="addwork(\''.$crRow['header'].'\',\''.$crRow['courseid'].'\')" multiple>
              </button>
               <!-- this is check area  -->
               <div class="work-area">
                 <div class="work-area-file" id="work-area-file">
                <!-- this is your add file-->
                 </div>
                 <button class="file-button" onclick="submitwork(' . $userid . ', \'' . $crRow['courseid'] . '\', \'' . $crRow['header'] . '\',\''.$crRow['id'].'\', \'' . $studentname . '\')"> <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                 <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                 <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
               </svg></button>
               </div>
   
              </div>
            </div> 
          
          ';
           }
            $work .= ' <div class="left-course-class" id="'.$crheader .'">       
            <div class="left-course-class-header">
            '.$crRow['header'] .'
            </div>
            <div class="left-course-class-content">
            <span> '.$crRow['content'] .'</span>'
            .$link.
           ' <div class="content-date"><h4>Due: </h4>'.$crRow['date'] .'</div>
            <div class="submited" id="sumbited">
            '.$grade.'
            <div class="submited-file">
            <div class="file-tittle">Submitted</div>
            <div class="file-com" >'
             .$worklink.
            '</div>
            </div>
            </div>'
           .$addfile.' 
           </div>
           </div> '; 
        }

    }
    $coursecontent .= '<div class="left-course" onscroll="showNav()" id="'.$dateid.'"><div class="nav-area" id="navarea">'. $navbutton .'</div>'.$work.'</div>';
    }


    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/student-course.css">
</head>
<body>

    <div class="container">
    <!-- left area  -->
     <div class="left">
      <div class="left-header">
       <div class="left-header-button">
      <!-- this course button    -->
       <?php echo $coursebutton ?>
       </div> 
    </div>

      <div class="left-content">
        <!-- this course content  -->
      <?php echo $coursecontent ?>  
       <!-- Submitted work will be placed in this area  -->
        
        <!-- home work area end  -->
      </div>
     </div>
    <!-- left area end  -->

    <!-- right area  -->
     <div class="right">
      <div class="right-top">
    
      <div class="calendar" id="myCalendar">  
    
      <div class="header">
        <button class="lastYear" id="Last year"><</button>
        <div class="currentDate"></div>
        <button class="nextYear" id="Next year">></button>
      </div>
      <div class="header-b"><button class="lastMonth" id="Last month"><</button>
      <div class="currentyue"></div>
      <button class="nextMonth" id="Next month">></button></div>
      <div class="days">
        <div class="day">Mon</div>
        <div class="day">Tue</div>
        <div class="day">Wed</div>
        <div class="day">Thu</div>
        <div class="day">Fri</div>
        <div class="day">Sat</div>
        <div class="day">Sun</div>
      </div>
            <div class="dates">
            </div>
      </div>
      </div>

      <!-- this due date area  -->
      <div class="right-bot">
      <div class="right-bot-header">Due soon</div>
      <div class="right-bot-content" id="right-bot-content">
      <?php 
       $db = loadingdb();
       $dueDates = []; //duedate list
       $eventdate=[];//js use this list get date
       $today = date('Y-m-d'); 
       $deleteQuery = "DELETE FROM duedate WHERE date < '$today'"; 
       mysqli_query($db, $deleteQuery); // delate
       $deleteQuery2="DELETE FROM studentdue WHERE date<'$today'";
       mysqli_query($db, $deleteQuery2);
       //search student due date
       $studentdue ="SELECT * FROM studentdue WHERE userid = '$userid'";
       $stresule = mysqli_query($db, $studentdue);
       while ($row = mysqli_fetch_assoc($stresule)) {
        $dueDates[] = $row;

       }
      //  search course due date 
       $sqlcourse = "SELECT courseid FROM course WHERE studentid = $userid";
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
     // print html
     $duehtml='';
     foreach ($dueDates as $row) {
      $eventdate[] = $row['date'];
      
      if ($row['userid'] != $userid) {
          $duehtml .= '<div class="right-bot-box">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="8"/>
               </svg>
               <div class="right-bot-content-div">
                <div class="right-bot-content-div-date">' . $row['date'] . '</div>
                <span>' . $row['tittle'] . '</span>
                <div class="content-div-before">' . $row['content'] . '</div>
               </div>
               </div>';
      } else {
          $duehtml .= '<div class="right-bot-box">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
           <circle cx="8" cy="8" r="8"/>
          </svg>
          <div class="right-bot-content-div-me">
           <div class="right-bot-content-div-date-me">' . $row['date'] . '</div>
           <span>' . $row['tittle'] . '</span>
     
           <div class="content-div-before-me"><span>'. $row['content'] . '</span>
           <button onclick="delnot('.$userid.','.$row['id'].',\'' . $row['date'] . '\')">X</button></div>
          </div>
          </div>';
      }
  }
        mysqli_close($db);
        ?>
        <!-- due date value  -->
       <?php echo $duehtml?>
       </div>
      </div>
       <!-- date area  end-->
     </div>
     <!-- right area end -->
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="js/student-course.js"></script>


<script>


var duedates=[];
duedates= <?php echo json_encode($eventdate); ?>;

class Calendar {
  constructor({
    element,
    defaultDate
  }) {
    if (defaultDate instanceof Date) {
      this.defaultDate = defaultDate
    } else {
      this.defaultDate = new Date();
    }
    if (element instanceof HTMLElement) {
      this.element = element;
    }
    this.#init();
  }

  // private properties
  #year;
  // start from 1
  #month;
  #date;
  #dateString;

  #init = () => {
    const defaultYear = this.defaultDate.getFullYear();
    const defaultMonth = this.defaultDate.getMonth() + 1;
    const defaultDate = this.defaultDate.getDate();
    this.#setDate(defaultYear, defaultMonth, defaultDate);
    this.#listenEvents();
  }

  #listenEvents = () => {
    // DOMS
    const lastYearButton = this.element.querySelector('.lastYear');
    const lastMonthButton = this.element.querySelector('.lastMonth');
    const nextYearButton = this.element.querySelector('.nextYear');
    const nextMonthButton = this.element.querySelector('.nextMonth');
    // last year
    lastYearButton.addEventListener('click', () => {
      this.#year--;
      this.#setDate(this.#year, this.#month);
    });
    // next year
    nextYearButton.addEventListener('click', () => {
      this.#year++;
      this.#setDate(this.#year, this.#month);
    });
    // last month
    lastMonthButton.addEventListener('click', () => {
  if (this.#month === 1) {
    this.#month = 12;
    this.#year--;
  } else {
    this.#month--;
  }
  this.#setDate(this.#year, this.#month);
});

    // next month
   nextMonthButton.addEventListener('click', () => {
  if (this.#month === 12) {
    this.#month = 1;
    this.#year++;
  } else {
    this.#month++;
  }
  this.#setDate(this.#year, this.#month);
});

    // click dates
    this.element.addEventListener('click', (e) => {
      if (e.target.classList.contains('date')) {

        const params = e.target.title.split('-').map(str => parseInt(str, 10));
        this.#setDate(...params, false);
      }
    });
  }

  #setDate = (year, month, date, reRenderDate = true) => {
    this.#year = year;
    this.#month = month;
    this.#date = date;
    // the only place to do renders
    this.#renderCurrentDate();
    this.#renderCurrentMonth();
    this.#renderDates(reRenderDate);
    
}

#renderCurrentDate = () => {
  const currentDateEL = this.element.querySelector('.currentDate');
  this.#dateString = this.#year.toString(); 
  currentDateEL.textContent = this.#dateString;
}
#renderCurrentMonth = () => {
  const currentMonthEL = this.element.querySelector('.currentyue');
  const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  const currentMonthString = monthNames[this.#month - 1]; 
  currentMonthEL.textContent = currentMonthString;
}

  #getLastMonthInfo = () => {
    let lastMonth = this.#month - 1;
    let yearOfLastMonth = this.#year;
    if (lastMonth === 0) {
      lastMonth = 12;
      yearOfLastMonth -= 1;
    }
    let dayCountInLastMonth = this.#getDayCount(yearOfLastMonth, lastMonth);

    return {
      lastMonth,
      yearOfLastMonth,
      dayCountInLastMonth
    }
  }

  #getNextMonthInfo = () => {
    let nextMonth = this.#month + 1;
    let yearOfNextMonth = this.#year;
    if (nextMonth === 13) {
      nextMonth = 1;
      yearOfNextMonth += 1;
    }
    let dayCountInNextMonth = this.#getDayCount(yearOfNextMonth, nextMonth);

    return {
      nextMonth,
      yearOfNextMonth,
      dayCountInNextMonth
    }
  }


  #getDateString = (year, month, date) => {
    if (date) {
      return `${year}-${month}-${date}`;
    } else {
      return `${year}-${month}`;
    }
  }


  #renderDates = (reRender) => {
    // DOM
    const datesEL = this.element.querySelector('.dates');
    if (!reRender) {
        const dateELs = datesEL.querySelectorAll('.date');
        for (const el of dateELs) {
            el.classList.toggle('selected', el.title === this.#dateString);
        }
        return;
    }

    datesEL.innerHTML = '';
    const dayCountInCurrentMonth = this.#getDayCount(this.#year, this.#month);
    const firstDay = this.#getDayOfFirstDate();
    const { lastMonth, yearOfLastMonth, dayCountInLastMonth } = this.#getLastMonthInfo();
    const { nextMonth, yearOfNextMonth } = this.#getNextMonthInfo();

    const today = new Date();
    const todayDate = today.getDate();
    const todayMonth = today.getMonth() + 1;
    const todayYear = today.getFullYear();

    for (let i = 1; i <= 42; i++) {
        const dateEL = document.createElement('button');
        dateEL.onclick = function() {
        opendate(this.title,userid);
        };
        document.body.appendChild(dateEL);
        dateEL.classList.add('date');
        let dateString;
        let date;

        if (firstDay > 1 && i < firstDay) {
            // dates in last month
            date = dayCountInLastMonth - (firstDay - i) + 1;
            dateString = this.#getDateString(yearOfLastMonth, lastMonth, date);
        } else if (i >= dayCountInCurrentMonth + firstDay) {
            // dates in next month
            date = i - (dayCountInCurrentMonth + firstDay) + 1;
            if (date <= 9) {
                date = "0" + date;
            }
            dateString = this.#getDateString(yearOfNextMonth, nextMonth, date);
          
        } else {
            // dates in currrent month
            date = i - firstDay + 1;
            if (date <= 9) {
                date = "0" + date;
            }
            dateString = this.#getDateString(this.#year, this.#month, date);
            dateEL.classList.add('currentMonth');
            if (date === this.#date) {
                dateEL.classList.add('selected');
            }
        }
  
        dateEL.textContent = date;
        dateEL.title = dateString;
          if (duedates.includes(dateEL.title)) {
          dateEL.classList.add('event');

     }
     
      datesEL.append(dateEL);
      if (date === todayDate && this.#month === todayMonth && this.#year === todayYear) {
        dateEL.classList.add('today');
      }

    }
}

#getDayCount = (year, month) => {
    return new Date(year, month, 0).getDate();
}

#getDayOfFirstDate = () => {
    let day = new Date(this.#year, this.#month - 1, 1).getDay();
    return day === 0 ? 7 : day;
}
}

// DOM
const calendar = document.querySelector('.calendar');

new Calendar({
  element: calendar,
});
function opendate(date, userid) {
  var newDiv = document.createElement('div');
  newDiv.classList.add('add-event');
  newDiv.innerHTML = '<div class="event-top">New reminder</div>' +date+
    '<div class="event-bot"><span>Title</span><input type="text"></div>' +
    '<div class="event-cot"><span>Content</span><textarea type="text"></textarea></div>' +
    '<div class="event-sub"><button class="event-no"</button>X<button class="event-ok">√ </button></div>';
  var cancelButton = newDiv.querySelector('.event-no');
  cancelButton.addEventListener('click', function() {
    newDiv.remove();
  });

  var submitButton = newDiv.querySelector('.event-ok');
  submitButton.addEventListener('click', function() {
    var titleInput = newDiv.querySelector('.event-bot input');
    var contentTextarea = newDiv.querySelector('.event-cot textarea');
    var title = titleInput.value;
    var content = contentTextarea.value;
    $.ajax({
    url: "open.php", 
    type: "POST",
    data: {
      title:title,
      content:content,
      date:date,
      userid:userid
    },
    success: function(response) {
      $('#right-bot-content').load(location.href + ' #right-bot-content > *', function() {
          var remoteContent = $('#right-bot-content').html();
          $('#right-bot-content').html(remoteContent);
        });
    const buttons = document.getElementsByTagName('button');
    const buttonsWithDate = Array.from(buttons).filter(button => button.getAttribute('title') === date);
    buttonsWithDate.forEach(button => {
    button.classList.add('event');
    });


},
    error: function(xhr, status, error) {

    }
  });
    titleInput.value = '';
    contentTextarea.value = '';
    newDiv.remove();
  });

  calendar.appendChild(newDiv);
}

function delnot(userid,id,time){
  console.log(userid,id,time)
  $.ajax({
    url: "open.php", 
    type: "POST",
    data: {
      userid:userid,
      id:id
    },
    success: function(response) {
      $('#right-bot-content').load(location.href + ' #right-bot-content > *', function() {
          var remoteContent = $('#right-bot-content').html();
          $('#right-bot-content').html(remoteContent);
        });
    const buttons = document.getElementsByTagName('button');
    const buttonsWithDate = Array.from(buttons).filter(button => button.getAttribute('title') === time);
    buttonsWithDate.forEach(button => {
    button.classList.remove('event');
    });



},
    error: function(xhr, status, error) {

    }
  });
}
function goto(sectionId) {
  var nowpage = document.getElementById(currentpage);
  var section = nowpage.querySelector("#" + sectionId.replace(/\s/g, "\\ "));

  if (section) {
    section.scrollIntoView({ behavior: 'smooth' });

  }
}
</script>