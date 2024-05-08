<?php 
   // 폴더 전체용량 
  function get_dir_size($directory) {
      $size = 0;
      foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file) {
          $size += $file->getSize();
      }
      return formatBytes($size);
  }

   function formatBytes($bytes, $precision = 2) { 
      $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

      $bytes = max($bytes, 0); 
      $pow = floor(($bytes ? log($bytes) : 0) / log(1000)); 
      $pow = min($pow, count($units) - 1); 

      // Uncomment one of the following alternatives
      $bytes /= pow(1000, $pow);
      // $bytes /= (1 << (10 * $pow)); 

      return round($bytes, $precision) . $units[$pow]; 
  } 
  if(is_dir("./upload/" . $_GET['u'])){
    echo get_dir_size("./upload/" . $_GET['u']);
  }else{
    echo "ERR";
  }
?>