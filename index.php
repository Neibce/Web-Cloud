<?php
  session_start();
  if(!isset($_SESSION['user_ipadd'])){
  echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cloud</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="format-detection" content="telephone=no">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" media="none" onload="if(media!='all')media='all'">
  <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"></noscript>

  <link rel="stylesheet" href="css/nanumsquare.css" media="none" onload="if(media!='all')media='all'">
  <noscript><link rel="stylesheet" href="css/nanumsquare.css"></noscript>

  <style type="text/css">
    html, body {
      height: 100%;
      padding: 0;
      margin: 0;
    }
    body {
      background: #EEE;
      min-width: 345px;
      font-family: "NanumSquare", sans-serif;
    }
    .hidden{
      width:1px;
      height:1px;
      border:0;
      display: none;
    }
    .header {
      min-width: 345px;
      background-color: rgba(32, 32, 32, 0.74);
      z-index: 999;
      position: relative;
      top: 0;
    }
    .scrolled {
      position: fixed;
      z-index: 999;
      top: 0;
    }
    #nav-mobile a {
      background-color: transparent;
      box-shadow: none;
    }
    #nav-mobile a:hover{
      background-color: rgba(30, 30, 30, 0.2);
    }
    #logout {
      padding: 0 1rem;
      margin-left: 0px;
    }
    #cloud-background{
      filter: blur(3px);
      background: url(./background.jpg) 0 0 repeat;
      background-position: 50%;
      width: 100%;
      height: 100%;
      background-size: cover;
      position: fixed;
      top: 0;
      z-index: 0;
    }
    .container {
      height: calc(100% - 97px);
    }
    #filelist {
      height: 100%;
      position: relative;
      z-index: 998;
      margin-top: 13px;
      overflow: auto;
      padding: 0 7px;
      transition: .3s all ease-out;
    }
    .preloader-wrapper {
      margin-top: 20px;
    }
    .category {
      display: block;
      margin: 10px 0 10px 12px;
      color: #A0A0A0;
    }
    #folders, #files {
      width: 100%;
      display: inline-block;
    }
    .folder .card, .file .card{
      background-color: rgba(255, 255, 255, 0.74);
    }
    .folder .card, .file .card {
      margin: .25rem 0 .5rem 0;
      display: block;
      transition: background-color .3s ease-out;
    }
    .folder .card:hover, .file .card:hover {
      background-color: #F3F3F3;
    }
    .folder .card-content, .file .card-content {
      padding: 18px;
    }
    .folder .material-icons, .file .material-icons {
      margin-right: 8px;
    }
    .folder-name, .file-name {
      font-size: 15px;
      white-space: nowrap;
      text-overflow: ellipsis;
      display: block;
      overflow: hidden;
    }
    #alert-background .card {
      width: 500px;
      height: 200px;
      top: calc(50% - 100px);
      left: calc(50% - 250px);
    }
    #alert-background {
      display: none;
      z-index: 999;
      position: fixed;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.25);
    }
    #alert-title {
      margin-bottom: 20px;
    }
    .pointer {
      cursor: pointer;
    }
    #file-detail {
      width: 50%;
      height: 60px;
      right: 0;
      left: 0;
      margin: 0 auto;
      position: fixed;
      z-index: 998;
      min-width: 300px;
      color: #FFF;
      padding: 10px 24px;
      bottom: -60px;
      background-color: rgba(32, 32, 32, 0.74);
      transition: all .3s ease-out;
    }
    #file-info{
      width: calc(100% - 40px);
      display: flex;
    }
    #select-name {
      width: 100%;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      display: inline;
      font-size: 15.5px;
    }
    #select-size {
      font-size: 15.5px;
      float: right;
      margin: 0 10px;
    }
    #select-size .preloader-wrapper {
      height: 100%;
      margin: 0;
    }
    #select-more {
      position: relative;
      right: 0;
      bottom: 0;
      padding-top: 0;
      margin-bottom: 0;
      z-index: none;
    }
    #select-more ul{
      left: unset;
      right: unset;
    }
    @media only screen and (max-width: 513px){
      .folder, .file {
        width: 50% !important;
      }
    }

    @media only screen and (max-width: 601px){
      .folder, .file {
        padding: 0 .35rem !important;
      }
    }
    @media only screen and (min-width: 601px){
      .folder, .file {
        width: 33.3333333333% !important;
        padding: 0 .45rem !important;
      }
    }
    @media only screen and (min-width: 1029px){
      .folder, .file {
        width: 25% !important;
      }
    }
    @media only screen and (min-width: 1400px){
      .folder, .file {
        width: 20% !important;
      }
    }
    ::-webkit-scrollbar {
      width: 6px;
    }
    ::-webkit-scrollbar-thumb {
      background-color: rgba(0, 0, 0, 0.2);
    }
  }
  </style>
  <script type="text/javascript">
    var loca = "";
    var load_html = '<div id="file-header"><span id="number-folder-file" class="white-text">폴더 수: &nbsp;&nbsp;파일 수: </span><span class="white-text hide-on-small-only right">COPYRIGHT © 2017-2018 YANG JUN-YOUNG ALL RIGHTS RESERVED.</span><hr></div><div class="center-align"><div class="preloader-wrapper small active"><div class="spinner-layer spinner-blue-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div></div>';

    function file_list_reload(url){
      file_detail_hide();
      $("#filelist").html(load_html);
      if(url){
        url = encodeURIComponent(url) + "/";
        if(url == "../"){
          var loca_bfold = loca.lastIndexOf("/", loca.length-2);
          if(loca_bfold > 0){
            var loca_slice = loca.slice(0, loca_bfold);
            url = loca_slice + "/";
            $("#filelist").load('file_viewer.php?u=' + url);
            loca = url;
          }
          else {
            $("#filelist").load('file_viewer.php');
            loca = "";
          }
        }else{
          $("#filelist").load('file_viewer.php?u=' + loca + url);
          loca += url;
        }
      }else{
        $("#filelist").load('file_viewer.php');
        loca = "";
      }
    }
    function file_list_refresh(){
      file_detail_hide();
      $("#filelist").html(load_html);
      $("#filelist").load('file_viewer.php?u=' + loca);
    }
    function file_detail(filename){
      if($("#select-more").hasClass("active"))
        $("#select-more").closeFAB();
      $("#select-name").text(filename);
      $("#select-size").html('<div class="preloader-wrapper small active"><div class="spinner-layer spinner-red-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>');
      $('#select-size .preloader-wrapper').width($('#select-size .preloader-wrapper').height());
      $("#select-size").load("file_size.php?u=" + loca + encodeURI(filename));
      $("#share-btn").attr("onClick", "alert(get_file_download_lnk(\"" + filename + "\"));");
      $("#download-btn").attr("onClick", "file_download(\"" + filename + "\");");
      $("#delete-btn").attr("onClick", "file_delete(\"" + filename + "\");");
      $("#filelist").height("calc(100% - 45px)");
      $("#file-detail").css("bottom", 0);
    }
    function file_detail_hide() {
      if($("#select-more").hasClass("active"))
        $("#select-more").closeFAB();
      if(sel_before){
        $(sel_before).find('.card').css("backgroundColor", "");
        $(sel_before).find('.card').css("color", "");
      }
      $("#file-detail").css("bottom", "");
      $("#filelist").height("");
    }
    function get_file_download_lnk(filename){
      return window.location.protocol + "//" + window.location.hostname + "/" + loca + encodeURI(filename);
    }
    function file_download(filename){
      $("#ifrm").attr("src", "file_download.php?u=" + loca + encodeURI(filename));
    }
    function file_delete(filename){
      $("#ifrm").attr("src", "file_delete.php?u=" + loca + encodeURI(filename));
      file_list_refresh();
    }
    function create_newfolder(){
      var newname = $("#newfolder_name").val();
      if(newname.match('/\//')){
        alert('error');
        return ;
      }
      $("#newfolder_name").val("");
      $("#newfolder_name").focusout();
      $("#newfolder_name").removeClass("active");
      $("#ifrm").attr("src", "create_folder.php?u=" + loca + newname);
      $("#ifrm").on("load", function(){
        $("#alert-background").fadeOut(300);
        Materialize.toast("'" + newname + "' 폴더가 정상적으로 생성되었습니다.", 3000, 'rounded');
        file_list_refresh();
      });
    }
  </script>
