<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>Welcome</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.2.0/tailwind.min.css">
<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src=""></script>

   <script type="text/javascript">
    function setFiletype(fileType, buttonData, glyph){
        var defaultString = 'Search';
        if (fileType==-1) {
            fileType="";
        }
        switch(glyph) {
            case 'film':
                $("#query").prop('placeholder',defaultString+' eg. DragonBall / Fast & Furious');
                break;
            case 'music':
                $("#query").prop('placeholder',defaultString+' eg. Eminem discography / Akon');
                break;
            case 'book':
                $("#query").prop('placeholder',defaultString+' eg. Alice in Wonderland ');
                break;
            case 'desktop':
                $("#query").prop('placeholder',defaultString+' eg. Counter Strike / Mario');
                break;
            case 'image':
                $("#query").prop('placeholder',defaultString+' eg. Megan Fox / Dasha Taran');
                break;
            case 'asterisk':
                $("#query").prop('placeholder',defaultString+' & get results!');
                break;
        }
        $("#fileType").prop('value',fileType);
        $("#ddbutton").html('<span class="fa fa-'+glyph+'" aria-hidden="true"></span><span class="caret"></span>');
        var eventActionEle = document.getElementById('eventAction');
        eventActionEle.value = buttonData;
        $("#query").focus();
        
    }
    function searchGoogle () {
        var query = document.getElementById('query').value;
        var fileType = document.getElementById('fileType').value;
        var eventActionValue = document.getElementById('eventAction').value;
        if (fileType=="") {
            var finalQuery = query+" -inurl:(jsp|pl|php|html|aspx|htm|cf|shtml) intitle:index.of -inurl:(listen77|mp3raid|mp3toss|mp3drug|index_of|wallywashis)";
            eventActionValue = 'Other';
        } else {
            var finalQuery = query+" +("+fileType+") -inurl:(jsp|pl|php|html|aspx|htm|cf|shtml) intitle:index.of -inurl:(listen77|mp3raid|mp3toss|mp3drug|index_of|wallywashis)";
        }
        var url = "https://www.google.com/search?q="+encodeURIComponent(finalQuery);
        console.log(url);
        window.open(url, '_blank');
        $.post( "https://www.filechef.com/search_log", $( "#searchForm" ).serialize());
        ga('send', {
            hitType: 'event',
            eventCategory: 'Search',
            eventAction: eventActionValue,
            eventLabel: query
        });
    }
    function openDropdown(){
        $('#query').focus();
    }

    function searchDrive () {
        var query = document.getElementById('query').value;
        var fileType = document.getElementById('type').value;
        if (fileType=="" || fileType=="all") {
            var finalQuery = query+" site:drive.google.com";
        } else {
            var finalQuery = query+" site:drive.google.com +\"drive/folders\"";
        }
        var url = "https://www.google.com/search?q="+encodeURIComponent(finalQuery);
        console.log(url);
        window.open(url, '_blank');
        ga('send', {
            hitType: 'event',
            eventCategory: 'GDrive Search',
            eventAction: eventActionValue,
            eventLabel: query
        });
    }
    
    function setGDriveFiletype(buttonData, glyph){
        switch(glyph) {
            case 'book':
                filetype = "folder";
                break;
            case 'asterisk':
                filetype = "all";
                break;
        }
        $("#type").prop('value', filetype);
        $("#ddbutton").html('<span class="fa fa-'+glyph+'" aria-hidden="true"></span> '+buttonData+' <span class="caret"></span>');
    }

    function explore () {
        var query = document.getElementById('query').value;
        var finalQuery = query+" site:drive.google.com";
        var url = "https://www.google.com/search?q="+encodeURIComponent(finalQuery);
        console.log(url);
        window.open(url, '_blank');
        ga('send', {
            hitType: 'event',
            eventCategory: 'GDrive Search',
            eventAction: eventActionValue,
            eventLabel: query
        });
    }

    $('#query').keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            searchGoogle();            
            return false;
        }
    });
</script>
<style type="text/css">
    pre {
        margin: 1em 0;
        text-align: center;
    }
   
    .white {color:#ffffff;}
</style><!-- GA code -->
<script type="text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-76194754-1', 'auto');
    ga('send', 'pageview');
</script>
<script>
/**
* Function that captures a click on an outbound link in Analytics.
* This function takes a valid URL string as an argument, and uses that URL string
* as the event label. Setting the transport method to 'beacon' lets the hit be sent
* using 'navigator.sendBeacon' in browser that support it.
*/
var captureAppDownload = function(platform, url) {
   ga('send', 'event', 'outbound', 'AppDownload', platform, {
     'transport': 'beacon',
     'hitCallback': function(){document.location = url;}
   });
}
</script>

    <style>
    
@import url("https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap");
* {
  box-sizing: border-box;
}



.popup {
  display: flex;
  align-items: center;
  justify-content: center;
  position: fixed;
  width: 100vw;
  height: 100vh;
 
  bottom: 0;
  right: 0;
  
  z-index: 999;
  visibility: hidden;
  opacity: 0;
  overflow: hiden;
  transition: 0.64s ease-in-out;
}
.popup-inner {
  position: relative;
  bottom: -100vw;
  right: -100vh;
  display: flex;
  align-items: center;
  max-width: 800px;
   border-radius:20px;
  max-height: 400px;
  width: 60%;
  height: 80%;
  background-color: #fff;
  transform: rotate(32deg);
  transition: 0.64s ease-in-out;
}
.popup__photo {
  display: flex;
  justify-content: flex-end;
  align-items: flex-end;
  width: 40%;
  height: 100%;
  overflow: hidden;
}
.popup__photo img {
  width: auto;
  height: 100%;
}
.popup__text {
  
  flex-direction: column;
  justify-content: center;
  width: 95%;
  height: 100%;
  padding: 4rem;
}
.popup__text h1 {
  font-size: 2rem;
  font-weight: 600;
  margin-bottom: 2rem;
  text-transform: uppercase;
  color: #0A0A0A;
}
.popup__text p {
  font-size: 0.875rem;
  color: #686868;
  line-height: 1.5;
}
.popup:target {
  visibility: visible;
  opacity: 1;
}
.popup:target .popup-inner {
  bottom: 0;
  right: 0;
  transform: rotate(0);
}
.popup__close {
  position: absolute;
  right: -1rem;
  top: -1rem;
  width: 3rem;
  height: 3rem;
  font-size: 0.875rem;
  font-weight: 300;
  border-radius: 100%;
  background-color: #0A0A0A;
  z-index: 4;
  color: #fff;
  line-height: 3rem;
  text-align: center;
  cursor: pointer;
  text-decoration: none;
}
body {
  margin: 0;
  font-family: "Montserrat";
  background: #212121;
  font-size: 18px;
  height: 100vh;
}

.container1 {
  margin: 0 auto;
  
}

::-webkit-scrollbar {
  /* Webkit */
  width: 0;
  height: 0;
}

.container1 .logo {
  width: 120px;
}
.container1 h1 {

}
.container1 p {
  line-height: 1.7rem;
}
.container1 .left {
/*  background-image: url("https://images.hdqwalls.com/wallpapers/street-light-4k.jpg"); /* The image used */
  background-color: #212121; /* Used if the image is unavailable */
  height: 500px; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; /* Resize the background image to cover the entire container */
  padding: 1em;
}
.container1 .left p, .container .left h1 {
  color: white;
}
.container1 .right p {
  margin: 2em 0 1em;
}
.container1 .light {
  color: rgba(255, 255, 255, 0.7) !important;
  margin-top: 2em;
}
.container1 input, .container button {
  width: 100%;
 
  padding: 0.5em;
  font-size: 1.3rem;
  outline: none;
  margin: 1em;
}
.container1 button {
  display:inline-block;
  margin: 0;
 width:30px;
 height:50px;
  color: white;
  border: none;
  cursor: pointer;
}

.attention {
  width: 100%;
  margin: 0.5em auto 0;
  text-align: center;
}
.attention .me {
  margin-top: 2em;
  width: 3em;
  border-radius: 50%;
}
.attention .arrow {
  width: 15em;
}

@media only screen and (min-width: 768px) {
  body {
    font-size: 20px;
  }

  button {
    width: 60% !important;
  }


}
@media only screen and (min-width: 1024px) {
  .logo {
    margin: 1em 0;
  }

  p {
    line-height: 1.7em !important;
  }

  .inner {
    display: grid;
    grid-template-columns: 55% auto;
  }
  .inner .left {
    text-align: left;
    padding: 0 2em;
    height: 90vh;
    display: grid;
  }
  .inner .left .content {
    padding: 0 3em;
  }
  .inner .left h1 {
    margin: 0;
    font-size: 2.4em;
  }
  .inner .left h1 span {
    display: block;
  }
  .inner .right {
    text-align: right;
    
    padding: 2 2em 2.5em;
    justify-self: center;
  }
  .inner .right input {
    width: 100% !important;
    margin: 0.3em 0;
  }
  .inner .right button {
    width: 100% !important;
  }

  .proto-container {
    clip-path: inset(0 45% 0 0);
    position: absolute;
    top: 20%;
    height: 70%;
    z-index: 0;
    width: 100%;
    pointer-events: none;
  }
  .proto-container .proto {
    border: 3px solid rgba(255, 255, 255, 0.1);
    width: 19%;
    height: 80%;
    float: left;
    margin-left: 1em;
    transform: translateX(10%);
  }
}
@media only screen and (min-width: 1600px) {
  body {
    font-size: 22px;
  }

  .content {
    padding: 0 6em !important;
  }

  .right {
    padding: 2 !important;
   margin-right:20px;
   margin-top:20px;
   
    
  }
}
img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
display: none;}
.accordion-item-header::after {
	content: "\002B";
	position: absolute;
	right: 1rem;
	bottom: 0.8rem;
}

