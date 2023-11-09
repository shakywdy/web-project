var buttons = document.querySelectorAll(".course-button");
var currentpage="courseA"
var nowpage =document.getElementById(currentpage);
var pages = document.getElementsByClassName("left-course");
var selectedFiles = [];

function showNav() {
  var nowpage = document.getElementById(currentpage);
  var navArea = nowpage.querySelector("#navarea");
  var buttons = navArea.querySelectorAll("#nav-button");

  if (nowpage.scrollTop > 0) {
    buttons.forEach(function(button) {
      TweenMax.to(button, 0.5, { opacity: 1, });
    });
  } else {
    buttons.forEach(function(button) {
      TweenMax.to(button, 0.5, { opacity: 0, });
    });
  }
}

function showstudent(area){
  var nowpage =document.getElementById(currentpage);
  var escapedHeader = area.replace(/\s/g, '\\$&');
  var headerfile = nowpage.querySelector('#' + escapedHeader);
  var studentwork = headerfile.querySelector(".sc-area");
  var workbutton =headerfile.querySelector(".score-button");
  showElement(studentwork);
  workbutton.style.display="none";
}
function resetscore(area){
  var nowpage =document.getElementById(currentpage);
  var escapedHeader = area.replace(/\s/g, '\\$&');
  var headerfile = nowpage.querySelector('#' + escapedHeader);
  var studentwork = headerfile.querySelector(".sc-area");
  var workbutton =headerfile.querySelector(".score-button");
  showElement(workbutton);
  studentwork.style.display="none";
}
function changescore(stid,gradeid){
  gradarea=document.getElementById(stid);
  var input = gradarea.querySelector('input');
  $.ajax({
    url: "./score.php",
    type: "POST",
    data: {
      gradeid: gradeid,
      cgrade: input.value
    },
    success: function (response) {
      $(gradarea).load(location.href + ' #' + gradarea.id + ' > *', function () {
        var remoteContent = $(gradarea).html();
        $(gradarea).html(remoteContent);
        var success = gradarea.querySelector('.changeready');
        showsuccess(success);
      });
    },
  });
}
function hidesuccess(element) {
  TweenMax.to(element, 0.3, { opacity: 0, display: 'none' });
} 

function showsuccess(element) {
  TweenMax.fromTo(element, 0.3, { opacity: 0, display: 'none' }, { opacity: 1, display: 'flex' });
  setTimeout(function () {
    hidesuccess(element);
  }, 1500);
}

function sumbitscore(stid,csid,crid,gradeid){
  gradarea=document.getElementById(gradeid);
  var input = gradarea.querySelector('input');

  $.ajax({
    url: "./score.php",
    type: "POST",
    data: {
     stid:stid,
     csid:csid,
     crid:crid,
     score:input.value
    },
    success: function(response) {
      $(gradarea).load(location.href + ' #' + gradarea.id + ' > *', function () {
        var remoteContent = $(gradarea).html();
        $(gradarea).html(remoteContent);
        var success = gradarea.querySelector('.changeready');
        showsuccess(success);
      });
    },
    error: function(xhr, status, error) {
      console.log(error)
    }
  });


}

