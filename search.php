
<?php

echo "<h3> Search Results </h3>";
echo "<table style=\"width:100%\">
    <tr>
        <th>Artist</th>
        <th>Album</th>
        <th>Song</th>
        <th>Year</th>
    </tr>";
$servername = "cs336-5.cs.rutgers.edu";
$username = "HAGRecords";
$password = "HAGRecords";
$dbname = "RecordLabel";

$conn = mysql_connect($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selected = mysql_select_db($dbname,$conn);

$selected_radio = $_POST['usertype'];

if ($selected_radio ==  "generaluser") {

    $artist_name = $_POST['artistname'];
    $album_name = $_POST['albumname'];
    $song_name = $_POST['songname'];
    $year = $_POST['releaseyear'];

    $sql = "SELECT ArtistName From Artist WHERE ArtistName=\"$artist_name\"";

    $result = mysql_query($sql);

    if ($result == false) {
        die(mysql_error());
    }

    while ($row = mysql_fetch_assoc($result))
    {
        echo $row['ArtistName'];
    } 


}
elseif ($selected_radio == "artist") {

    echo "artist";
} elseif($selected_radio == "producer") {

    echo "producer";
	//see part 1 for query restrictions
	$artist_name = $_POST['artistname'];
    $album_name = $_POST['albumname'];
    $song_name = $_POST['songname'];
    $year = $_POST['releaseyear'];
	$employee_name = $_POST['employeename'];
	
	$artist_name_length = strlen(trim($artist_name));
	$album_name_name_length = strlen(trim($artist_name));
	$song_name_length = strlen(trim($artist_name));
	$year_length = strlen(trim($artist_name));
	$employee_name_length = strlen(trim($artist_name));
	
} elseif($selected_radio == "executive") {

    $artist_name = $_POST['artistname'];  
	$act_name = $_POST['actname'];                                                           
    $album_name = $_POST['albumname'];                                                               
    $song_name = $_POST['songname'];                                                                 
    $year = $_POST['releaseyear']; 
    $contract_years = $_POST['contractyears'];
    $genre = $_POST['genre'];    
    
//query 1
//albums released in a certain year
	if(!empty($year)){
		
		$sql = "SELECT Act.ActName, Album.AlbumName, Album.Year
				FROM Act, Album, Discography
				WHERE Album.Year = \"$year\" 
				AND Act.Act_DiscographyID = Album.Albums_DiscographyID";
				
		$result = mysql_query($sql);
		
		if($result == false){
		die(mysql_error());
		}
		
		while ($row = mysql_fetch_assoc($result)){
		echo $row['ArtistName'];
		echo $row['AlbumName'];
		echo $row['Year'];
		}
	}
	
//query 2
//artists who have X years or less on their contracts
	else if(!empty($contract_years)){
		
		$sql = "SELECT Artist.ArtistName, Artist.ContractYears
				FROM Artist
				WHERE Artist.ContractYears <= \"$contract_years\"";	
				
		$result = mysql_query($sql);
		
		if($result == false){
		die(mysql_error());
		}
		
		while ($row = mysql_fetch_assoc($result)){
		echo $row['ArtistName'];
		echo $row['ContractYears'];
		}
	}

//query 3
//search acts in a certain genre

	else if(!empty($genre)){
	
		$sql = "SELECT Act.ActName, Act.Genre
				FROM Act
				WHERE Act.genre = \"$genre\"";
				
		$result = mysql_query($sql);
		
		if($result == false){
		die(mysql_error());
		}
		
		while ($row = mysql_fetch_assoc($result)){
		echo $row['actname'];
		echo $row['genre'];
		}
	}

//query for all the data allowed
//all data allowed, so join all tables?

	else if(all empty){
	
	$sql = "SELECT *
			FROM Act, Albums, Artist, Discography, Employee, Executives, Producers, Songs
			WHERE Employee.ExecutiveID = Executives.ExecutiveID
			AND Employee.ProducerID = Producers.ProducerID
			AND Employee.ArtistID = Artist.ArtistID
			AND Artist.ActName = Act.ActName
			AND Discography.DiscographyID = Act.DiscographyID
			AND Discography.DiscographyID = Albums.DiscographyID
			AND Discography.DiscographyID = Song.DiscographyID
			AND Albums.AlbumName = Song.AlbumName";
	
	$result = mysql_query($sql);
		
		if($result == false){
		die(mysql_error());
		}
		
		while ($row = mysql_fetch_assoc($result)){
		echo $row['actname'];
		echo $row['genre'];
		}
	} 

//query for data not allowed to user (but this user can access all data)    

    echo "executive";
}

echo "<br/>";
echo "<a href=\"index.html\">Back to Search</a>";
?>