.accordion-item-header.active::after {
	content: "\2212";
}

.accordion-item-body {
	max-height: 0;
	transition: max-height 0.2s ease-out;
}
.rc {
    border-radius:10px;
}
.rc1 {
    border-top-right-radius: 60px;
    border-top-left-radius: 60px;
    border-bottom-left-radius: 10px;
     border-bottom-right-radius: 10px;
}


 video {
            width: 200px;
            margin: 20px;
            display: inline-block;
            border-radius: 20px;
            -webkit-box-shadow: 0px 12px 15px -7px rgba(102, 105, 105, 1);
            -moz-box-shadow: 0px 12px 15px -7px rgba(102, 105, 105, 1);
            box-shadow: 0px 12px 15px -7px rgba(102, 105, 105, 1);
        }
        strong {
            margin: 5px;
            padding: 20px;
     
            border-radius: 15px;
            background: #f2d9ff;
            color: #000;
            
        }
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,800');

@media (min-width: 500px) {
  .col-sm-6 {
    width: 50%;
  }
}
html, body {
  height: 100%;
  min-height: 18em;
}

.frontend-side {
  background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/74452/website-code.png");
}

.uiux-side {
  background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/74452/website-post-its.png");
}

.split-pane {
  padding-top: 1em;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  height: 50%;
  min-height: 9em;
  font-size: 2em;
  color: white;
  font-family: 'Open Sans', sans-serif;
	font-weight:300;
;
}
@media(min-width: 500px) {
  .split-pane {
    padding-top: 2em;
    height: 100%;
  }
}
.split-pane > div {
  position: relative;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  text-align: center;
}
.split-pane > div .text-content {
  line-height: 1.6em;
  margin-bottom: 1em;
}
.split-pane > div .text-content .big {
  font-size: 2em;
}
.split-pane > div img {
  height: 1.3em;
}
@media (max-width: 500px) {
  .split-pane > div img {
    display:none;
  }
}
.split-pane button, .split-pane a.button {
  font-family: 'Open Sans', sans-serif;
	font-weight:800;
  background: none;
  border: 1px solid white;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  width: 15em;
  padding: 0.7em;
  font-size: 0.5em;
  -moz-transition: all 0.2s ease-out;
  -o-transition: all 0.2s ease-out;
  -webkit-transition: all 0.2s ease-out;
  transition: all 0.2s ease-out;
  text-decoration: none;
  color: white;
  display: inline-block;
	cursor: pointer;
}
.split-pane button:hover, .split-pane a.button:hover {
  text-decoration: none;
  background-color: white;
  border-color: white;
	cursor: pointer;
}

.bs{
   box-shadow: 10px 6px 29px -9px rgba(143,143,143,0.75);
-webkit-box-shadow: 10px 6px 29px -9px rgba(143,143,143,0.75);
-moz-box-shadow: 10px 6px 29px -9px rgba(143,143,143,0.75);
}

.bs1{
   box-shadow: 8px 16px 35px -7px rgba(0,57,255,0.75);
-webkit-box-shadow: 8px 16px 35px -7px rgba(0,57,255,0.75);
-moz-box-shadow: 8px 16px 35px -7px rgba(0,57,255,0.75);
}


.uiux-side.split-pane button:hover, .split-pane a.button:hover {
  color: violet;
}
.frontend-side.split-pane button:hover, .split-pane a.button:hover {
  color: blue;
}

#split-pane-or {
  font-size: 2em;
  color: white;
  font-family: 'Open Sans', sans-serif;
  text-align: center;
  width: 100%;
  position: absolute;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
@media (max-width: 925px) {
  #split-pane-or {
    top:15%;
  }
}
#split-pane-or > div img {
  height: 2.5em;
}
@media (max-width: 500px) {
  #split-pane-or {
    position: absolute;
    top: 50px;
  }
  #split-pane-or > div img {
    height:2em;
  }
}
@media(min-width: 500px) {
  #split-pane-or {
    font-size: 3em;
  }
}
.big {
  font-size: 2em;
}

#slogan {
  position: absolute;
  width: 100%;
  z-index: 100;
  text-align: center;
  vertical-align: baseline;
  top: 0.5em;
  color: white;
  font-family: 'Open Sans', sans-serif;
  font-size: 1.4em;
}
@media(min-width: 500px) {
  #slogan {
    top: 5%;
    font-size: 1.8em;
  }
}
#slogan img {
  height: 0.7em;
}
.bold {
	text-transform:uppercase;
}
.big {
	font-weight:800;
}


.lg\:max-w-lg1 {
    max-width:22rem;
}
:active, :hover, :focus {
  outline: 0!important;
  outline-offset: 0;
}
::before,
::after {
  position: absolute;
  content: "";
}

.btn-holder {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  max-width: 1000px;
  margin: 10px auto 35px;
}
.btn {
  position: relative;
  display: inline-block;
  width: auto; height: auto;
  background-color: transparent;
  border: none;
  cursor: pointer;
  margin: 0px 25px 15px;
  min-width: 150px;
}
  .btn span {         
    position: relative;
    display: inline-block;
    font-size: 14px;
    font-weight: bold;
    letter-spacing: 2px;
    text-transform: uppercase;
    top: 0; left: 0;
    width: 100%;
    padding: 15px 20px;
    transition: 0.3s;
  }

/*--- btn-1 ---*/
.btn-1::before {
  background-color: rgb(28, 31, 30);
  transition: 0.3s ease-out;
}
.btn-1 span {
  color: rgb(255,255,255);
  border: 1px solid rgb(28, 31, 30);
  transition: 0.2s 0.1s;
}
.btn-1 span:hover {
  color: rgb(28, 31, 30);
  transition: 0.2s 0.1s;
}

/* 1.hover-filled-slide-down */
.btn.hover-filled-slide-down::before {
  bottom: 0; left: 0; right: 0; 
  height: 100%; width: 100%;
}
.btn.hover-filled-slide-down:hover::before {
  height: 0%;
}

/* 2.hover-filled-slide-up */
.btn.hover-filled-slide-up::before {
  top: 0; left: 0; right: 0;
  height: 100%; width: 100%;
}
.btn.hover-filled-slide-up:hover::before {
  height: 0%;
}

/* 3.hover-filled-slide-left */
.btn.hover-filled-slide-left::before {
  top: 0; bottom: 0; left: 0;
  height: 100%; width: 100%;
}
.btn.hover-filled-slide-left:hover::before {
  width: 0%;
}

