<?php
include("common/connect.php");

	 $query= mysqli_query($con,"SELECT * FROM `geo_locations` WHERE `location_type` = 'State'");
                                                    while($b = mysqli_fetch_assoc($query))
                                                    { 
                                                    ?>
                                     
                                      <option value=<?php echo $b['id']; ?>  > <?php echo $b['name']; ?></option>   <?php 
                                                    }
                                                    ?> 
		
	