var classtype;
function addtype(type) {
  var button;
  
  if (type === "1") {
    var nowpage = document.getElementById(currentpage);
    button = nowpage.querySelector("#textwork");
    area=nowpage.querySelector(".new-class-area")
    date=nowpage.querySelector(".content-date-new")
    sbbutton =nowpage.querySelector(".ready-bt-new")
    area.style.display="flex";
    area.scrollIntoView({ behavior: 'smooth' });
    button.classList.add('active');
    showElement(date);
    showElement(sbbutton);
    classtype=type;
    var otherButton = nowpage.querySelector("#normalcs");
    if (otherButton.classList.contains('active')) {
      otherButton.classList.remove('active');
    }
  } else {
    var nowpage = document.getElementById(currentpage);
    button = nowpage.querySelector("#normalcs");
    button.classList.add('active');
    area=nowpage.querySelector(".new-class-area")
    date=nowpage.querySelector(".content-date-new")
    sbbutton =nowpage.querySelector(".ready-bt-new")
    classtype=type;
    area.style.display="flex";
    area.scrollIntoView({ behavior: 'smooth' });
    hideElement(date);
    showElement(sbbutton);
    var otherButton = nowpage.querySelector("#textwork");
    if (otherButton.classList.contains('active')) {
      otherButton.classList.remove('active');
    }
  }
  console.log(classtype)
}
function resetnew(header,courseid){
  var nowpage = document.getElementById(currentpage);
  var buttonwk = nowpage.querySelector("#textwork");
  var buttoncs = nowpage.querySelector("#normalcs");
  var area = nowpage.querySelector("#createnew");
  var clasarea=area.querySelector(".new-class-area")
  var date=area.querySelector(".content-date-new")
  var sbbutton =area.querySelector(".ready-bt-new")
  var titleinput =area.querySelector(".input-header");
  var contentinput =area.querySelector(".textarea-content");
  var dateinput =area.querySelector(".date-input");

  var filearea = area.querySelector("#work-area-file");
  fileid=courseid+header;
  if(selectedFiles[fileid]){
    selectedFiles[fileid]='';
  }
  filearea.innerHTML = '';

  dateinput.value="";
  titleinput.value="";
  contentinput.value="";
  sbbutton.style.display="none";
  date.style.display="none";
  clasarea.style.display="none";
  area.style.display="none";
  if (buttonwk.classList.contains('active')) {
    buttonwk.classList.remove('active');
  }
  if (buttoncs.classList.contains('active')) {
    buttoncs.classList.remove('active');
  }
  
}
function creat(courseid) {
  var nowpage = document.getElementById(currentpage);
  var area = nowpage.querySelector("#createnew");
  var titleinput = area.querySelector(".input-header");
  var contentinput = area.querySelector(".textarea-content");
  var dateinput = area.querySelector(".date-input");
  var type = classtype;
  var fileid = courseid + "createnew";

  
  var requestData = {
    courseid: courseid,
    newtype: type,
    newheader: titleinput.value,
    newcontent: contentinput.value
  };
  
  if (dateinput) {
    requestData.newdate = dateinput.value;
  }

  $.ajax({
    url:"./create.php",
    type: "POST",
    data: requestData,
    success: function(response) {
      if(selectedFiles[fileid]&& selectedFiles[fileid].length > 0){
        submitnewwork("createnew", courseid,response,requestData.newheader);
      }
    else{
      $(nowpage).load(location.href + ' #' + nowpage.id + ' > *', function () {
        var remoteContent = $(nowpage).html();
        $(nowpage).html(remoteContent);
      });
    }
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
}
function submitnewwork(area,courseid,id,header) {
  console.log(area,courseid,id,header)
  var nowpage =document.getElementById(currentpage);
  var escapedHeader = area.replace(/\s/g, '\\$&');
  var headerfile = nowpage.querySelector('#' + escapedHeader);
  var filearea = headerfile.querySelector("#work-area-file");
  var requestsCompleted = 0;
  fileid=courseid+area;

  selectedFiles[fileid].forEach(function(file) {
    var formData = new FormData();
    formData.append('file', file);

    $.ajax({
      url: './open.php',
      type: 'POST',
      data: {
        filename: file.name,
        courseid: courseid,
        area: header,
        id:id
      },
      success: function(response) {
        

        requestsCompleted++;
        if (requestsCompleted === selectedFiles[fileid].length) {
            var formData=new FormData();
        for (var i=0;i < selectedFiles[fileid].length;i++) {
            var file=selectedFiles[fileid][i];
            formData.append('files[]', file, file.name);
        }
        
        var xhr=new XMLHttpRequest();
        xhr.open('POST', 'open.php', true);
        formData.append('courseid', courseid);
        formData.append('header',header)
        xhr.onload=function() {
            if (xhr.status===200) {
                  console.log("ok");

                  selectedFiles[fileid]=[]
                  location.reload();
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
function addwork(header,courseid) {
  var nowpage =document.getElementById(currentpage);
  var escapedHeader = header.replace(/\s/g, '\\$&');
  var headerfile = nowpage.querySelector('#' + escapedHeader);
  var studentfile = headerfile.querySelector("#file");
  var filearea = headerfile.querySelector("#work-area-file");
  fileid=courseid+header;
 var addfiles = Array.from(studentfile.files);

  if (!selectedFiles[fileid]) {
    selectedFiles[fileid] = [];
  }

  selectedFiles[fileid] = selectedFiles[fileid].concat(addfiles);
  console.log(selectedFiles);
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
}

var oldElement={};//this is content/header dr
var deletelink={};
// var oldcontent=[];
// var olddate=[];
function delfileonlink(id, area) {
  var escapedHeader = area.replace(/\s/g, '\\$&');
  var headerfile = document.querySelector('#' + escapedHeader);
  var link = headerfile.querySelector('[title="' + id + '"]');
  if (!deletelink[area]) {
    deletelink[area] = [];
  }
  deletelink[area].push(id);
  hideElement(link);
}
function sumbitchange(area,courseid,id) {
  var nowpage =document.getElementById(currentpage);
  var escapedHeader = area.replace(/\s/g, '\\$&');
  var headerfile = nowpage.querySelector('#' + escapedHeader);
  var header = headerfile.querySelector('.input-header');
  var content = headerfile.querySelector('.textarea-content');
  var inputdate = headerfile.querySelector('.date-input');

  //file
  if (deletelink.hasOwnProperty(area) && Object.keys(deletelink[area]).length !== 0) {
    var data = deletelink[area];
    Object.keys(data).forEach(function(key) {
      delsavefile(data[key]);
    });
  }
  // update file
  fileid=courseid+area;
  console.log(fileid);
  console.log(selectedFiles[fileid]);
  if(selectedFiles[fileid]&& selectedFiles[fileid].length > 0){
  submitwork(area,courseid,id);
  }
  //change input
  if (inputdate) {
    changeupdate(id, header.value, content.value, inputdate.value);
  } else {
    changeupdate(id, header.value, content.value);
  }

}
function changeupdate(dbcid, courseheader, coursecontent, date) {
  var nowpage = document.getElementById(currentpage);
  var requestData = {
    dbcid: dbcid,
    courseheader: courseheader,
    coursecontent: coursecontent
  };

  if (date) {
    requestData.date = date;
  }

  $.ajax({
    url: "./open.php",
    type: "POST",
    data: requestData,
    success: function(response) {
      $(nowpage).load(location.href + ' #' + nowpage.id + ' > *', function() {
        var remoteContent = $(nowpage).html();
        $(nowpage).html(remoteContent);
      });
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
}


function submitwork(area,courseid,id) {
  var nowpage =document.getElementById(currentpage);
  var escapedHeader = area.replace(/\s/g, '\\$&');
  var headerfile = nowpage.querySelector('#' + escapedHeader);
  var filearea = headerfile.querySelector("#work-area-file");
  var requestsCompleted = 0;
  fileid=courseid+area;

  selectedFiles[fileid].forEach(function(file) {
    var formData = new FormData();
    formData.append('file', file);

    $.ajax({
      url: './open.php',
      type: 'POST',
      data: {
        filename: file.name,
        courseid: courseid,
        area: area,
        id:id
      },
      success: function(response) {
        

        requestsCompleted++;
        if (requestsCompleted === selectedFiles[fileid].length) {
            var formData=new FormData();
        for (var i=0;i < selectedFiles[fileid].length;i++) {
            var file=selectedFiles[fileid][i];
            formData.append('files[]', file, file.name);
        }
        
        var xhr=new XMLHttpRequest();
        xhr.open('POST', 'open.php', true);
        formData.append('courseid', courseid);
        formData.append('header',area)
        xhr.onload=function() {
            if (xhr.status===200) {
                  console.log("ok");

                  selectedFiles[fileid]=[]
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

function delsavefile(dateid) {
 console.log("ok")
  $.ajax({
    url: "./open.php",
    type: "POST",
    data: {
       dateid:dateid
    },
    success: function(response) {
      $(nowpage).load(location.href + ' #' + nowpage.id + ' > *', function() {
        var remoteContent = $(nowpage).html();
        $(nowpage).html(remoteContent);
      });
    },
    error: function(xhr, status, error) {
      console.log(error)
    }
  });
}

function reset(courseid,area) {
  var nowpage =document.getElementById(currentpage);
  var escapedHeader = area.replace(/\s/g, '\\$&');
  var headerfile = nowpage.querySelector('#' + escapedHeader);
  var header = headerfile.querySelector('.input-header');
  var content = headerfile.querySelector('.textarea-content');
  var date = headerfile.querySelector('.date-input');
  var editButton = headerfile.querySelector('#editButton');
  var buttonArea = headerfile.querySelector('.edit-button-area');
  var submitArea = headerfile.querySelector('.submit-area');
  var link =headerfile.querySelectorAll('.left-course-class-content-link');
  var linkbutton =headerfile.querySelectorAll('.left-course-class-content-link button');
  fileid=courseid+header;
  var filearea = headerfile.querySelector("#work-area-file");

  if(selectedFiles[fileid]){
    selectedFiles[fileid]='';
  }
  filearea.innerHTML = '';

  replaceElement(header, createSpan(oldElement[area].oldheader));
  replaceElement(content, createSpan(oldElement[area].oldcontent));
  hideElement(buttonArea);
  hideElement(submitArea);
  hideElement(linkbutton);
  showElement(editButton);
  if (date) {
    replaceElement(date, createSpan(oldElement[area].olddate));
  }
  if(link){
    showElement(link);
  }
  delete oldElement[area];
  deletelink={};
  console.log(oldElement);
}
function createSpan(text) {
  var span = document.createElement('span');
  span.textContent = text;
  return span;
}

function convertToInput(area) {
  var nowpage =document.getElementById(currentpage);
  var escapedHeader = area.replace(/\s/g, '\\$&');
  var headerfile = nowpage.querySelector('#' + escapedHeader);
  var header = headerfile.querySelector('.left-course-class-header span');
  var content = headerfile.querySelector('.left-course-class-content span');
  var editButton = headerfile.querySelector('#editButton');
  var buttonArea = headerfile.querySelector('.edit-button-area');
  var submitArea = headerfile.querySelector('.submit-area');
  var date = headerfile.querySelector('.content-date span');
  var linkbutton =headerfile.querySelectorAll('.left-course-class-content-link button');

  replaceElement(header, createInput('input-header', 'text', header.textContent));
  replaceElement(content, createTextarea('textarea-content', content.textContent));
  hideElement(editButton);
  showElement(buttonArea);
  showElement(linkbutton);
  showElement(submitArea);
  if (date) {
    replaceElement(date, createInput('date-input', 'date', date.value));
  }

  oldElement = {
    ...oldElement,
    [area]: {
      oldheader: header.textContent,
      oldcontent: content.textContent,
      olddate: date ? date.textContent : null
    }
  };
  console.log(oldElement)
}

function replaceElement(oldElement, newElement) {
  oldElement.parentNode.replaceChild(newElement, oldElement);
  TweenMax.fromTo(newElement, 0.3, { opacity: 0 }, { opacity: 1 });
}

function createInput(className, type, value) {
  var input = document.createElement('input');
  input.classList.add(className);
  input.type = type;
  input.value = value;
  return input;
}

function createTextarea(className, value) {
  var textarea = document.createElement('textarea');
  textarea.classList.add(className);
  textarea.value = value;
  return textarea;
}

function hideElement(element) {
  TweenMax.to(element, 0.3, { opacity: 0, display: 'none' });
}

function showElement(element) {
  TweenMax.fromTo(element, 0.3, { opacity: 0, display: 'none' }, { opacity: 1, display: 'flex' });
}

function getCurrentDate() {
  var currentDate = new Date();
  var year = currentDate.getFullYear();
  var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
  var day = currentDate.getDate().toString().padStart(2, '0');
  return `${year}-${month}-${day}`;
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