/* 4. hover-filled-slide-right */
.btn.hover-filled-slide-right::before {
  top:0; bottom: 0; right: 0;
  height: 100%; width: 100%;
}
.btn.hover-filled-slide-right:hover::before {
  width: 0%;
}

/* 5. hover-filled-opacity */
.btn.hover-filled-opacity::before {
  top:0; bottom: 0; right: 0;
  height: 100%; width: 100%;
  opacity: 1;
}
.btn.hover-filled-opacity:hover::before {
  opacity: 0;
}

/*--- btn-2 ---*/
.btn-2::before {
  background-color: rgb(28, 31, 30);
  transition: 0.3s ease-out;
}
.btn-2 span {
  color: rgb(28, 31, 30);
  border: 1px solid rgb(28, 31, 30);
  transition: 0.2s;
}  
.btn-2 span:hover {
  color: rgb(255,255,255);
  transition: 0.2s 0.1s;
}

/* 6. hover-slide-down */
.btn.hover-slide-down::before {
  top: 0; left: 0; right: 0; 
  height: 0%; width: 100%;
}
.btn.hover-slide-down:hover::before {
  height: 100%;
}

/* 7. hover-slide-up */
.btn.hover-slide-up::before {
  bottom: 0; left: 0; right: 0; 
  height: 0%; width: 100%;
}
.btn.hover-slide-up:hover::before {
  height: 100%;
}

/* 8. hover-slide-left */
.btn.hover-slide-left::before {
  top: 0; bottom: 0; right: 0; 
  height: 100%; width: 0%;
}
.btn.hover-slide-left:hover::before {
  width: 100%;
}

/* 9. hover-slide-right */
.btn.hover-slide-right::before {
  top: 0; bottom: 0; left: 0; 
  height: 100%; width: 0%;
}
.btn.hover-slide-right:hover::before {
  width: 100%;
}

/* 10. hover-opacity */
.btn.hover-opacity::before {
  top:0; bottom: 0; right: 0;
  height: 100%; width: 100%;
  opacity: 0;
}
.btn.hover-opacity:hover::before {
  opacity: 1;
}

/*--- btn-3 ---*/
.btn-3 {
  padding: 5px;
}
.btn-3 span {
  color: rgb(255, 255, 255);
  background-color: rgb(54, 56, 55);
}
.btn-3::before,
.btn-3::after {
  background: transparent;
  z-index: 2;
}

/* 11. hover-border-1 */
.btn.hover-border-1::before,
.btn.hover-border-1::after {
  width: 10%; height: 25%;
  transition: 0.35s;
}
.btn.hover-border-1::before {
  top: 0; left: 0;
  border-left: 1px solid rgb(28, 31, 30);
  border-top: 1px solid rgb(28, 31, 30);
}
.btn.hover-border-1::after {
  bottom: 0; right: 0;
  border-right: 1px solid rgb(28, 31, 30);
  border-bottom: 1px solid rgb(28, 31, 30);
}
.btn.hover-border-1:hover::before,
.btn.hover-border-1:hover::after {
  width: 99%;
  height: 98%;
}

/* 12. hover-border-2 */
.btn.hover-border-2::before,
.btn.hover-border-2::after {
  width: 10%; height: 25%;
  transition: 0.35s;
}
.btn.hover-border-2::before {
  bottom: 0; left: 0;
  border-left: 1px solid rgb(28, 31, 30);
  border-bottom: 1px solid rgb(28, 31, 30);
}
.btn.hover-border-2::after {
  top: 0; right: 0;
  border-right: 1px solid rgb(28, 31, 30);
  border-top: 1px solid rgb(28, 31, 30);
}
.btn.hover-border-2:hover::before,
.btn.hover-border-2:hover::after {
  width: 99%;
  height: 99%;
}

/* 13. hover-border-3 */
.btn.hover-border-3::before,
.btn.hover-border-3::after {
  width: 0%; height: 0%;
  opacity: 0;
  transition: width 0.2s 0.15s linear, height 0.15s linear, opacity 0s 0.35s;
}
.btn.hover-border-3::before {
  top: 0; right: 0;
  border-top: 1px solid rgb(28, 31, 30);
  border-left: 1px solid rgb(28, 31, 30);
}
.btn.hover-border-3::after {
  bottom: 0; left: 0;
  border-bottom: 1px solid rgb(28, 31, 30);
  border-right: 1px solid rgb(28, 31, 30);
}
.btn.hover-border-3:hover::before,
.btn.hover-border-3:hover::after {
  width: 100%; height: 99%;
  opacity: 1;
  transition: width 0.2s linear, height 0.15s 0.2s linear, opacity 0s;   
}

/* 14. hover-border-4 */
.btn.hover-border-4::before,
.btn.hover-border-4::after {
  width: 0%; height: 0%;
  opacity: 0;
  transition: width 0.2s linear, height 0.15s 0.2s ease-out, opacity 0s 0.35s;
}
.btn.hover-border-4::before {
  bottom: 0; left: -1px;
  border-top: 1px solid rgb(28, 31, 30);
  border-left: 1px solid rgb(28, 31, 30);
}
.btn.hover-border-4::after {
  top: 0; right: 0;
  border-bottom: 1px solid rgb(28, 31, 30);
  border-right: 1px solid rgb(28, 31, 30);
}
.btn.hover-border-4:hover::before,
.btn.hover-border-4:hover::after {
  width: 100%; height: 99%;
  opacity: 1;
  transition: width 0.2s 0.15s ease-out, height 0.15s ease-in, opacity 0s;   
}

/* 15. hover-border-5 */
.btn.hover-border-5::before,
.btn.hover-border-5::after {
  width: 0%; height: 0%;
  opacity: 0;
}
.btn.hover-border-5::before {
  top: 0; right: 0;
  border-top: 1px solid rgb(28, 31, 30);
  border-left: 1px solid rgb(28, 31, 30);
  transition: width 0.2s 0.5s ease-out, height 0.15s 0.35s linear, opacity 0s 0.7s;
}
.btn.hover-border-5::after {
  bottom: 0; left: 0px;
  border-bottom: 1px solid rgb(28, 31, 30);
  border-right: 1px solid rgb(28, 31, 30);
  transition: width 0.2s 0.15s linear, height 0.15s ease-in, opacity 0s 0.35s;
}
.btn.hover-border-5:hover::before,
.btn.hover-border-5:hover::after {
  width: 100%; height: 96%;
  opacity: 1;
}
.btn.hover-border-5:hover::before {
  transition: width 0.2s ease-in, height 0.15s 0.2s linear, opacity 0s;   /* 1,2 */
}
.btn.hover-border-5:hover::after {
  transition: width 0.2s 0.35s linear, height 0.15s 0.5s ease-out, opacity 0s 0.3s; 
} 

/*--- btn-4 ---*/
.btn-4 span {
  color: rgb(28, 31, 30);
  background-color: rgb(245,245,245);
}
.btn-4 span:hover {
  color: rgb(54, 56, 55);
}
.btn-4::before,
.btn-4::after {
  width: 15%; height: 2px;
  background-color: rgb(54, 56, 55);
  z-index: 2;
}

/* 16. hover-border-6 */
.btn.hover-border-6::before,
.btn.hover-border-6::after {
  top: 0;
  transition: width 0.2s 0.35s ease-out;
}
.btn.hover-border-6::before {
  right: 50%;
}
.btn.hover-border-6::after {
  left: 50%;
}
.btn.hover-border-6:hover::before,
.btn.hover-border-6:hover::after {
  width: 50%;
  transition: width 0.2s ease-in;   
}

.btn.hover-border-6 span::before,
.btn.hover-border-6 span::after {
  width: 0%; height: 0%;
  background: transparent;
  opacity: 0;
  z-index: 2;
  transition: width 0.2s ease-in, height 0.15s 0.2s linear, opacity 0s 0.35s;
}
.btn.hover-border-6 span::before {
  top: 0; left: 0;
  border-left: 2px solid rgb(54, 56, 55);
  border-bottom: 2px solid rgb(54, 56, 55);
}
.btn.hover-border-6 span::after {
  top: 0; right: 0;
  border-right: 2px solid rgb(54, 56, 55);
  border-bottom: 2px solid rgb(54, 56, 55);
}
.btn.hover-border-6 span:hover::before,
.btn.hover-border-6 span:hover::after {
  width: 50%; height: 96%;
  opacity: 1;
  transition: height 0.2s 0.2s ease-in, width 0.2s 0.4s linear, opacity 0s 0.2s;   
}

