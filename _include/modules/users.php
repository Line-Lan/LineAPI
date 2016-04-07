<?php
openSql();
switch ($q[1]) {
	case NULL:
	//	/api/users/
		$result = $sql -> query('Select username from users', MYSQLI_USE_RESULT);
		while($row = $result->fetch_assoc()){
   		echo $row['username'].' <br/>';
		}
		break;
	default:
	//	/api/users/x
		switch ($q[2]) {
			case NULL:
				$result = $sql -> query('Select username from users where userid='.$q[1], MYSQLI_USE_RESULT);
				while($row = $result->fetch_assoc()){
   				echo $row['username'];
				}
				break 2;
			case "rig":
			//	/api/users/x/rig/
				$result = $sql -> query('Select comp_proc, comp_proc_spd, comp_proc_type, comp_mem, comp_mem_type, comp_hdstorage, comp_gfx_gpu, comp_gfx_type from users where userid='.$q[1], MYSQLI_USE_RESULT);
				switch($q[3]) {
					case NULL:
						while($row = $result->fetch_assoc()){
   						echo $row['comp_proc']." ";
   						echo $row['comp_proc_type']." ";
							if ($row['comp_proc_spd'] != NULL) {echo ('@');}
 							echo $row['comp_proc_spd'];
							if ($row['comp_proc_spd'] != NULL) {echo (' Mhz');}
							echo ('<br/>');
   						echo $row['comp_mem'];
							if ($row['comp_hdstorage'] != NULL) {echo (' GB ');}
   						echo $row['comp_mem_type'].'<br/>';
   						echo $row['comp_gfx_gpu']." ";
   						echo $row['comp_gfx_type'].'<br/>';
   						echo $row['comp_hdstorage'];
							if ($row['comp_hdstorage'] != NULL) {echo (' GB');}		
						}
						break;
					case "raw":
						while($row = $result->fetch_assoc()){
							echo $row['comp_proc'].",";
							echo $row['comp_proc_type'].",";
  							echo $row['comp_proc_spd'].",";
   						echo $row['comp_mem'].",";
   						echo $row['comp_mem_type'].",";
   						echo $row['comp_gfx_gpu'].",";
   						echo $row['comp_gfx_type'].",";
   						echo $row['comp_hdstorage'];	
						}
						break;
					default:
						giveError();
					}
					break;
			case "name":
			//	/api/users/x/name/
				$result = $sql -> query('Select first_name, last_name from users where userid='.$q[1], MYSQLI_USE_RESULT);
				while($row = $result->fetch_assoc()){
   				echo $row['first_name']." ";
   				echo $row['last_name'];	
				}
				break;

			case "benchmarks":
			// /api/users/x/benchmarks
				$result = $sql -> query('SELECT userid, benchid, benchmarks.id, name, value FROM benchmarks, users_benchmarks WHERE userid='.$q[1].' and  benchid = benchmarks.id', MYSQLI_USE_RESULT);
				switch($q[3]) {
					case NULL:							
						while($row = $result->fetch_assoc()){
							echo $row['name']." ";
   						echo $row['value'].'<br/>';
						}
						break;
					case "raw":
					// /api/users/x/benchmarks/raw
						while($row = $result->fetch_assoc()){
   						echo $row['name'].",";
   						echo $row['value'].",";
							}
						break;
					default:
						giveError();
					}
				break;
			case "quote":
				$result = $sql -> query('Select quote from users where userid='.$q[1], MYSQLI_USE_RESULT);
				while($row = $result->fetch_assoc()){
   				echo $row['quote'];
				}
				break;
			case "clan":
				$result = $sql -> query('Select gaming_group from users where userid='.$q[1], MYSQLI_USE_RESULT);
				while($row = $result->fetch_assoc()){
   				echo $row['gaming_group'];
				}
				break;
			default:
			//	/api/users/x/y
				giveError();
		break;
	}
}
