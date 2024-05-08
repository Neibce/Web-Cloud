<?php 
   // 폴더 전체용량 
  function get_file_size($file) {
    $size = filesize($file);
    if($size<0){
      return '>2GB';
    }
    return formatBytes($size);
  }

  function formatBytes($bytes, $precision = 2) { 
      $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

      $bytes = max($bytes, 0); 
      $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
      $pow = min($pow, count($units) - 1); 

      // Uncomment one of the following alternatives
      $bytes /= pow(1024, $pow);
      // $bytes /= (1 << (10 * $pow)); 

      return round($bytes, $precision) . $units[$pow]; 
  } 

  if(is_file("./upload/" . $_GET['u'])){
    echo get_file_size("./upload/" . $_GET['u']);
  }else{
    echo "ERR";
  }
?>