/* 17. hover-border-7 */
.btn.hover-border-7::before,
.btn.hover-border-7::after {
  bottom: 0;
  transition: width 0.2s 0.35s ease-out;
}
.btn.hover-border-7::before {
  right: 50%;
}
.btn.hover-border-7::after {
  left: 50%;
}
.btn.hover-border-7:hover::before,
.btn.hover-border-7:hover::after {
  width: 50%;
  transition: width 0.2s ease-in;   
}

.btn.hover-border-7 span::before,
.btn.hover-border-7 span::after {
  width: 0%; height: 0%;
  background: transparent;
  opacity: 0;
  z-index: 2;
  transition: width 0.2s ease-in, height 0.15s 0.2s linear, opacity 0s 0.35s;
}
.btn.hover-border-7 span::before {
  bottom: 0; left: 0;
  border-left: 2px solid rgb(54, 56, 55);
  border-top: 2px solid rgb(54, 56, 55);
}
.btn.hover-border-7 span::after {
  bottom: 0; right: 0;
  border-right: 2px solid rgb(54, 56, 55);
  border-top: 2px solid rgb(54, 56, 55);
}
.btn.hover-border-7 span:hover::before,
.btn.hover-border-7 span:hover::after {
  width: 50%; height: 96%;
  opacity: 1;
  transition: height 0.2s 0.2s ease-in, width 0.2s 0.4s linear, opacity 0s 0.2s;   
}

/* 18. hover-border-8 */
.btn.hover-border-8::before,
.btn.hover-border-8::after {
  bottom: 0;
  width: 15%;
  transition: width 0.2s 0.35s ease-out;
}
.btn.hover-border-8::before {
  right: 50%;
}
.btn.hover-border-8::after {
  left: 50%;
}
.btn.hover-border-8:hover::before {
  width: 50%;
  transition: width 0.2s ease-in;   
}
.btn.hover-border-8:hover::after {
  width: 50%;
  transition: width 0.1s ease-in;   
}

.btn.hover-border-8 span::before,
.btn.hover-border-8 span::after {
  width: 0%; height: 0%;
  bottom: 0;
  background: transparent;
  opacity: 0;
  z-index: 2;
}
.btn.hover-border-8 span::before {
  left: 0%;
  border-left: 2px solid rgb(54, 56, 55);
  transition: height 0.25s ease-in, opacity 0s 0.35s;   
}
.btn.hover-border-8 span:hover::before {
  height: 96%;
  opacity: 1;
  transition: height 0.25s 0.2s ease-out, opacity 0s 0.2s;   
}
.btn.hover-border-8 span::after {
  right: 0%;
  border-right: 2px solid rgb(54, 56, 55);
  border-top: 2px solid rgb(54, 56, 55);
  transition: width 0.2s ease-in, height 0.15s 0.2s linear, opacity 0s 0.35s;   
}
.btn.hover-border-8 span:hover::after {
  width: 99%; height: 96%;
  opacity: 1;
  transition: height 0.15s 0.1s linear, width 0.2s 0.25s linear, opacity 0s 0.1s;   
}

/* 19. hover-border-9 */
.btn.hover-border-9::before,
.btn.hover-border-9::after {
  bottom: 0;
  width: 15%;
  transition: width 0.2s 0.35s ease-out;
}
.btn.hover-border-9::before {
  right: 50%;
}
.btn.hover-border-9::after {
  left: 50%;
}
.btn.hover-border-9:hover::before {
  width: 50%;
  transition: width 0.1s ease-in;   
}
.btn.hover-border-9:hover::after {
  width: 50%;
  transition: width 0.2s ease-in;   
}

.btn.hover-border-9 span::before,
.btn.hover-border-9 span::after {
  width: 0%; height: 0%;
  bottom: 0;
  background: transparent;
  opacity: 0;
  z-index: 2;
}
.btn.hover-border-9 span::after {
  right: 0%;
  border-right: 2px solid rgb(54, 56, 55);
  transition: height 0.25s ease-in, opacity 0s 0.35s;   
}
.btn.hover-border-9 span:hover::after {
  height: 96%;
  opacity: 1;
  transition: height 0.25s 0.2s ease-out, opacity 0s 0.2s;   
}
.btn.hover-border-9 span::before {
  left: 0%;
  border-left: 2px solid rgb(54, 56, 55);
  border-top: 2px solid rgb(54, 56, 55);
  transition: width 0.2s ease-in, height 0.15s 0.2s linear, opacity 0s 0.35s;   
}
.btn.hover-border-9 span:hover::before {
  width: 98.5%; height: 96%;
  opacity: 1;
  transition: height 0.15s 0.1s linear, width 0.2s 0.25s linear, opacity 0s 0.1s;   
}

/* 20. hover-border-10 */
.btn.hover-border-10::before,
.btn.hover-border-10::after {
  left: 0%;
  height: 30%;
  width: 2px;
  transition: height 0.2s 0.35s ease-out;
}
.btn.hover-border-10::before {
  top: 50%;
}
.btn.hover-border-10::after {
  bottom: 50%;
}
.btn.hover-border-10:hover::before {
  height: 50%;
  transition: height 0.2s ease-in;   
}
.btn.hover-border-10:hover::after {
  height: 50%;
  transition: height 0.1s ease-in;   
}

.btn.hover-border-10 span::before,
.btn.hover-border-10 span::after {
  width: 0%; height: 0%;
  background: transparent;
  opacity: 0;
  z-index: 2;
}
.btn.hover-border-10 span::after {
  bottom: 0; left: 0%;
  border-bottom: 2px solid rgb(54, 56, 55);
  transition: width 0.25s ease-in, opacity 0s 0.35s;   
}
.btn.hover-border-10 span:hover::after {
  width: 100%;
  opacity: 1;
  transition: width 0.25s 0.2s ease-out, opacity 0s 0.2s;   
}
.btn.hover-border-10 span::before {
  top: 0%; left: 0%;
  border-top: 2px solid rgb(54, 56, 55);
  border-right: 2px solid rgb(54, 56, 55);
  transition: height 0.15s ease-in, width 0.2s 0.15s linear, opacity 0s 0.35s;   
}
.btn.hover-border-10 span:hover::before {
  width: 98.5%; height: 96%;
  opacity: 1;
  transition: width 0.2s 0.1s linear, height 0.15s 0.3s ease-out, opacity 0s 0.1s;   
}

/*--- btn-5 ---*/
.btn-5 span {
  color: rgb(28, 31, 30);
  border: 2px solid rgb(249, 211, 27);
  transition: 0.2s;
}
.btn-5 span:hover {
  background-color: rgb(245,245,245);
}

/* 21. hover-border-11 */
.btn.hover-border-11::before,
.btn.hover-border-11::after {
  width: 100%; height: 2px;
  background-color: rgb(54, 56, 55);
  z-index: 2;
  transition: 0.35s; 
}
.btn.hover-border-11::before {
  top: 0; right: 0;
}
.btn.hover-border-11::after {
  bottom: 0; left: 0;
}
.btn.hover-border-11:hover::before,
.btn.hover-border-11:hover::after {
  width: 0%;
  transition: 0.2s 0.2s ease-out; 
}

.btn.hover-border-11 span::before,
.btn.hover-border-11 span::after {
  width: 2px; height: 100%;
  background-color: rgb(54, 56, 55);
  z-index: 2;
  transition: 0.25s; 
}
.btn.hover-border-11 span::before {
  bottom: 0; right: -2px;
}
.btn.hover-border-11 span::after {
  top: 0; left: -2px;
}
.btn.hover-border-11 span:hover::before,
.btn.hover-border-11 span:hover::after {
  height: 0%;
}

input[type="file"] {
    
   
}

