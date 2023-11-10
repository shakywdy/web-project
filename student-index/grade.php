<?php
require_once '../control.php';

studentchecklogin();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";
$db = mysqli_connect($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseid = $_POST["courseid"];
    $feedback = $_POST["feedback"];

    $sql = "INSERT INTO feedback (courseid, studentid, feedback) 
            VALUES ('$courseid', '$user_id', '$feedback')";
    mysqli_query($db, $sql);
}

$sql = "SELECT score, courseid FROM grade";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    $dictionary = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $courseid = $row['courseid'];
        $score = $row['score'];

        if (!isset($dictionary[$courseid])) {
            $dictionary[$courseid] = array('A' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'no grade' => 0);
        }

        if ($score > 85) {
            $dictionary[$courseid]['A'] += 1;
        }
        if ($score <= 84 && $score >= 66) {
            $dictionary[$courseid]['B'] += 1;
        }
        if ($score <= 65 && $score > 56) {
            $dictionary[$courseid]['C'] += 1;
        }
        if ($score <= 55 && $score >= 50) {
            $dictionary[$courseid]['D'] += 1;
        }
        if ($score <= 49) {
            $dictionary[$courseid]['no grade'] += 1;
        }
    }

    $jsonDictionary = json_encode($dictionary);
} 






$grade = "SELECT courseid FROM feedback WHERE studentid = $user_id";
$coursefeedback = $db->query($grade);

$courselist = array();
$feedbackbutton = '';
if (mysqli_num_rows($coursefeedback) > 0) {

    while ($row = mysqli_fetch_assoc($coursefeedback)) {
        $crid = $row['courseid'];
        
        $gradeQuery = "SELECT * FROM feedback WHERE courseid = '$crid' AND studentid = $user_id";
        $coursefeedbacks = $db->query($gradeQuery);

        $feedbackList = array();

    while ($feedbackRow = mysqli_fetch_assoc($coursefeedbacks)) {
        $size = rand(20, 40);
        $feedbackList[] = array(
            'courseid' => $crid,
            'text' => $feedbackRow['feedback'],
            'size' =>$size
        );
        
    }
    $courselist[$crid] = $feedbackList;
    }
    $jsonfeedback = json_encode($courselist[$crid]);
}
else{
   
}
    


$courseQuery = "SELECT * FROM course WHERE studentid = $user_id";
$result2 = $db->query($courseQuery);
    
while ($rows = mysqli_fetch_assoc($result2)) {
        $courseId = $rows['courseid'];
    
        $feedbackbutton .= '
            <button onclick="CallAll(\'' . $courseId . '\')">
                ' . $courseId . '
            </button>';
}


    
$courseQuery = "SELECT * FROM course WHERE studentid = $user_id";
$result2 = $db->query($courseQuery);
$div = '<div class="course-div">
<div class="course-area">
 <div class="area-none">none</div>
</div>
<div class="course-gpa"> GPA:none</div>
</div>';
$span='<span id="courseSpan"></span>';
$courseGpas = array();
if ($result2->num_rows > 0) {
$span='<span id="courseSpan"></span>
';
$firstCourseId = '';
while ($row = mysqli_fetch_assoc($result2)) {
    $crid = $row['courseid'];
    if ($firstCourseId === '') {
        $firstCourseId = $crid; 
    }
    $gradeQuery1 = "SELECT * FROM grade WHERE courseid = '$crid' AND studentid = $user_id";
    $gradescore = $db->query($gradeQuery1);
    $gradediv = '';
    $total = 0;
    $numberscore = 0;
    
    if (mysqli_num_rows($gradescore) > 0) {
        while ($rows = mysqli_fetch_assoc($gradescore)) {
            $gradediv .= '<div class="coursescore">' . $rows['courseid'] . '&nbsp;&nbsp;&nbsp;' . $rows['header'] . '&nbsp;&nbsp;Score: ' . $rows['score'] . '</div>';
    
            $total += $rows['score'];
            $numberscore++;
        }
        $courseGpa = calculateGpa($total / $numberscore);
        $courseGpas[$crid] = $courseGpa;
        $div .= '
        <div class="course-div" id="' . $row['courseid'] . '">
        <div class="course-area">
            ' . $gradediv . '
        </div>
        <div class="course-gpa"> GPA:'. $courseGpa . '</div>
        </div>
      '
        ;
    }
    else{
        $div .= '
        <div class="course-div" id="' . $row['courseid'] . '">
        <div class="course-area">
         <div class="area-none">none</div>
        </div>
        <div class="course-gpa"> GPA:none</div>
        </div>
      '
        ;
    }
}
echo '<script>';
echo 'var firstCourseId = "'. $firstCourseId .'";';
echo '</script>';
}

  



function calculateGpa($averageScore) {
    if ($averageScore >= 90) {
        return 4.0;
    } elseif ($averageScore >= 84) {
        return 3.7;
    } elseif ($averageScore >= 80) {
        return 3.3;
    } elseif ($averageScore >= 74) {
        return 3.0;
    } elseif ($averageScore >= 70) {
        return 2.7;
    } elseif ($averageScore >= 64) {
        return 2.3;
    } elseif ($averageScore >= 60) {
        return 2.0;
    } elseif ($averageScore >= 54) {
        return 1.5;
    } elseif ($averageScore >= 50) {
        return 1.0;
    } else {
        return 0;
    }
}

