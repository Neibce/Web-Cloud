<?php
session_start();
if (!isset($_SESSION['user_ipadd'])) {
    echo "로그인이 필요한 기능입니다.";
    exit;
}
/*$diskspace = shell_exec("df -h");
preg_match("/\/dev\/block\/mmcblk0p21(.*)/", $diskspace, $diskspace);
$diskspace = preg_replace("/\/dev\/block\/mmcblk0p21 (.*) \/data/", "$1", $diskspace[0]);
$diskspace = explode('  ', $diskspace);*/
if (isset($_GET['u']) && $_GET['u'] != "") {
    if (strpos("..", $_GET['u'])!==false) {
        echo "You can't beat me.";
        exit;
    }
}
$path = "./upload/{$_GET['u']}"; // 오픈하고자 하는 폴더
if (!is_dir($path)) {
    echo "404 Folder Not Found.\n폴더가 삭제되었거나 존재하지 않습니다.";
    exit;
}
$entrys = array(); // 폴더내의 정보를 저장하기 위한 배열
$dirs = dir($path); // 오픈하기
while (false !== ($entry = $dirs->read())) { // 읽기
    if (($entry != '.') && ($entry != '..')) {
        if (is_dir($path.'/'.$entry)) { // 폴더이면
            $entrys['dir'][] = $entry;
        }
        else { // 파일이면
              $entrys['file'][] = $entry; 
        }
    }
}
$dirs->close(); // 닫기

$dircnt = count($entrys['dir']); // 폴더 수 
$filecnt = count($entrys['file']); // 파일 수

echo "<div id=\"scroll\">";//<span>메인 > {$_GET['u']}&nbsp;</span>
echo "<div id=\"file-header\"><span id=\"number-folder-file\" class=\"white-text\">폴더 수: ${dircnt}&nbsp;&nbsp;파일 수: ${filecnt}</span><span class=\"white-text hide-on-small-only right\">COPYRIGHT © 2017-2018 YANG JUN-YOUNG ALL RIGHTS RESERVED.</span><hr></div>";
//<div id=\"diskspace\">전체: $diskspace[0], 사용중: $diskspace[1], 남음: $diskspace[2] ($diskspace[3])</div>
/*echo "
<div class=\"progress indigo lighten-3\">
  <div class=\"determinate indigo\" style=\"width: $diskspace[3]\"></div>
</div>\n";*/
echo "<div id=\"filelist-view\">";
echo "<div id=\"folders\">";
echo "<span class=\"category white-text\">폴더</span>"; //폴더 표시 시작
if ($path != "./upload/") {
    echo "
        <div class=\"col s4 folder\">
          <div class=\"card waves-effect\">
            <div class=\"card-content\">
              <i class=\"material-icons left\">reply</i>
               <span class=\"folder-name\">..</span>
            </div>
          </div>
        </div>";
}
if ($dircnt != 0) {
    sort($entrys['dir']); //가나다라 순 정렬
    foreach ($entrys['dir'] as $value) {
        echo "
        <div class=\"col s4 folder\">
          <div class=\"card waves-effect\">
            <div class=\"card-content\">
              <i class=\"material-icons left\">folder_open</i>
              <span class=\"folder-name \">$value</span>
            </div>
          </div>
        </div>";
    }
    echo "</div>";
}
if ($filecnt != 0) {
    echo "<div id=\"files\">";
    sort($entrys['file']); //가나다라 순 정렬
    echo "<span class=\"category white-text\">파일</span>"; //파일 표시 시작
    foreach ($entrys['file'] as $value) {
       $ext = strrpos($value,".");
       $ext = substr($value, $ext + 1);
       switch ($ext) {
         case 'mp3':
         case 'wmv':
         case 'ogg':
         case 'flac':
          $ext = "music_note";
          break;
         case 'jpg':
         case 'png':
         case 'gif':
          $ext = "image";
          break;
         default:
          $ext = "insert_drive_file";
          break;
       }
       echo "
       <div class=\"col s4 file\">
         <div class=\"card waves-effect\">
           <div class=\"card-content\">
             <i class=\"material-icons left\">$ext</i>
             <span class=\"file-name\">$value</span>
           </div>
         </div>
       </div>";
     }
     echo "</div>";
  }
  echo "</div>";
  echo "</div>";
  echo "</div>";
?>
<script type="text/javascript">
  $(".folder").dblclick(function(){
    file_list_reload($(this).find('.folder-name').text());
  });
  var sel_before;
  $(".file").click(function(){
    event.stopPropagation();
    if(sel_before){
      $(sel_before).find('.card').css("backgroundColor", "");
      $(sel_before).find('.card').css("color", "");
    }
    $(this).find('.card').css("backgroundColor", "rgba(32, 32, 32, 0.74)");
    $(this).find('.card').css("color", "#FFF");
    file_detail($(this).find(".file-name").text());
    sel_before = this;
  });
  $(".file").dblclick(function(){
    file_download($(this).find('.file-name').text());
  });
  $(".folder").click(function(){
    event.stopPropagation();
  });
  $(".header").click(function(){
    event.stopPropagation();
  });
  $("body").click(function(){
    event.stopPropagation();
    file_detail_hide();
  });
  $("#file-detail").click(function(){
    event.stopPropagation();
  });
</script>
<script type="text/javascript">
  function F_FileMultiUpload(files, obj) {
    if(confirm(files.length + "개의 파일을 업로드 하시겠습니까?") ) {
      var data = new FormData();
      for (var i = 0; i < files.length; i++) {
        data.append('file', files[i]);
      }

      $.ajax({
        url: 'file_upload.php',
        method: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(res) {
          F_FileMultiUpload_Callback(res.files);
        }
      });
    }
  }
  function F_FileMultiUpload_Callback(files) {
    for(var i=0; i < files.length; i++)
    console.log(files[i].file_nm + " - " + files[i].file_size);
  }


  var flist = document.getElementsByTagName("BODY")[0];
  var cbg = document.getElementById('cloud-background');
  function fdOver(e){
      e.stopPropagation();
      e.preventDefault();
    if (e.type == "dragover"){
      // 파일 올림
      cbg.style.background = 'rgba(255, 255, 255, 0.3)';
    }
    else {
      // 파일 놓음 [원상복구]
      cbg.style.background = 'url(../background.jpg) 0 0 repeat';
    }
  }

  function fdUpload(e){
    e.stopPropagation();
    e.preventDefault();
    fdOver(e); // (e.type != "dragover") 캔슬을위해 [여기서 별도로 작업해줘도 상관없음]
   
    var files = e.target.files || e.dataTransfer.files;
   
    for (var i = 0 ; i < files.length ; i++) {
      list.innerHTML = list.innerHTML + (files[i].name).replace(/\<\>/g, '') + '<br/>'
    }
  }

  flist.addEventListener("dragover", fdOver, false);
  flist.addEventListener("dragleave", fdOver, false);
  flist.addEventListener("drop", fdUpload, false);
</script>