.euu1{
    padding-left:10%;
     padding-top:40px;
     padding-right:10%;
      padding-bottom:40px;
}
.euu{
     margin-top: 0px;
}
.main {
    height: inherit;
    background: linear-gradient(dodgerblue, darkblue);
    display: flex;
    align-items: center;
    justify-content: center;
}

.open-popup {
    box-sizing: border-box;
    color: white;
    font-size: 16px;
    font-family: sans-serif;
    width: 10em;
    height: 4em;
    border: 1px solid;
    text-align: center;
    line-height: 4em;
    text-decoration: none;
    text-transform: capitalize;
    margin: 1em;
}

.open-popup:hover {
    border-width: 2px;
}

/* popup page layout */
.specialImage{
  position:fixed;
  bottom:0;
  padding-right:10px;
  width:150px;
 right:0;
  z-index:100; /* or higher/lower depending on other elements */
}
.popup {
   
    top: 0;
    width: 100%;
    height: inherit;
    flex-direction: column;
    justify-content: flex-start;
    display: none;
}

.popup:target {
    display: flex;
}

.popup .back {
    font-size: 20px;
    font-family: sans-serif;
    text-align: center;
    height: 2em;
    line-height: 2em;
    
    color: black;
    text-decoration: none;
}

.popup .back:visited {
    
}

.popup .back:hover {
   
}

.popup p {
    
    text-align: center;
    margin: 0.1em 0.05em;
}

/* animation effects */

.popup > * {
    filter: opacity(0);
    animation: fade-in 0.5s ease-in forwards;
    animation-delay: 1s;
}

@keyframes fade-in {
    to {
        filter: opacity(1);
    }
}

.popup::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 0;
    top: 50%;
    background-color: white;
    animation: open-animate 0.5s cubic-bezier(0.8, 0.2, 0, 1.2) forwards;
    animation-delay: 0.5s;
}

@keyframes open-animate {
    to {
        height: 100vh;
        top: 0;
    }
}

.popup::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    background-color: white;
    top: calc((100% - 2px) / 2);
    left: 0;
    animation: line-animate 0.5s cubic-bezier(0.8, 0.2, 0, 1.2);
}

@keyframes line-animate {
    50%, 100% {
        width: 100%;
    }
}

</style>
    
    
</head>
<body>
    
   
  
      <div class="proto-container">
        <div class="proto"></div>
        <div class="proto"></div>
        <div class="proto"></div>
        <div class="proto"></div>
    </div>

    <div class="container1">
        <div class="inner">
            <div class="left">
                <img src="https://i.imgur.com/3HewRiE.png" alt="CompleteUI Logo" class="logo">

                <div class="content">
                     <h1 class="light" >Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome!</h1>

                    <p>Discover Features, you can get updates for your interests & more! <b>Important</b>, Some of these features might not work for all users!</p><br/><hr/><br/>
                    
                   
                    
                   <a href="reset-password.php" class="text-center px-6 py-2 text-xxs font-bold rounded  bg-red-200 text-red-700">Reset Your Password</a>
                   <a href="logout.php" class="text-center px-4 py-2 text-xxs font-bold rounded  bg-white-200 text-red-500">Logout</a>
                </div>
            </div>
            <div class="right">
               

              
          
         <br/><br/>
             
               <div class="flex flex-col my-4">
            <div class="m-2">
              <div class="component flex">
                <div class="w-full p-8 shadow-lg rounded-lg bg-gray-100 relative">
                  <table class="w-full text-left">
                      
                      
                      
                      
          
                    <tbody>
                        
                      <tr class="">
                        <td class="py-3">
                          <div class="flex">
                            <div class="w-12 h-12 bg-cover rounded-lg" style="background-image: url(&quot;https://simg.nicepng.com/png/small/270-2706165_apple-mail-logo.png&quot;);"></div>
                            <div class="leading-none ml-5 flex flex-col justify-around">
                              <div class="tracking-wide font-bold">O-Mailer v1</div>
                              <div class="text-xs text-gray-600">Send customized emails to anyone!</div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="leading-none flex flex-col justify-center">
                           
                           
                          </div>
                        </td>
                        <td>
                          <div class="leading-none flex flex-col justify-center">
                           
                          </div>
                        </td>
                        <td>
                         
                        </td>
                        <td>
                          <div class="">
                              <form  class="registration" action="mail/test.php" method="post">
                              <input class="text-center px-4 py-2 text-xs font-bold rounded opacity-75 bg-blue-200 text-white-700" type="submit" name="submit" value="Send">
                              
                              
                           
                            
                          </div>
                        </td>
                      </tr>
                      
                      <!---->
                      
                    </tbody>
                   
                  </table>
                  <div class="accordion mx-auto my-4">
	<div class="accordion-item bg-white text-gray-800 mx-0 mt-2 rounded-lg ">
		<div class="accordion-item-header flex items-center font-bold relative cursor-pointer pl-4 py-3">Discover more options!</div>
		<div class="accordion-item-body overflow-hidden">
			<div class="accordion-item-body-content p-4 leading-normal bg-gray-100"><div class="text-xs text-gray-600">Fill out this form and click send..</div><hr/><br/>
			<input type="text" class="rc" placeholder="✨ To whom you want to send mail" name="email">
                  <input type="text" class="rc" placeholder="👀 What should be the subject" name="subject"><br>
                  <input type="text"  class="rc"placeholder="📨 What should be senders mail" name="se"><br>
                  <input type="text"  class="rc"placeholder="🎈 Type your message" name="message">
                  </form>
			</div>
		</div>
	</div>


                      
</div>
             
             
            </div>
          </div>
        </div>
      </section>
        <!-- START-->
          <section class="my-8">
        
        <div>
          <div class="flex flex-col my-4">
            <div class="m-2">
              <div class="component flex">
                <div class="w-full p-8 shadow-lg rounded-lg bg-gray-100 relative">
                  <table class="w-full text-left">
                  
                    <tbody>
                      <tr class="">
                        <td class="py-3">
                          <div class="flex">
                            <div class="w-12 h-12 bg-cover rounded-lg" style="background-image: url(&quot;https://nollytech.com/wp-content/uploads/2019/04/justalk.png&quot;);"></div>
                            <div class="leading-none ml-5 flex flex-col justify-around">
                              <div class="tracking-wide font-bold">MeetCall</div>
                              <div class="text-xs text-gray-600">Free Video Calls Platform..</div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="leading-none flex flex-col justify-center">
                            <div class="font-bold text-sm">Beta</div>
                            <div class="mt-2 text-xs text-gray-600">v0.1</div>
                          </div>
                        </td>
                       
                        <td>
                          <div class="">
                            <div class="text-center px-4 py-2 text-xs font-bold rounded opacity-75 bg-red-200 text-black-700">Usage?</div>
                          <!--   <div class="pane" id="pane_1" style="display: none">
            <input type="text" value="1311" id="room_field" style="display:none;" >
            <input type="button" value="Start Offer" id="join" class="text-center px-4 py-2 text-xs font-bold rounded opacity-75 bg-yellow-200 text-yellow-700">
            
        </div><div class="pane" id="pane_2" style="display: none">
           
            <input type="button" value="Stop Offer" id="quit" class="text-center px-4 py-2 text-xs font-bold rounded opacity-75 bg-yellow-200 text-yellow-700">
        </div> -->
                          </div>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                 <div class="pane" id="pane_0">
            <img src="https://i.pinimg.com/originals/90/ec/a7/90eca7718c2bc164481344aecfaa1678.gif" class="rc" width="100%">
        </div>
        <div class="pane" id="pane_1" style="display: none">
         
            <input type="text" placeholder="📟 Room ID" class="component border bg-gray-100 px-4 py-2 text-sm tracking-wide focus:outline-none focus:shadow-outline rounded" id="room_field" >
            <input type="button" value="Join Conference Room" id="join" class="text-center  px-4 py-2 text-xs font-bold rounded opacity-75 bg-purple-200 text-white-700">
        </div>

        <div class="pane" id="pane_2" style="display: none">
            <div id="video_container"></div><br/>
            <input type="button" value="Quit Conference Room" id="quit" class="text-center px-4 py-2 text-xs font-bold rounded opacity-75 bg-purple-200 text-white-700">
        </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </section>
        <!-- END-->
   

                
            </div>
            
        </div>
        
    </div>
   
        
          

      <!-- hero -->
    <div class="hero bg-gray-100 py-8">
        <!-- container -->
        <div class="container   mx-auto">
            <!-- hero wrapper -->
            <div class="hero-wrapper grid grid-cols-1 md:grid-cols-12  items-center">

                <!-- hero text -->
                <div class="hero-text col-span-6">
                   <img src="https://i.imgur.com/Iy149Zd.png">
                   
                   
                    <div class="get-app flex space-x-5 justify-center md:justify-start">
                       <form id="searchForm" onsubmit="searchGoogle()">
	<input type="hidden" name="fileType" value="mkv|mp4|avi|mov|mpg|wmv" id="fileType">
	<div class="row d-flex justify-content-center">
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<div class="input-group mb-3">
			<hr/>	<input type="text" name="query" id="query" value="" class="rc bs" aria-label="search bar" placeholder="Search anything - 'Currently Selected Videos'">
				<div class="text-xm">An advanced search engine based on google string search! <b>Select a category -</b></div>
			
				<div class="input-group-prepend">
					
				
					
					<input id="eventAction" type="hidden" name="eventAction" value="Other">
					<div class="dropdown-menu"><br/>
				
					<a class="text-center px-4 py-2 text-xxs font-bold rounded opacity-75  bg-indigo-200 text-indigo-900"  onclick="setFiletype('mkv|mp4|avi|mov|mpg|wmv', 'Videos', 'film')"><span class="fa fa-film" aria-hidden="true"></span>🎥 Videos</a>
					
					
					
						<a class="text-center px-4 py-2 text-xxs font-bold rounded opacity-75  bg-indigo-200 text-indigo-900" onclick="setFiletype('exe|iso|tar|rar|zip|apk', 'Applications', 'desktop')"><span class="fa fa-desktop" aria-hidden="true"></span> 🦝 Applications</a>
					
					
					
					
					
						
						
						<a class="text-center px-4 py-2 text-xxs font-bold rounded opacity-75  bg-indigo-200 text-indigo-900"  onclick="setFiletype('-1', 'All Files', 'asterisk')"><span class="fa fa-asterisk" aria-hidden="true"></span>🔥 All Files</a>
					</div>
				</div>
				<div class="input-group-append">
					
				</div>
			</div>
		</div>
		<div class="col-lg-3">
		    
      
            
               
               
       
            
             
         

		    
		</div>
	</div>
