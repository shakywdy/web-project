var buttons = document.querySelectorAll(".course-button");
var currentpage="courseA"
var nowpage =document.getElementById(currentpage);
var pages = document.getElementsByClassName("left-course");
var selectedFiles = [];

function showNav() {
  var nowpage =document.getElementById(currentpage);
  var navArea = nowpage.querySelector("#navarea");
  if (nowpage.scrollTop > 0) {
    navArea.style.display = 'flex';

  } else {
    navArea.style.display = 'none';

  }
}

function submitwork(userid, courseid, header,keyid,studentname) {
  var nowpage =document.getElementById(currentpage);
  var escapedHeader = header.replace(/\s/g, '\\$&');
  var headerfile = nowpage.querySelector('#' + escapedHeader);
  var studentfile = headerfile.querySelector("#file");
  var filearea = headerfile.querySelector("#work-area-file");
  var requestsCompleted = 0;
  selectedFiles.forEach(function(file) {
    var formData = new FormData();
    formData.append('file', file);

    $.ajax({
      url: '../data/upload.php',
      type: 'POST',
      data: {
        userid: userid,
        courseid: courseid,
        header: header,
        filename: file.name,
        keyid:keyid,
        studentname:studentname
      },
      success: function(response) {

        requestsCompleted++;
        if (requestsCompleted === selectedFiles.length) {
            var formData=new FormData();
        for (var i=0;i < selectedFiles.length;i++) {
            var file=selectedFiles[i];
            formData.append('files[]', file, file.name);
        }
        
        var xhr=new XMLHttpRequest();
        xhr.open('POST', '../data/upload.php', true);
        formData.append('userid', userid);
        formData.append('courseid', courseid);
        formData.append('header',header)
        xhr.onload=function() {
            if (xhr.status===200) {
      
                  studentfile.value="";  
                  selectedFiles=[]
                  $(nowpage).load(location.href + ' #' + nowpage.id + ' > *', function() {
                    var remoteContent = $(nowpage).html();
                    $(nowpage).html(remoteContent);
                  });
                      //animation
                  gsap.to(filearea, {
                    opacity: 0,
                    duration: 0.3,
                    onComplete: function() {
                      filearea.innerHTML = '';
                      gsap.to(filearea, {
                        opacity: 1,
                        duration: 0.3
                      });
                    }
                  }); 
                      
            }
            else {
                console.log("error");
            }
        };
        xhr.send(formData);
        }
      },
      error: function(xhr, status, error) {
        console.log(error);
        requestsCompleted++;
        if (requestsCompleted === selectedFiles.length) {
    
        }
      }
    });
  });
}



function addwork(header) {
  var nowpage =document.getElementById(currentpage);
  var escapedHeader = header.replace(/\s/g, '\\$&');
  var headerfile = nowpage.querySelector('#' + escapedHeader);
  var studentfile = headerfile.querySelector("#file");
  var filearea = headerfile.querySelector("#work-area-file");

  var addfiles = Array.from(studentfile.files); 
  selectedFiles = selectedFiles.concat(addfiles); 
  for (var i = 0; i < addfiles.length; i++) {
    var file = addfiles[i];
    var reader = new FileReader();
    var newDiv = document.createElement('div');
    newDiv.classList.add('work-area-file-st');
    newDiv.innerHTML = '<svg class="work-area-file-st-svg"xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">' +
    '<path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>' +
    '<path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>' +
    '</svg>' +
    '<div class="st-file">' + file.name + '</div>' +
    '<button class="delete-file-button" onclick="deleteFile(this, \'' + file.name + '\')">' +
    '<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">' +
    '<path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>' +
    '<path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>' +
    '</svg>' +
    '</button>';
    newDiv.style.opacity = 0;
    //animation
   filearea.appendChild(newDiv);
   gsap.to(newDiv, {
   opacity: 1,
   duration: 0.3,
   });
  }
  console.log("select:",selectedFiles);
  console.log("student",studentfile.files);
}

function deleteFile(button, name) {
  var fileElement = button.parentNode;

  gsap.to(fileElement, {
    opacity: 0,
    height: 0,
    duration: 0.3,
    onComplete: function() {
      fileElement.remove();
      selectedFiles = selectedFiles.filter(function(file) {
        return file.name !== name;
      });
    }
  });
}


for (var i = 0; i < pages.length; i++) {
  pages[i].style.display = "none";
}
document.getElementById("courseA").style.display = "flex";


for (var i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener("click", function() {
    var target = this.dataset.target;
    var currentPage = document.getElementById(currentpage);
    var nextPage = document.getElementById(target);
    gsap.to(currentPage, {
      opacity: 0,
      duration: 0.2,
      onComplete: function() {
        currentPage.style.display = "none";
        gsap.fromTo(
          nextPage,
          { opacity: 0, display: "flex" },
          { opacity: 1, duration: 0.2 }
        );
        currentpage = target;
      }
    });
  });
}

buttons.forEach(function(button) {
  button.addEventListener("click", function() {
    buttons.forEach(function(btn) {
      btn.classList.remove("active");
    });
    this.classList.add("active");
  });
});
///change course







