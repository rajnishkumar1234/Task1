
<html>
       <head>
               <title>Upload Csv File</title>
       </head>
       <body bgcolor="yellow" >
       	<br><br><br><br><br><br>
       	<center><h1><marquee behavior="alternate">Upload CSV File</h1></marquee></center>
       	         <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                         <div align="center">
                                  <p>Select CSV file: <input type="file" name="file"  required/></p>
                                  
                                  <p><input type="submit" name="csv_upload_btn" value="Upload"  /></p>
                         </div>
                </form>
       </body>
</html>
<?php
//Create Connection
$connection = mysqli_connect("localhost", "root", "", "testCSV");

// Check Connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

//Process form
if(isset($_POST["csv_upload_btn"])){
if($_FILES['file']['name']){
$filename = explode(".",$_FILES['file']['name']);
if($filename[1] == "csv"){
$handle = fopen($_FILES['file']['tmp_name'], "r");
while($data = fgetcsv($handle)){
$item1 = mysqli_real_escape_string($connection, $data[0]);
$item2 = mysqli_real_escape_string($connection, $data[1]);

$query = " INSERT INTO users(name, image URL) VALUES('$item1', '$item2') ";
$run_query = mysqli_query($connection, $query);
}
fclose($handle);
if($run_query == true){
echo "File Import Successful";
}else{
echo "File Import Failed";
}
}
}
}

//Close Connection
mysqli_close($connection);
?>
 