</form>
                    </div>
                </div>

                <!-- hero image -->
                <div class="hero-image col-span-6">
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"><title>#102_travelling_twocolour</title><path d="M81.77,83.39c-28.67,17.47-45.66,49.51-43,83C40.18,183.48,46.54,200,63.35,209c44.83,24,240.55,24.45,269.51-18s18.19-102.84-44.8-128C233.46,41.18,155.82,38.3,81.77,83.39Z" fill="#e6e6e6" opacity="0.3"/><path d="M283.69,206V180.64a4.65,4.65,0,0,1,4.64-4.65h18.49a4.65,4.65,0,0,1,4.64,4.65V206" fill="none" stroke="#ffd200" stroke-miterlimit="10" stroke-width="2"/><path d="M283.69,206V180.64a4.65,4.65,0,0,1,4.64-4.65h18.49a4.65,4.65,0,0,1,4.64,4.65V206" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2" opacity="0.08"/><path d="M159.26,145.74s-18.34,7.36-12.41,28.68,6.48,23.63,19.71,22.32,4.66-22.32,4.66-22.32Z" fill="#ffd200"/><path d="M152.37,79.92s-50.86,11.79-64.24,41.59l45.05,3.4,11.54-7Z" fill="#ed8936"/><path d="M152.37,79.92s-50.86,11.79-64.24,41.59l45.05,3.4,11.54-7Z" fill="#fff" opacity="0.46"/><ellipse cx="200.42" cy="272.36" rx="154.08" ry="11.83" fill="#e6e6e6" opacity="0.45"/><path d="M134.79,246.33s-4.45,3.22-8.54.91-7.67.77-4.87,4.13,14.8,5,14.8,5l4.51-7.28Z" fill="#ed8936"/><path d="M215.08,260.56s1.94,5.15,6.62,5.47,6,4.88,1.79,6.14-15.12-4-15.12-4l.26-8.57Z" fill="#ed8936"/><path d="M79.19,260.08s-10.59-2.9-12.89-12.75c0,0,16.41-3.32,16.87,13.62Z" fill="#ed8936" opacity="0.58"/><path d="M80.49,259s-7.4-11.7-.89-22.64c0,0,12.48,7.93,6.93,22.66Z" fill="#ed8936" opacity="0.73"/><path d="M82.4,259s3.9-12.35,15.72-14.69c0,0,2.21,8-7.65,14.73Z" fill="#ed8936"/><polygon points="74.72 258.75 76.86 273.44 90.38 273.5 92.37 258.83 74.72 258.75" fill="#24285b"/><path d="M156.2,53.77s1.74,6.3,4.27,10a3.28,3.28,0,0,0,4.58.82c1.83-1.3,3.93-3.59,3.41-7.08l-.15-6a5.88,5.88,0,0,0-4.6-5C159.34,45.28,155,50,156.2,53.77Z" fill="#f4a28c"/><polygon points="169.43 54.63 177.9 74.3 166.73 78.19 165.05 62.32 169.43 54.63" fill="#f4a28c"/><path d="M170.86,55.92h0a.62.62,0,0,1-.23.72,4.34,4.34,0,0,1-5.25-.1,5.45,5.45,0,0,1-2.08-5.6,25.94,25.94,0,0,1-5.48,2.52,6,6,0,0,1-2,.32l-3.28-4s-4.23-3.66-1.89-5.67,4.76.61,6.11-2.44,1.54-4.07,4.27-3.72.83,3.12,4.53,1.7,4.36.08,5,1.75a3.1,3.1,0,0,1-.12,1.82A20.1,20.1,0,0,0,170.86,55.92Z" fill="#24285b"/><path d="M164.66,56.6s-.83-2.37,1-2.85,3.06,3,.77,4.16Z" fill="#f4a28c"/><path d="M157.5,57.68l-.83,3A1,1,0,0,0,157.85,62l2.51-.43Z" fill="#f4a28c"/><rect x="289.35" y="173.73" width="16.36" height="5.3" fill="#24285b"/><path d="M165.31,64.43s1.44-.49,3.72-3.33c0,0,1.05,4.15-3.26,8Z" fill="#ce8172" opacity="0.31"/><path d="M162.12,76.62l6.43-1.16a90.83,90.83,0,0,0,8.92-2.08c11-3.14,43.37-10.53,52.58,8.2,11.16,22.69-7.47,96.3-7.47,96.3h-51s-10.41-30.66-25.29-49.62S121,88.21,162.12,76.62Z" fill="#ed8936"/><path d="M152.37,79.92s-2.56,16.32,19.86,4l-5.75-8A58,58,0,0,0,152.37,79.92Z" opacity="0.08"/><path d="M94.92,139.7c-10.16-3.16-11.68-17-2.47-22.37a25.2,25.2,0,0,1,10.9-3.2c17.08-1.26,46.18-2.85,46.18-2.85s17.52,5.7,14.77,14.24-15.08-5.06-15.08-5.06S116.66,146.46,94.92,139.7Z" fill="#f4a28c"/><rect x="144.58" y="110.56" width="6.04" height="12.3" transform="translate(-14.69 21.47) rotate(-7.93)" fill="#24285b"/><rect x="143.84" y="109.5" width="6.04" height="3.82" transform="matrix(0.99, -0.14, 0.14, 0.99, -13.96, 21.32)" fill="#ffd200"/><path d="M166.48,75.84s-7.76,7.14,1.21,8.67,9.78-11.13,9.78-11.13Z" fill="#f4a28c"/><path d="M171.63,177.88l-38.45,68.45,9.93,6.91s21.24-35.45,46.53-53.26a6.38,6.38,0,0,1,9.72,3.27c6.84,21.15,7.42,58,7.42,58H218.5l4.08-83.34Z" fill="#24285b"/><path d="M171.63,177.88s19.15-15,25.92-36.41a6.57,6.57,0,0,1,11.08-2.37l18.2,19.68,3.67-20.57L217.19,96.09,192,79.92l-5,19.51Z" opacity="0.08"/><path d="M163.36,158.94s11.81-11.72,14.11-50.86c1.91-32.56,6.58-38.92,16.33-41.2,15.06-3.54,18.65.94,23.39,7.63,0,0-24.08,1.49-23.24,16.56s-2.51,68.75-22.32,86.81C171.63,177.88,162.44,177.11,163.36,158.94Z" fill="#ffd200"/><path d="M163.36,158.94s11.81-11.72,14.11-50.86c1.91-32.56,6.58-38.92,16.33-41.2,15.06-3.54,18.65.94,23.39,7.63,0,0-24.08,1.49-23.24,16.56s-2.51,68.75-22.32,86.81C171.63,177.88,162.44,177.11,163.36,158.94Z" fill="#fff" opacity="0.46"/><path d="M196.37,93.76c-5-12,8.93-27.14,21-22.46,10.32,4,21.35,12.84,27.34,30.64C258.94,144.25,291,164.7,291,164.7s16.36,2.7,16.36,8.65-19.34,0-19.34,0-50.2-20.83-76.24-54.3C204,109,199.22,100.59,196.37,93.76Z" fill="#f4a28c"/><path d="M226.35,134.56s19.94-6.75,25-16.62c0,0-7.22-38.91-32.87-47.28-8.44-2.75-17.87.34-22.29,8C190.83,88,192,105.22,226.35,134.56Z" fill="#ed8936"/><path d="M226.35,134.56s19.94-6.75,25-16.62c0,0-7.22-38.91-32.87-47.28-8.44-2.75-17.87.34-22.29,8C190.83,88,192,105.22,226.35,134.56Z" fill="#fff" opacity="0.46"/><rect x="271.49" y="198.46" width="52.16" height="67.53" fill="#ffd200"/><rect x="278.47" y="265.99" width="6.37" height="6.37" fill="#24285b"/><rect x="309.43" y="265.99" width="6.37" height="6.37" fill="#24285b"/><rect x="280.14" y="211.01" width="7.25" height="40.35" opacity="0.08"/><rect x="293.95" y="211.01" width="7.25" height="40.35" opacity="0.08"/><rect x="306.92" y="211.01" width="7.25" height="40.35" opacity="0.08"/><circle cx="222.58" cy="34.77" r="21.04" fill="#24285b"/><polygon points="214.44 34.77 196.44 52.7 220.3 43.18 214.44 34.77" fill="#24285b"/><rect x="220.3" y="25.3" width="3.51" height="11.08" fill="#fff"/><rect x="220.3" y="39.43" width="3.51" height="3.51" fill="#fff"/></svg>
                </div>
            </div>
        </div>
    </div><!-- end hero -->
      
    

        

        <script type="text/javascript" src="https://api.bistri.com/bistri.conference.min.js"></script>
       <!-- HERE-->

   
   
   
   
     <!-- HERE-->
     
     
     
  <!-- This is an example component -->
