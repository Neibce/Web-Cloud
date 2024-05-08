<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" media="none" onload="if(media!='all')media='all'">
  <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"></noscript>

  <link rel="stylesheet" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css" media="none" onload="if(media!='all')media='all'">
  <noscript><link rel="stylesheet" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css"></noscript>
  <style type="text/css">
    html, body {
      height: 100%
    }
    .card {
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
    .pointer {
      cursor: pointer;
    }
  </style>
</head>
<body>
  <a id="btn-1" class="waves-effect waves-light btn">button</a>
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus semper, nisl non fringilla pharetra, massa ipsum fermentum quam, in vestibulum erat dolor vitae ligula. Mauris congue eget mauris sed ultricies. Suspendisse vitae consectetur felis. Fusce lobortis a leo in imperdiet. In tempor interdum sapien id tempus. Etiam euismod orci et massa commodo, et consequat eros commodo. Donec blandit nisl leo, vel blandit est vehicula eget. In tempor eleifend eros, a efficitur nulla vestibulum ac. Integer in ex eu erat faucibus efficitur. Sed interdum eros magna, sit amet congue nisl ullamcorper cursus. Vestibulum nec leo quam. Donec eget augue aliquet, sollicitudin metus eu, molestie nulla. Donec vel erat id urna scelerisque sagittis. Morbi pulvinar dui eu mollis malesuada. Aliquam id lorem sapien. Nullam euismod, ipsum dapibus euismod dignissim, mi tellus ultrices tellus, eu lacinia urna lacus id tellus.
  <div id="alert-background">
    <div id="alert" class="card">
      <div class="card-content">
        <span id="alert-title" class="card-title grey-text text-darken-4">새 폴더 생성<span class="material-icons right pointer">close</span></span>
        <div class="input-field">
  	      <input id="last_name" type="text">
  	      <label for="last_name">새 폴더 이름</label>
  	    </div>
        <p class="right-align"><a href="#" class="waves-effect waves-light btn">생성</a></p>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $("#btn-1").click(function(){
      $("#alert-background").fadeIn(300);
    });
    $("#alert-background").click(function(){
    	$("#alert-background").fadeOut(300);
    });
    $("#alert").click(function(){
	    event.stopPropagation();
	  });
  </script>
</body>
</html>