
<?php


  $query = "SELECT * FROM users ORDER BY id asc";
     $result = mysqli_query($con,$query);
     $user_arr = array();
	  while($row = mysqli_fetch_array($result)){
		  
	  $user_arr[] = array($id,$uname,$name,$gender,$email);
	    }
		 $serialize_user_arr = serialize($user_arr);
		 
		 
		 $filename = 'users.csv';
		$export_data = unserialize($serialize_user_arr);

// file creation
		$file = fopen($filename,"w");

foreach ($export_data as $line){
 fputcsv($file,$line);
}

fclose($file);

// download
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$filename);
header("Content-Type: application/csv; "); 

readfile($filename);

// deleting file
unlink($filename);
exit();
		 
		 
?>