</head>
<body>
  <iframe id="ifrm" class="hidden"></iframe>
  <nav class="header col s2">
    <div class="nav-wrapper" style="width: 70%; margin: 0 auto">
      <a href="#" class="brand-logo"><i class="material-icons">cloud</i>Cloud</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="#" id="btn-newfolder" class="btn-floating btn-small waves-effect waves-dark"><i class="material-icons">create_new_folder</i></a></li>
        <li><a id="logout" class="btn btn-small waves-effect waves-dark" onclick="location.replace('logout.php')"><?php echo $_SESSION['user_ipadd']?></a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div id="filelist" class="row">
      <div id="file-header">
        <span id="number-folder-file" class="white-text">폴더 수: &nbsp;&nbsp;파일 수: </span>
        <span class="white-text hide-on-small-only right">© 2017-2018 Yang Jun-Young</span>
        <hr>
      </div>
      <div class="center-align">
        <div class="preloader-wrapper small active">
          <div class="spinner-layer spinner-blue-only">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div><div class="gap-patch">
              <div class="circle"></div>
            </div><div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="alert-background">
    <div id="alert" class="card">
      <div class="card-content">
        <span id="alert-title" class="card-title grey-text text-darken-4">새 폴더 생성
        <span id="alert-close" class="material-icons right pointer">close</span></span>
        <div class="input-field">
          <input id="newfolder_name" type="text" onkeypress="if(event.keyCode == 13) create_newfolder();" required>
          <label for="newfolder_name">새 폴더 이름</label>
        </div>
        <p class="right-align">
          <a onclick="create_newfolder();" class="waves-effect waves-light btn">생성</a>
        </p>
      </div>
    </div>
  </div>
  <div id="file-detail" class="card-panel valign-wrapper">
    <div id="file-info">
      <i class="material-icons left" style="cursor: pointer" onclick="file_detail_hide()">close</i>
      <span id="select-name">I'm a file.imaf</span>
      <span id="select-size" class="hide-on-small-only"></span>
    </div>
    <div id="select-more" class="fixed-action-btn vertical click-to-toggle right">
      <a class="btn-floating waves-effect waves-light btn-small red">
        <i class="material-icons">more_horiz</i>
      </a>
      <ul>
        <li><a id="share-btn" class="btn-floating yellow darken-1"><i class="material-icons">edit</i></a></li>
        <li><a id="delete-btn" class="btn-floating waves-effect green"><i class="material-icons">delete_forever</i></a></li>
        <li><a id="download-btn" class="btn-floating waves-effect waves-light blue"><i class="material-icons">file_download</i></a></li>
      </ul>
    </div>
  </div>
  <div id="cloud-background"></div>
  <script type="text/javascript">
    $("#filelist").load('file_viewer.php');
    $("#select-more").click(function(){
      event.stopPropagation();
      if(!$(this).hasClass("active"))
        $(this).openFAB();
      else
        $(this).closeFAB();
    });
    $("#btn-newfolder").click(function(){
      $("#alert-background").fadeIn(300);
    });
    $("#alert-background").click(function(){
      $("#alert-background").fadeOut(300);
    });
    $("#alert-close").click(function(){
      $("#alert-background").fadeOut(300);
    });
    $("#alert").click(function(){
      event.stopPropagation();
    });
    $("#file-detail").click(function(){
      event.stopPropagation();
      if($("#select-more").hasClass("active"))
        $("#select-more").closeFAB();
    });
  </script>
</body>
</html>
