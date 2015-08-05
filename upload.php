<?php
	
	if(isset($_GET['image_holder'])){
		$_SESSION[getImageHolder()] = "";
		setImageHolder($_GET['image_holder']);
		
	}else{ echo $_GET['image_holder'] = getImageHolder(); }
		
	if(session_status()==1){session_start();}
	
	if($_GET['image_holder'] != ""){}

	if(isset($_POST['upload_file'])){
		$filename = $_FILES['attached_file']['name'];
		$tmp_name= $_FILES['attached_file']['tmp_name'];
		
		$destination = 'uploads/images/'.$filename;
		
		if(move_uploaded_file($tmp_name, $destination)){
			$old_images = "";
			
			if(isset($_SESSION[getImageHolder()])){
				$old_images = $_SESSION[getImageHolder()];
			}
			
			$_SESSION[getImageHolder()] = $old_images.",".$destination;
			
			echo "<hr />".$_SESSION[getImageHolder()]."<hr />";
		}
	}
	
	
	function setImageHolder($image_holder){
		$filename = "uploads/images/image_uploads_holder.txt";
		$filehandle = fopen($filename, "w");
		$write = fwrite($filehandle, $image_holder);
		fclose($filehandle);
		
	}
	
	function getImageHolder(){
		$filename = "uploads/images/image_uploads_holder.txt";
		$filehandle = fopen($filename, "r");
		return fread($filehandle, filesize($filename));
	}
?>
<html>

	<form action="upload.php" method="post" enctype="multipart/form-data">
	
		<input name="attached_file" type="file"/>
		<input name="upload_file" type="submit"/>
	
	</form>
</html>