<div class=" bg-white">
    <div class=" mx-auto text-black">
      
        <div class="mt-28  flex flex-col md:flex-row  items-center text-sm text-black-400">
            <!-- <p class="order-2 euu1   md:order-1 mt-8 md:mt-0"> <img src="https://i.imgur.com/UDWASLL.png" width="250px"/> </p> -->
            
             <div class="grid gap-6 euu1 md:grid-cols-2 lg:grid-cols-4">
    <!-- Card 1 -->
    <div class="flex items-center p-4 bg-white border-2 border-gray-200 rounded-lg shadow-sm dark:bg-gray-800">
      <div class="p-3 mr-4 bg-blue-500 text-white rounded-full">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/bb/Nearby_Share_icon.png" width="50px"/>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-900">JS-CrashScript</p>
        
        <a onclick="myFunction()"><p class="text-center px-4 py-2 text-s font-bold rounded opacity-75 bg-red-200 text-black-700">Crash This Browser </p></a>
      </div>
    </div>
    
    
    <!-- Card 2 
    <div class="flex items-center p-4 bg-white border-2 border-gray-200 rounded-lg shadow-sm dark:bg-gray-800">
      <div class="p-3 mr-4 bg-blue-500 text-white rounded-full">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-900">Web-Proxy</p>
        <a href="https://obito.ml/proxy/"><p class="text-center px-4 py-2 text-s font-bold rounded opacity-75 bg-red-200 text-black-700">Unlock The Web </p></a>
      </div>
    </div> -->
    
    
    <!-- Card 3 -->

   <!-- <div class="flex items-center p-4 bg-white border-2 border-gray-200 rounded-lg shadow-sm dark:bg-gray-800">
      <div class="p-3 mr-4 bg-blue-500 text-white rounded-full">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-900">Template</p>
        <p class="text-sm font-normal text-gray-800">Templates and designs for your project</p>
      </div>
    </div> -->
    <!-- Card 4 -->
    <!--<div class="flex items-center p-4 bg-white border-2 border-gray-200 rounded-lg shadow-sm dark:bg-gray-800">
      <div class="p-3 mr-4 bg-blue-500 text-white rounded-full">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-900">Analytics</p>
        <p class="text-sm font-normal text-gray-800">User and customer analytics</p>
      </div>
    </div> -->
  </div>
            
        </div>
    </div>
</div>

<!-- Section 1 -->
<section class="w-full px-8 py-16 bg-black-100 xl:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col items-center md:flex-row">

            <div class="w-full space-y-5 md:w-3/5 md:pr-16">
                <p class="font-medium text-blue-500 uppercase">Beta v0.1</p>
                <h1 class="text-2xl font-extrabold leading-none text-white sm:text-3xl md:text-5xl">
                    Unlimited Image Uploader
                </h1><br/><button class="rc" type="submit" name="submit" class="btn btn-primary btn-block" style="background: #4066ff;border:none;" onclick="submitdata()">Upload</button>
                <p class="text-xl text-gray-600 md:pr-16"><br/>Click on ☁️ to select image..<br/>Still in Development Stage!</p>
            </div>

            <div class=" mt-48 md:mt-0 ">
                <div class="relative z-10 bs1 rc1 h-auto p-8 py-10 overflow-hidden bg-white border-b-2 border-gray-300 shadow-2xl px-7 rounded-none">
                    
                    <div class="container rc">
    
        <form role="form" action="##" onsubmit="return false" method="post" enctype="multipart/form-data" id="uploadForm">
       
        <input type="file" class="hidden"  name="file" id="files"  accept="image/png, image/jpeg, image/jpg, image/gif">
        <label for="files"> <img src="https://cdn.pixabay.com/photo/2017/01/18/17/39/cloud-computing-1990405_960_720.png" width="320px"/></label>
       <br/>  
        <div hidden class="Result"></div>
        <textarea hidden id="input"></textarea>
        
        </form>
        
    </div>
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var fileInput = document.querySelector('.input-file');
        var filelist = fileInput.files
        file = filelist.item(0)
        var tip = document.querySelector('.tip');
        fileInput.addEventListener('change',function(e){ 
            tip.textContent = 'Selected ' + this.files.length + ' Photo';
            //tip.textContent = this.files[0].name;
        })
        function CopyUrl() {
         var d = document.getElementById("imgurl");
         d.select(); 
         document.execCommand("Copy"); 
         alert("Copied Successfully！");
        }
        function submitdata() {
            $(".container .Result").css('display', 'block');
			$(".container .Result").html(
						    '<div class="euu"><strong>Uploading image 🎐️</strong></div>');
			$(".container .ewm").css('display', 'block');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "api.php" ,
                data: new FormData($('#uploadForm')[0]),
                cache: false,
                processData: false,
                contentType: false,
                success: function (result) {
                    console.log(result);
                    if(result.code == 200){
                        $(".container .Result").css('display', 'block');
					    $(".container .Result").html(
						'<div class="euu"><strong>Upload Successfully Done ✔️</strong><input type="text" value="'+ result.src +'" id="imgurl" size="15"><br><a href="'+ result.src + '" target="_Blank"></a> &nbsp;<button onclick="CopyUrl()" class="component border border-transparent rounded font-semibold tracking-wide text-sm px-5 py-2 focus:outline-none focus:shadow-outline bg-indigo-500 text-gray-100 hover:bg-indigo-600 hover:text-gray-200">Copy URL</button><br/><br/></div>');
					    $(".container .ewm").css('display', 'block');
                    }else{
						$(".container .Result").css('display', 'block');
					$(".container .Result").html(
						'<div class="alert alert-danger"><strong>Unknown Error</strong></div>');
						$(".container .ewm").css('display', 'block');
						setTimeout('closesctips()', 12000);
							}
					},
                error : function() {
                    $(".container .Result").css('display', 'block');
					$(".container .Result").html(
						'<div class="euu"><strong>No File Selected 👀</strong></div>');
					$(".container .ewm").css('display', 'block');
					setTimeout('closesctips()', 12000);
                }
            });
        }
    </script>
                    
                    
                </div>
            </div>

        </div>
    </div>
