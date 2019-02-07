<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background: url("../assets/img/slider/hospitalbg.jpg");
			height: 100%;
			background-repeat: no-repeat;
    		background-size: cover;
		}

		.button {
		    background-color: #4CAF50;
		    border: none;
		    color: white;
		    padding: 10px 10px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    font-size: 16px;
		    margin: 4px 2px;
		    cursor: pointer;
		}



		/*table css*/
		#customers {
		    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		    border-collapse: collapse;
		    width: 100%;
		}

		#customers td, #customers th {
		    border: 1px solid #ddd;
		    padding: 8px;

		}

		#customers tr:nth-child(even){background-color: #f2f2f2;}

		#customers tr:hover {background-color: #ddd;}

		#customers th {
		    padding-top: 12px;
		    padding-bottom: 12px;
		    text-align: left;
		    background-color: #4CAF50;
		    color: white;
		}
	</style>
</head>
<body>




	<table id="customers">

 <?php 

 	
	$username = "root";
	$password = "sagar";
	$servername = "localhost";
	$dbname = "test";
	
	$con = mysqli_connect($servername,$username,$password,$dbname) or die("\n Connection Failed ! " . $con->connect_error);
	$sql = "SELECT * FROM sos_hospital";
	$result = $con->query($sql);

	
   
  if ($result->num_rows > 0) {
	  echo "<tr>"; 
    
    echo "<th>Latitude</th>";
    echo "<th>Longitude</th>";
    echo "<th></th>";
  echo"</tr>";	
		while ($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<td align="center">'.$row["lat"].'</td>';
      echo '<td align="center">'.$row["lag"].'</td>';
      echo '<td align="center">'.'<form action="navigate.php" method="post" target="_blank"><input type="hidden" name="soslat" value="'.$row["lat"].'"><input type="hidden" name="soslag" value="'.$row["lag"].'"><button class="button" value="navigate" name="navigate">Navigate</button></form>'.'</td>';
      echo '</tr>';
    ?>
			
			


<?php		
}

	}
	else{?>
		<!-- <div  style="/*text-shadow: 0 0 7px #563af2;*/ background:#917bf2; border:5px solid blue; height: 12%; color: white;  width: 50%; overflow: hidden; margin:auto;position: absolute; top: 44%; left: 25%">

      <h1 align="center" style="font-weight: 20px; align-content: center;">EVERYTHING IS SAFE SO JUST RELAX</h1>
    </div> -->
 <?php
}

	if(isset($_POST['navigate'])){
		echo "here00";
		$truncate="truncate table sos_hospital";
		$res = $con->query($truncate);
	}

?>
</table>
</body>
</html>
 