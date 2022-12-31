<!--
    Author: W3layouts
    Author URL: http://w3layouts.com
    License: Creative Commons Attribution 3.0 Unported
    License URL: http://creativecommons.org/licenses/by/3.0/
    -->
    <?php 
session_start();
if(!isset($_SESSION['Admin']))
{
	header("location:index.php");
}
include('databaseconnection.php');
if(isset($_POST['Upload']))
{
		  $yogacenter = $_FILES['yogacenter']['tmp_name'];
          $handle = fopen($yogacenter, "r");
          $c = 0;
          while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
          {
						  $Name = $filesop[0];
						  $Address = $filesop[1];
						  $Type = $filesop[2];
						  $Lat = $filesop[3];
						  $Lon = $filesop[4];
						  $Phone = $filesop[5];                          
						  $PinCode = $filesop[6];
              $Rating = $filesop[7];					  
              
              $check = "SELECT * FROM yogacenter WHERE Name='$Name' AND Lat='$Lat' AND Lon='$Lon'";
              $checkRes = $conn->query($check);
              if($checkRes->num_rows > 0)
              {              
                  echo '<script>alert("Failed to add Details!! the Details already exists")</script>';
              }
              else
              {
                $sql = "INSERT INTO yogacenter(Name, Address, Type, Lat, Lon, Phone,PinCode,Rating) VALUES('$Name','$Address','$Type','$Lat','$Lon','$Phone','$PinCode','$Rating')";
  						  $res = $conn->query($sql);
              }
						  
						 $c = $c + 1;
				} 
				if($res)
				{
					echo '<script>alert("Successfully Add to Database")</script>';	
				}	 
				else
				{
					echo '<script>alert("Failed to add Details!!")</script>';
				}
							
}
if(isset($_POST['Submit']))
{
		 $Name=$_POST['Name'];
		 $Address=$_POST['Address'];
		 $Type=$_POST['Type'];
		 $Lat=$_POST['Lat'];
		 $Lon=$_POST['Lon'];
		 $Phone=$_POST['Phone'];
		 $PinCode=$_POST['PinCode'];
		 $Rating=$_POST['Rating'];
              
              $check = "SELECT * FROM yogacenter WHERE Name='$Name' AND Lat='$Lat' AND Lon='$Lon'";
              $checkRes = $conn->query($check);
              if($checkRes->num_rows > 0)
              {              
				if($CheckRow = $checkRes->fetch_assoc())
				{
					if($CheckRow['Name'] == $Name && $CheckRow['Lat']== $Lat && $CheckRow['Lon'] ==$Lon)
					{
						echo '<script>alert("Failed to add Details!! the Details already exists");</script>';
					}
				}
			  }
              else
              {
                $sql = "INSERT INTO yogacenter(Name, Address, Type, Lat, Lon, Phone,PinCode, Rating) VALUES ('$Name', '$Address', '$Type', '$Lat', '$Lon', '$Phone','$PinCode', '$Rating')";
        				$res = $conn->query($sql);
              if($res == true)
                  {
                    echo '<script>alert("Successfully Add to Database");</script>';	
                  }	 
                else
                  {
                    echo '<script>alert("Failed to add Details!!");</script>';
                  }
        }
						  
						 
} 
				
							

?>
    <!DOCTYPE HTML>
    <html>
    <head>
    <title>Cultural Heritage Mysuru City - TIS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/slider.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    </head>
    <body>
    <div class="header">
    <div class="wrap">
    <div class="logo"><a href="index.html"><img src="images/logo.png" alt="" /></a></div>
     <div class="con-right">
                <div class="grid1-l-img">
                    <img src="images/contact.png" alt="">
                </div>
               
                <div class="clear"></div>
        </div>
        <div class="clear"></div>
         </div> 
    </div>
    <div class="header-bottom">
    	<div class="wrap">
    		<ul id="nav">
                <li><a href="adminDashboard.php">Admin adminDashboard</a></li>
                
				<li><a class="hsubs" href="#">Destinations</a>
				 <ul class="subs">
                        <li><a href="adminTouristPlaces.php">Tourist Places</a></li>
                        <li><a href="adminHeritageBuildings.php">Heritage Buildings</a></li>
                        <li><a href="adminYogaCenter.php">Yoga Centers</a></li>
                    </ul>
				</li>	
				<li><a class="hsubs" href="#">Accommodations</a>
				 <ul class="subs">
                        <li><a href="adminHotel.php">Hotels</a></li>
                        <li><a href="adminRestaurant.php">Restaurants</a></li>
                        <li><a href="adminHomeStay.php">Home Stays</a></li>
                    </ul>
				</li>	
               
                <li><a href="logout.php">logout</a></li>
        </ul>
       </div>