</section> 








<!--<a href="#terrestrial">--><img src="https://www.seekpng.com/png/full/107-1071009_cat-cats-anime-girl-loli-eye-eyes-japan.png" class="specialImage" /></a>

  
 


<section id="terrestrial" class="popup">
  <a href="#" class="back">Close</a>
  <p>Text Here!</p>
</section>



<!-- popup -->

 
  <div class="popup" id="jscrash">
    <div class="popup-inner">
     
      <div class="popup__text">
        <h1>Java Crash-Script 🔮</h1>
        <p id="demo">This script allows the javascript code to exploit a vulnerability in browsers by filling up your RAM with garbage values..USE this on your own risk, developer is not responsible for any damage caused!</p><br/>
<button class="component border border-transparent rounded font-semibold tracking-wide text-sm px-5 py-2 focus:outline-none focus:shadow-outline bg-red-500 text-gray-100 hover:bg-red-600 hover:text-gray-200" onclick="myFunction()">Start Crashing</button>

<script>
function myFunction() {
onbeforeunload = function(){localStorage.x=1};


if(confirm("The Script will run when pressed 'OK', note : Developer is not responsible for any damage caused to system. ")){
  setTimeout(function(){
    while(1)location.reload(1)
  }, 1000)
}}
</script>
      </div>
      <a class="popup__close" href="#!">X</a>
    </div>
  </div>

<!--end popup -->


<script>
var timeLeft = 160;
    var elem = document.getElementById('some_div');
    
    var timerId = setInterval(countdown, 1000);
    
    function countdown() {
      if (timeLeft == -1) {
        clearTimeout(timerId);
        doSomething();
      } else {
        elem.innerHTML = timeLeft + ' seconds remaining..';
        timeLeft--;
      }
    }
</script>
  <script>
  var room;

// when Bistri API client is ready, function
// "onBistriConferenceReady" is invoked
onBistriConferenceReady = function () {

    // test if the browser is WebRTC compatible
    if ( !BistriConference.isCompatible() ) {
        // if the browser is not compatible, display an alert
        alert( "your browser is not WebRTC compatible !" );
        // then stop the script execution
        return;
    }

    // initialize API client with application keys
    // if you don't have your own, you can get them at:
    // https://api.developers.bistri.com/login
    BistriConference.init( {
        appId: "7a5eebc7",
            appKey: "4465c0d6fb1f64b3d870e90e93080b57",
    } );

    /* Set events handler */

    // when local user is connected to the server
    BistriConference.signaling.addHandler( "onConnected", function () {
        // show pane with id "pane_1"
        showPanel( "pane_1" );
    } );

    // when an error occured on the server side
    BistriConference.signaling.addHandler( "onError", function ( error ) {
        // display an alert message
        alert( error.text + " (" + error.code + ")" );
    } );

    // when the user has joined a room
    BistriConference.signaling.addHandler( "onJoinedRoom", function ( data ) {
        // set the current room name
        room = data.room;
        // ask the user to access to his webcam
        BistriConference.startStream( "webcamSD", function( localStream ){
            // when webcam access has been granted
            // show pane with id "pane_2"
            showPanel( "pane_2" );
            // insert the local webcam stream into div#video_container node
            BistriConference.attachStream( localStream, q( "#video_container" ) );
            // then, for every single members present in the room ...
            for ( var i=0, max=data.members.length; i<max; i++ ) {
                // ... request a call
                BistriConference.call( data.members[ i ].id, data.room );
            }
        } );
    } );

    // when an error occurred while trying to join a room
    BistriConference.signaling.addHandler( "onJoinRoomError", function ( error ) {
        // display an alert message
       alert( error.text + " (" + error.code + ")" );
    } );

    // when the local user has quitted the room
    BistriConference.signaling.addHandler( "onQuittedRoom", function( room ) {
        // show pane with id "pane_1"
        showPanel( "pane_1" );
        // stop the local stream
        BistriConference.stopStream();
    } );

    // when a new remote stream is received
    BistriConference.streams.addHandler( "onStreamAdded", function ( remoteStream ) {
        // insert the new remote stream into div#video_container node
        BistriConference.attachStream( remoteStream, q( "#video_container" ) );
    } );

    // when a local or a remote stream has been stopped
    BistriConference.streams.addHandler( "onStreamClosed", function ( stream ) {
        // remove the stream from the page
        BistriConference.detachStream( stream );
    } );

    // bind function "joinConference" to button "Join Conference Room"
    q( "#join" ).addEventListener( "click", joinConference );

    // bind function "quitConference" to button "Quit Conference Room"
    q( "#quit" ).addEventListener( "click", quitConference );

    // open a new session on the server
    BistriConference.connect();
}

// when button "Join Conference Room" has been clicked
function joinConference(){
    var roomToJoin = q( "#room_field" ).value;
    // if "Conference Name" field is not empty ...
    if( roomToJoin ){
        // ... join the room
        BistriConference.joinRoom( roomToJoin );
    }
    else{
        // otherwise, display an alert
        alert( "Room ID Empty!" )
    }
}

// when button "Quit Conference Room" has been clicked
function quitConference(){
    // quit the current conference room
    BistriConference.quitRoom( room );
}

function showPanel( id ){
    var panes = document.querySelectorAll( ".pane" );
    // for all nodes matching the query ".pane"
    for( var i=0, max=panes.length; i<max; i++ ){
        // hide all nodes except the one to show
        panes[ i ].style.display = panes[ i ].id == id ? "block" : "none";
    };
}

function q( query ){
    // return the DOM node matching the query
    return document.querySelector( query );
}
  </script>
  
    <script>
    const accordionItemHeaders = document.querySelectorAll(
	".accordion-item-header"
);

accordionItemHeaders.forEach((accordionItemHeader) => {
	accordionItemHeader.addEventListener("click", (event) => {
		const currentlyActiveAccordionItemHeader = document.querySelector(
			".accordion-item-header.active"
		);
		if (
			currentlyActiveAccordionItemHeader &&
			currentlyActiveAccordionItemHeader !== accordionItemHeader
		) {
			currentlyActiveAccordionItemHeader.classList.toggle("active");
			currentlyActiveAccordionItemHeader.nextElementSibling.style.maxHeight = 0;
		}

		accordionItemHeader.classList.toggle("active");
		const accordionItemBody = accordionItemHeader.nextElementSibling;
		if (accordionItemHeader.classList.contains("active")) {
			accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
		} else {
			accordionItemBody.style.maxHeight = 0;
		}
	});
});

    </script>
    <script>
        
        let left = document.querySelector('.left');
        let content = document.querySelector('.content');
        let protos = document.querySelectorAll('.proto');

        left.addEventListener('mousemove', (event) => {
            let move = (event.clientX * 0.05) + 4;
            let move2 = (event.clientX * 0.003);
            content.style.transform = `translateX(-${move2}%)`;

            protos.forEach((proto) => {
                proto.style.transform = `translateX(${move}%)`;
            })
        })
    </script>

</body>
</html>