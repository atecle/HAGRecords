
<?php

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

    $sql = "";
    if (!empty($artist_name) 
        && empty($album_name)
        && empty($song_name)
        && empty($year))
    {

        $sql = "SELECT ArtistName FROM Artist WHERE ArtistName=\"$artist_name\"";   
    }

    elseif (!empty($album_name) 
        && empty($artist_name)
        && empty($song_name)
        && empty($year))
    {
        $sql = "SELECT AlbumName FROM Albums WHERE AlbumName=\"$album_name\"";
    }
    elseif (!empty($song_name)
            && empty($artist_name)
            && empty($song_name)
            && empty($year))
    {

        $sql = "SELECT SongName FROM Songs WHERE SongName=\"$song_name\"";
    }
    else {

        // dialog that query not supported
    
    }

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
<<<<<<< HEAD
	$employee_name = $_POST['employeename'];
	
	$artist_name_length = strlen(trim($artist_name));
	$album_name_length = strlen(trim($artist_name));
	$song_name_length = strlen(trim($artist_name));
	$year_length = strlen(trim($artist_name));
	$employee_name_length = strlen(trim($artist_name));
	
	if($year_length != 0){
		echo "A producer user cannot access release year.";		
		
	}
	
	if($artist_name_length != 0){
		$sql = "SELECT Artist.ArtistName, Act.ActName, Album.AlbumName, Album.Year
				FROM Artist, Act, Album, Discography
				WHERE Artist.ArtistName = \"$artist_name%\"" 
				AND Artist.ArtistName = Act.ArtistName
				AND Act.Act_DiscographyID = Album.Albums_DiscographyID";
	}
	else if($album_name_length != 0){
		$sql = "SELECT Act.ActName, Album.AlbumName, Album.Year
				FROM Act, Album, Discography
				WHERE Album.AlbumName = \"$album_name%\"" 
				AND Act.Act_DiscographyID = Album.Albums_DiscographyID";
	}
	else if($song_name_length != 0){
		$sql = "SELECT Song.SongName, Act.ActName, Album.AlbumName, Album.Year
				FROM Song, Act, Album, Discography
				WHERE Song.SongName = \"$song_name%\"" 
				AND Song.AlbumName = Album.AlbumName
				AND Act.Act_DiscographyID = Album.Albums_DiscographyID";
	}
	/*else if($year_length != 0){
		$sql = "SELECT Act.ActName, Album.AlbumName, Album.Year
				FROM Act, Album, Discography
				WHERE Album.Year = \"$year\" 
				AND Act.Act_DiscographyID = Album.Albums_DiscographyID";
	}
	else if($employee_name_length != 0){
		$sql = "SELECT Act.ActName, Album.AlbumName, Album.Year
				FROM Act, Album, Discography
				WHERE Album.Year = \"$year\" 
				AND Act.Act_DiscographyID = Album.Albums_DiscographyID";
	}*/
	
	$result = mysql_query($sql);
	
	if($result == false){
		die(mysql_error());
	}
	
	if($artist_name_length != 0){
		echo $row['ArtistName'];
		echo $row['ActName'];
		echo $row['AlbumName'];
		echo $row['Year'];		
	}
	else if($album_name_length != 0){
		echo $row['AlbumName'];
		echo $row['ActName'];
		echo $row['Year'];	
	}
	else if($song_name_length != 0){
		echo $row['SongName'];
		echo $row['ActName'];
		echo $row['AlbumName'];
		echo $row['Year'];
	}
	
=======
    $employee_name = $_POST['employeename'];

    $artist_name_length = strlen(trim($artist_name));
    $album_name_length = strlen(trim($artist_name));
    $song_name_length = strlen(trim($artist_name));
    $year_length = strlen(trim($artist_name));
    $employee_name_length = strlen(trim($artist_name));

    if($artist_name_length != 0){
        $sql = "SELECT Artist.ArtistName, Act.ActName, Album.AlbumName, Album.Year
            FROM Artist, Act, Album, Discography
            WHERE Artist.ArtistName = \"$artist_name%\" 
            AND Artist.ArtistName = Act.ArtistName
            AND Act.Act_DiscographyID = Album.Albums_DiscographyID";
    }
    else if($album_name_length != 0){
        $sql = "SELECT Act.ActName, Album.AlbumName, Album.Year
            FROM Act, Album, Discography
            WHERE Album.AlbumName = \"$album_name%\" 
            AND Act.Act_DiscographyID = Album.Albums_DiscographyID";
    }
    else if($song_name_length != 0){
        $sql = "SELECT Song.SongName, Act.ActName, Album.AlbumName, Album.Year
            FROM Song, Act, Album, Discography
            WHERE Song.SongName = \"$song_name%\" 
            AND Song.AlbumName = Album.AlbumName
            AND Act.Act_DiscographyID = Album.Albums_DiscographyID";
    }
    /*else if($year_length != 0){
        $sql = "SELECT Act.ActName, Album.AlbumName, Album.Year
                FROM Act, Album, Discography
                WHERE Album.Year = \"$year\" 
                AND Act.Act_DiscographyID = Album.Albums_DiscographyID";
    }
    else if($employee_name_length != 0){
        $sql = "SELECT Act.ActName, Album.AlbumName, Album.Year
                FROM Act, Album, Discography
                WHERE Album.Year = \"$year\" 
                AND Act.Act_DiscographyID = Album.Albums_DiscographyID";
    }*/

    $result = mysql_query($sql);

    if($result == false){
        die(mysql_error());
    }

    if($artist_name_length != 0){
        echo $row['ArtistName'];
        echo $row['ActName'];
        echo $row['AlbumName'];
        echo $row['Year'];		
    }
    else if($album_name_length != 0){
        echo $row['AlbumName'];
        echo $row['ActName'];
        echo $row['Year'];	
    }
    else if($song_name_length != 0){
        echo $row['SongName'];
        echo $row['ActName'];
        echo $row['AlbumName'];
        echo $row['Year'];
    }

>>>>>>> d30e76e3807bd416531a810f9f82663058b56bb1
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

    else if(!empty($artist_name) AND !empty($album_name) AND !empty(song_name)
        AND !empty($year) AND !empty($employee_name)){

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

            $sql = "SELECT * FROM ARTIST";    
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
