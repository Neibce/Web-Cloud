<?php
session_start();
if (isset($_SESSION['user_ipadd'])) {
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>로그인 - Cloud</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>

  <link rel="stylesheet" href="css/nanumsquare.css" media="none" onload="if(media!='all')media='all'">
  <noscript><link rel="stylesheet" href="css/nanumsquare.css"></noscript>

  <style type="text/css">
    body {
      background: #EEE;
      background: url(./background.jpg) 0 0 repeat;
      background-position: 50%;
      min-width: 310px;
      font-family: "Roboto", "NanumSquare", "Noto Sans CJK KR";
    }
    .hidden{
      width:1px;
      height:1px;
      border:0;
    }
    #login-view {
      width: 350px;
      background-color: rgba(255, 255, 255, 0.8);
      z-index: 1;
      transition: all .3s ease-out;
    }
    .login-center {
      -ms-flex-align: center;
      -ms-flex-pack: center;
      -webkit-box-align: center;
      -webkit-box-pack: center;
      align-items: center;
      bottom: 0;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      justify-content: center;
      right: 0;
    }
    #login-blur {
      filter: blur(10px);
    }
    #title {
      font-size: 2rem;
    }
    #alert-error {
      display: none;
      margin: 10px 0 24px;
      padding: 12px 17px;
    }
    #submit-button {
      margin-top: 13px;
    }
    #footer {
      width: 350px;
      background-color: rgba(33, 33, 33, 0.8);
      position: relative;
      margin: 0 auto;
      z-index: 1;
    }
    #login-background {
      filter: blur(3px);
      background: url(../background.jpg) 0 0 repeat;
      background-position: 50%;
      width: 100%;
      height: 100%;
      background-size: cover;
      position: fixed;
      top: 0;
      z-index: 0;
    }
  </style>
  <script type="text/javascript">
   if(window.console!=undefined){
    setTimeout(console.log.bind(console,"%cCloud","font:4em Arial;color:#000;font-weight:bold"),0);
    setTimeout(console.log.bind(console,"%cCopyright © 2017 Yang-Jun-Young All rights reserved.","font:1em sans-serif;color:#000;"),0);
    setTimeout(console.log.bind(console,"%c이 서버는 개인적인 용도로 운영하는 서버입니다.","font:1.5em sans-serif;color:#FFAAAA;"),0);
  }
  var login = function() {
    return {
      success: function() {
        location.replace("index.php");
      },
      error: function() {
        $("#password").val('');
        grecaptcha.reset();
        $("#password").focus();
        enable_sbutton();
        $("#alert-error .white-text").text("비밀번호가 바르지 않습니다.");
        $("#alert-error").slideDown(300).delay(3000).slideUp(300);
      },
      captchaError: function() {
        $("#password").val('');
        grecaptcha.reset();
        $("#password").focus();
        enable_sbutton();
        $("#alert-error .white-text").text("자동입력방지란을 체크해주세요.");
        $("#alert-error").slideDown(300).delay(3000).slideUp(300);
      }
    }
  };
  function disable_sbutton(){
    $("#submit-button").html('<div class="progress"><div class="indeterminate"></div></div>');
  }
  function enable_sbutton(){
    $("#submit-button").html('<button class="btn waves-effect waves-light" type="submit" name="action">로그인</button>');
  }
  </script>
</head>
<body class="grey lighten-2">
  <iframe class="hidden" name="submit-form"></iframe>
  <div id="login-background">
    <div id="login-blur"></div>
  </div>
  <div class="login-center">
    <div id="login-view" class="card-panel">
      <center id="title" class="grey-text text-darken-2"><i class="material-icons" style="margin-right: 8px">cloud</i>Cloud</center>
      <div id="alert-error" class="card-panel pink">
        <span class="white-text">비밀번호가 바르지 않습니다.</span>
      </div>
      <form name="submit-login" action="check_login.php" method="POST" target="submit-form" onsubmit="disable_sbutton()">
        <div class="input-field">
          <input id="password" name="user_pw" type="password" autofocus required>
          <label for="password">비밀번호</label>
          <div class="g-recaptcha" data-sitekey="6Le_qzIUAAAAAMuPZlXvCuwpmvt8uV-anOeH5uVU"></div>
          <div id="submit-button"><button class="btn waves-effect waves-light" type="submit" name="action">로그인</button></div>
        </div>
      </form>
    </div>
  </div>
  <div id="footer" class="card-panel">
    <center class="white-text" style="font-size: 14.702px">
    이 서버는 개인적인 용도로 운영하는 서버입니다.
    Copyright &copy; 2017 Yang-Jun-Young<br>All rights reserved.<br>
    </center>
  </div>
  <script type="text/javascript">
    var url = location.href;
    var parameters = url.slice(url.indexOf('?') + 1, url.length);
    if(parameters == "logout")
      Materialize.toast("로그아웃 되었습니다.", 3000, 'rounded');
  </script>
</body>
</html>