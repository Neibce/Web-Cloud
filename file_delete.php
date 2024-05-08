<?php 
	if(is_file("./upload/" . $_GET['u'])){
		unlink("./upload/" . $_GET['u']);
	}
	else{
		echo '<script>alert("파일이 존재하지 않습니다.")</script>';
	}
?>