</div>
    <div class="contact">
        <div class="wrap">
        <div class="container-fluid">

    
        <main class="col-md-12">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Upload Yoga Center Data File</h1>            
          </div>
          <form action="adminYogaCenter.php" method="post" enctype = "multipart/form-data">               
                <div class="form-floating">
                  <input type="file" class="form-control" name="yogacenter" required>              
                </div>     
                </br>           
                <input name="Upload" class="w-100 btn btn-sm btn-primary" style="background-color:#a23853;" type="submit" value="Upload">
           </form>
    <hr>
		  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Upload Yoga Center Details</h1>            
          </div>
			<form action="adminYogaCenter.php" method="post" enctype = "multipart/form-data">               
				<div class="row">
					<div class="col-lg-6">
						<input type="text" name="name" class="form-control" placeholder="Yoga Center Name" required>
					</div>					
					<div class="col-lg-6">
						<input type="text" name="type" class="form-control" placeholder="Type" required>
					</div>
				</div>
				<hr>	
				<div class="row">
					<div class="col-lg-6">
						<input type="text" name="lat" class="form-control" placeholder="Latitude" required>
					</div>					
					<div class="col-lg-6">
						<input type="text" name="longi" class="form-control" placeholder="Longitude" required>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-4">	
						<input type="text" name="phone" class="form-control" placeholder="Phone" required>
					</div>		
									
					<div class="col-lg-4">	
						<input type="text" name="postalCode" class="form-control" placeholder="Postal Code" required>
					</div>
						
					<div class="col-lg-4">	
						<input type="text" name="rating" class="form-control" placeholder="Rating" required>
					</div>						
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<textarea type="text" rows="4" name="address" class="form-control" placeholder="Address" required></textarea>
					</div>
				</div>
				</br>
				<div class="row">
					<div class="col-lg-12 text-center">
						<input type="submit" class=" form-control btn btn-success" style="background-color:#a23853;" name="Submit" value="Submit">
					</div>
				</div>
			</form>
          <h2>Yoga Center Data Details</h2>
          <div class="table-responsive">
            <table class="table table-bordered table-sm">
              <thead>
                <tr>
                  <th scope="col">Sl No</th>
                  <th scope="col">Name</th>
                  <th scope="col">Address</th>
                  <th scope="col">Type</th>
                  <th scope="col">Postal Code</th>                  
                  <th scope="col">Phone number </th>
                  <th scope="col">Rating </th>
                </tr>
              </thead>
              <tbody>
                <?php 
                 $dataretrieval = "SELECT * FROM yogacenter";
                 $result=$conn->query($dataretrieval);
                 if($result->num_rows > 0)
                 {
                   while($dataRows=$result->fetch_assoc())
                   {
                    echo "<tr>";
                    echo "<td>".$dataRows['ID']."</td>";
                    $YogaCenterID= $dataRows['ID'];
                    echo "<td>".$dataRows['Name']."</td>";
                    echo "<td>".$dataRows['Address']."</td>";                    
                    echo "<td>".$dataRows['Type']."</td>";
                    echo "<td>".$dataRows['PinCode']."</td>"; 
                    echo "<td>".$dataRows['Phone']."</td>"; 
                    echo "<td>".$dataRows['Rating']."</td>"; 
                    echo "<td><a class='btn btn-danger' href='Datadelete.php?q=". $YogaCenterID."&r=YogaCenter'>delete</a></td>"; 
                    echo "</tr>";
                   }
                 }  
                 else
                 {
                     echo "<tr><td colspan='7'>No Data Found</td></tr>";
                 }              
                ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
                </div>
</br>
    </div>
    <div class="footer-bottom">
    <div class="wrap">	
        <div class="copy">
           <p> Centre for Geoinformatics Technology, Department of Geography, University of Mysore &copy; 2016 All rights Reserved | Project by <a href="mailto:tourisminformationsystemmys@gmail.com">Manjunatha R</a></p>
	</div>
     </div>
    </div>
    </body>
    </html>