mysqli_close($db);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/grade.css">
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <!-- <script src="d3.v3.min.js"></script> -->
    <script src="js/d3.layout.cloud.js"></script>
    <title>Document</title>
</head>
<body>


    <div class="container">
        
        <div class="left">
            <div class="choice" id="course">
                <?php echo $feedbackbutton ?>
            </div>
            <div class="left-header">
                <div class="cloud" id="cloud">
          
                </div>

            </div>

            <div class="left-content">
                <div class="feebackbox">
                <div class="left-content-header">
                       Feedback :<?php echo $span?>
                </div>  
                <div class="left-content-data" id="left-content-data">
                <textarea type="text"  id="feedback" class="feedback"></textarea>
                <button class="submit" onclick="postfeedback()">Submit</button>
                </div>
            </div>

            <div class="scorebox">

                    <div id="output" class="outputscore">
                    <div class="left-content-header">
                    Check Score
                </div>
                        <?php echo $div; ?>
                    </div>
            </div>
        </div>

        </div>
        
        <div class="right">

            <div class="right-content">
                <div class="piechat"id="container"></div>
            </div>
        </div>
    </div>

</body>
</html>


<script> 
var phpgrade = <?php echo $jsonDictionary; ?>;
var firstCourseId = "<?php echo $firstCourseId; ?>";

document.addEventListener("DOMContentLoaded", function(event) {
    if (firstCourseId !== '') {
        CallAll(firstCourseId);
        
        console.log(firstCourseId);
    }
});

function PieChart(course) {
    var chartData = phpgrade[course];
    var gradedata = [];

    for (var grade in chartData) {
        gradedata.push({ name: grade, y: chartData[grade] });
    }

    var json = {
        chart: { plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false },
        title: { text: 'Course of ' + course + ' Grade' },
        tooltip: {},
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: { enabled: false },
                showInLegend: true,
            },
        },
        series: [{ type: 'pie', data: gradedata }],
        accessibility: { enabled: false }
    };

    $('#container').highcharts(json);
}


// $(document).ready(function() {
//     PieChart("COM3101");
//     $('#course').change(function() {
//         PieChart(this.value);
//     });
// });




function postfeedback() {
  
    var feedback = document.getElementById("feedback").value;
    var courseid = document.getElementById("courseSpan").innerHTML;
 
            
    if(courseid!=''){
    $.ajax({
        type: 'POST',
        url: 'grade.php',
        data: {
        courseid: courseid,
        feedback:feedback,

    },
        success: function(response) {
        document.getElementById("feedback").value = '';

        var feedbackData = {
            courseid:courseid,
            text: feedback,
            size:50
        };
        showfeedback(courseid);
        data.push(feedbackData);
        var layout = d3.layout.cloud()
            .size([containerWidth, containerHeight])
            .words(data)
            .rotate(0)
            .fontSize(function(d) { return d.size; })
            .on("end", draw);
            if (data) {
            layout.start();
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
        });
    }
    else{
        alert("You don't have a course");
    }
    }
   



// 数据
var data=[];

function showfeedback(courseId) {
    data = <?php echo json_encode($courselist); ?>[courseId];
    console.log(data);

    var layout = d3.layout.cloud()
    .size([containerWidth, containerHeight])
    .words(data)
    .rotate(0)
    .fontSize(function(d) { return d.size; })
    .on("end", draw);
    if (data) {
    layout.start();
}
}


var color = d3.scale.category20();  

var containerWidth = document.getElementById("cloud").offsetWidth; 
var containerHeight = document.getElementById("cloud").offsetHeight;

function draw(words) {
    d3.select("#cloud").select("svg").remove(); 

    d3.select("#cloud").append("svg")
        .attr("width", '100%')
        .attr("height", '100%')
        .attr("class", "wordcloud")
        .append("g")
        .attr("transform", "translate(300,200)")
        .selectAll("text")
        .data(words)
        .enter().append("text")
        .style("font-size", function(d) { return d.size + "px"; })
        .style("fill", function(d, i) { return color(i); })
        .style("font-family", "'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif")
        .attr("transform", function(d) {
            return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
        })
        .text(function(d) { return d.text; });
}


function CallAll(courseid) {
    var courseSpan = document.getElementById("courseSpan");
    if (courseSpan) {
        courseSpan.innerHTML = courseid;
    }
  
    showfeedback(courseid);
    PieChart(courseid);
    showCourse(courseid);

}









function hideAllCourses() {
    var allCourses = document.querySelectorAll('.course-div');
    allCourses.forEach(function(div) {
        div.style.display = 'none';
    });
    }




function showCourse(courseid) {
    hideAllCourses();
    
    var selectedDiv = document.getElementById(courseid);
    if (selectedDiv) {
        selectedDiv.style.display = 'flex';
    }
}
</script>
