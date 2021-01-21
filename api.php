<?php
// TWO // is just comments, this makes sure normal comments aren't treated as code


////////////////////ERROR REPORTING////////////////////////////////
error_reporting(E_ALL ^ E_NOTICE);

////////////////////DATABASE CONFIG////////////////////////////////

// ADD THE DATABASE NAME, USERNAME AND PASSWORD YOU SELECTED IN THE DATABASE WIZARD HERE
$db_host = 'localhost';
$db_user = 'netapgyn_root';
$db_pass = 'wrOoOnKkZLAZ';
$db_database = 'netapgyn_data';
$db_table = 'api_data';

$dsn = "mysql:host=$db_host;dbname=$db_database";
$db_connection = new PDO($dsn, $db_user, $db_pass);


////////////////////GATHER THE VARIABLES FROM THE URL////////////////////////////////

// ADD ALL THE COLUMN NAMES YOU CREATED IN THE TABLE HERE ONE BY ONE IN THE SAME FORMAT
$type = $_GET['type'];
$name = $_GET['name'];
$count = $_GET['count'];

//$variable = $_GET['columnname'];
//datetime is not needed here because of its default now() value.


////////////////////IF THE TYPE IS GET////////////////////////////////
if ($type == "GET")
{
$query = "SELECT * FROM $db_table";

	////////////////////IF NONE IS CALLES////////////////////////////////
  	if (!isset($name) && !isset($count)) 	{$query = "SELECT * FROM $db_table";  }
	////////////////////IF ONLY NAME IS CALLED////////////////////////////////
  	else if (isset($name) && !isset($count)) {$query = "SELECT * FROM $db_table WHERE name='$name'";}
	////////////////////IF ONLY COUNT IS CALLED////////////////////////////////
    else if (isset($count) && !isset($name)) {$query = "SELECT * FROM $db_table WHERE count='$count'";;}
  	////////////////////IF NAME AND COUNT IS CALLED////////////////////////////////
  	else if (isset($name) && isset($count))  	{$query = "SELECT * FROM $db_table WHERE name='$name' AND count='$count'";}
  	////////////////////NO DATA////////////////////////////////
  	else { echo 'no data'; }
  

	if ($results = $db_connection->query($query)) // QUERIES AND CHECKS THE STATUS OF THE QUERY
	{
  
	foreach ($results as $result)
		{
			echo $result['name'] . " ------ " . $result['count'] . " ------ " . $result['datetime'] ;
			echo "<br>";
		}
 
	}
  
}

////////////////////IF THE TYPE IS POST////////////////////////////////
if ($type == "POST")
{
  echo 'post ';
    if (isset($name) && isset($count))
    {
        $query = "INSERT INTO $db_table (name,count) VALUES ('$name','$count')";
        $db_connection->exec($query);
      echo 'success';
    }
  	else
    {
     echo '- no data posted - please ensure that all variables are declared in the URL';
  	}

}


?>
