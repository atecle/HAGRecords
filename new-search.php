<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>%HAG Records%</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<div class="site-wrapper">

<div class="site-wrapper-inner">

<div class="cover-container">

<nav class="navbar transparent  navbar-static-top">
<h3 class="masthead-brand"><a href="index.html"><img src="logo.png"/></a></h3>
</nav>
<div class="masthead clearfix">

<div class="inner">
</div>
</div>

<div class="inner cover">

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
    $first_name = $_POST['firstname']; 
    $last_name = $_POST['lastname']; 
    $genre = $_POST['genre'];

    //query for not accessible data

    if(!empty($first_name)){ //first name

        echo "<h2> General user cannot query by first name. </h2>";
        return;
    }       

    else if(!empty($last_name)){ //last name

        echo "<h2> General user cannot query by last name. </h2>";
        return;
    }        

    else if(!empty($genre)){ //genre

        echo "<h2> General user cannot query by genre. </h2>";
        return;
    }        

    $sql = "";

    if (!empty($artist_name) 
        && empty($album_name)
        && empty($song_name)
        && empty($year))
    {

        $sql = "SELECT ArtistName FROM Artist WHERE ArtistName=\"$artist_name\"";   
        $result = mysql_query($sql);                                                                     

        if ($result == false) {                                                                          
            die(mysql_error());                                                                          
        }                                                                                                

        echo "<table class=\"table table-bordered\">
            <tr> <th> Artist Name </th> </tr>";
        while ($row = mysql_fetch_assoc($result))                                                        
        {                                                                                                
            echo "<tr> <td>" . $row['ArtistName'] . "</td> </tr>";                                                                    
        }  
        echo "</table>";
        return;
    }

    else if (!empty($album_name) 
        && empty($artist_name)
        && empty($song_name)
        && empty($year))
    {
        $sql = "SELECT AlbumName FROM Albums WHERE AlbumName=\"$album_name\"";
        $result = mysql_query($sql);                                                                     

        if ($result == false) {                                                                          
            die(mysql_error());                                                                          
        }                                                                                                

        echo "<table class=\"table table-bordered\">
            <tr> <th> Album Name </th> </tr>";
        while ($row = mysql_fetch_assoc($result))                                                        
        {                                                                                                
            echo "<tr> <td>" . $row['AlbumName'] . "</td> </tr>";                                                                     
        }                    
        echo "</table>";
        return;        
    }
    else if (!empty($song_name)
        && empty($artist_name)
        && empty($album_name)
        && empty($year))
    {
        $sql = "SELECT SongName FROM Song WHERE SongName=\"$song_name\"";

        $result = mysql_query($sql);                                                                     

        if ($result == false) {                                                                          
            die(mysql_error());                                                                          
        }                                                                                                

        echo "<table class=\"table table-bordered\">
            <tr> <th> Song Name </th> </tr>";
        while ($row = mysql_fetch_assoc($result))                                                        
        {                                                                                                
            echo "<tr> <td>" . $row['SongName'] . "</td> </tr>";                                                          
        }                                                                                                
        echo "</table>";
        return;
    }
    elseif (empty($song_name)
        && empty($artist_name)
        && empty($album_name)
        && empty($year))
    {
        $sql = "SELECT Act.ActName, Albums.AlbumName, Song.SongName, Albums.Year 
            FROM Act, Albums, Song 
            WHERE Act.Act_DiscographyID = Albums.Albums_DiscographyID
            AND Albums.Albums_DiscographyID = Song.Song_DiscographyID";                        

        $result = mysql_query($sql);                                                                     

        if ($result == false) {                                                                          
            die(mysql_error());                                                                          
        }                                                                                                
        echo "<table class=\"table table-bordered\">
            <tr> <th> Artist Name </th>
            <th> Album Name </th>
            <th> Song Name </th>
            <th> Release Year </th>
            </tr>";
        while ($row = mysql_fetch_assoc($result))                                                        
        {                                                                                                
            echo "<tr> <td>" . $row['ActName'] . "</td> <td>" . $row['AlbumName'] . "</td> <td>" 
                . $row['SongName'] . "</td> <td>" . $row['Year'] . "</td></tr>"; 
        }                                                                                                
        echo "</table>";
        return;
    }

}
elseif ($selected_radio == "artist") {

} elseif($selected_radio == "producer") {

    echo "producer";
    //see part 1 for query restrictions
    $artist_name = $_POST['artistname'];
    $album_name = $_POST['albumname'];
    $song_name = $_POST['songname'];
    $year = $_POST['releaseyear'];
    $contract_years = $_POST['contractyears'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $genre = $_POST['genre'];
    $act_name = $_POST['actname'];

    $hasArtist = !empty($artist_name);
    $hasAct =  !empty($act_name);
    $hasAlbum = !empty($album_name);
    $hasSong = !empty($song_name);
    $hasYear = !empty($year);
    $hasLast =  !empty($last_name);
    $hasFirst = !empty($first_name);
    $hasGenre = !empty($genre);
    $hasCYear = !empty($contract_years);

    if($hasYear){
        echo "<h2>A producer user cannot access release year.</h2>";
        return;
    } elseif ($hasCYear){
        echo "<h2>A producer user cannot access contract year.</h2>";
        return;
    } elseif ($hasFirst){
        echo "<h2>A producer user cannot access first name.</h2>";
        return;
    }

    //Act, Albums, Artist, Discography, Employee, Executives, Producers, Songs
    if($hasArtist && !$hasAct && !$hasAlbum && !$hasSong && !$hasYear && !$hasLast && !$hasFirst && !$hasGenre && !$hasCYear){
        echo "searched artist name";
        $sql = "SELECT ArtistName, ActName
            FROM Artist, Act
            WHERE Artist.ArtistName REGEXP '^$artist_name'
            AND Artist.Artist_ActName = Act.ActName";

        $result = mysql_query($sql);

        if ($result == FALSE) {
            die(mysql_error());
        }


        echo "<table class=\"table table-bordered\">
            <tr><th>Artist</th>
            <th>Act</th> </tr>";
        while ($row = mysql_fetch_assoc($result)) {

           echo "<tr><td>" . $row['ArtistName'] . "</td><td>" . $row['ActName'] . "</td></tr>";
        }
        echo "</table>";
        return;

    } elseif(!$hasArtist && !$hasAct && $hasAlbum && !$hasSong && !$hasYear && !$hasLast && !$hasFirst && !$hasGenre && !$hasCYear){
        echo "searched album name";
        $sql = "SELECT AlbumName, ActName
            FROM Albums, Act, Discography
            WHERE Albums.AlbumName REGEXP '^$album_name'
            AND Act.Act_DiscographyID = Albums.Albums_DiscographyID";
	
	$result = mysql_query($sql);
	if ($result == FALSE){
		die(mysql_error());
	}

	echo "<table class=\"table table-bordered\">
		<tr><th>Album</th><th>Act</th></tr>";
	while($row = mysql_fetch_assoc($result)){
		echo "<tr><td>" . $row['AlbumName'] . "</td><td>" . $row['ActName'] . "</td></tr>";
	}
	echo "</table>";	

        return;
    } elseif(!$hasArtist && !$hasAct && !$hasAlbum && $hasSong && !$hasYear && !$hasLast && !$hasFirst && !$hasGenre && !$hasCYear){
        echo "searched song name";
        $sql = "SELECT SongName, ActName, Albums.AlbumName
            FROM Song, Act, Albums, Discography
            WHERE Song.SongName REGEXP '^$song_name' 
            AND Song.AlbumName = Albums.AlbumName
            AND Act.Act_DiscographyID = Albums.Albums_DiscographyID";
	
	$result = mysql_query($sql);
	if ($result == FALSE){
		die (mysql_error());
	}

	echo "<table class=\"table table-bordered\">
		<tr><th>Song</th><th>Act</th><th>Album</th></tr>";

	while($row = mysql_fetch_assoc($result)){
		echo "<tr><td>" . $row['SongName'] . "</td><td>" . $row['ActName'] . "</td><td>" . $row['AlbumName'] . "</td></tr>";
	}
	echo "</table>";

        return;
    } elseif(!$hasArtist && !$hasAct && !$hasAlbum && !$hasSong && !$hasYear && !$hasLast && !$hasFirst && !$hasGenre && !$hasCYear){
        echo "searched all";
        $sql = "SELECT SongName, ActName, Albums.AlbumName, Artist.ArtistName, Employee.LastName, Genre 
            FROM Song, Act, Albums, Employee, Discography, Artist
            WHERE Song.AlbumName = Albums.AlbumName
            AND Act.Act_DiscographyID = Albums.Albums_DiscographyID
		AND Artist.Artist_ActName = Act.ActName";		
	
	$result = mysql_query($sql);

	if ($result == FALSE){
		die (mysql_error());
	}
	echo "<table class =\"table table-bordered\">
		<tr><th>Song</th><th>Artist</th><th>Act</th><th>Album</th><th>Genre</th></tr>";
	while($row = mysql_fetch_assoc($result)){
		
		echo "<tr><td>" . $row['SongName'] . "</td><td>" . $row['Artist.ArtistName'] . "</td><td>" . $row['ActName'] . "</td><td>" . $row['Albums.AlbumName'] . "</td><td>" . $row['Genre'] . "</td></tr>";	

	}	
	echo "</table>";
        return;
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

    /*
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
     */

    echo "result: " . $result;

} elseif($selected_radio == "executive") {

    $artist_name = $_POST['artistname'];  
    $act_name = $_POST['actname'];                                                           
    $album_name = $_POST['albumname'];                                                               
    $song_name = $_POST['songname'];                                                                 
    $year = $_POST['releaseyear']; 
    $contract_years = $_POST['contractyears'];
    $last_name = $_POST['lastname'];
    $first_name = $_POST['firstname'];
    $genre = $_POST['genre'];    

    //query 1
    //albums released in a certain year
    if(!empty($year) 
        && empty($artist_name)
        && empty($act_name)
        && empty($album_name)
        && empty($song_name)
        && empty($contract_years)
        && empty($last_name)
        && empty($first_name)
        && empty($genre))
    {
        $sql = "SELECT DISTINCT Act.ActName, Albums.AlbumName, Albums.Year
            FROM Act, Albums, Discography
            WHERE Albums.Year = \"$year\" 
            AND Act.Act_DiscographyID = Albums.Albums_DiscographyID";

        $result = mysql_query($sql);

        if($result == false){
            die(mysql_error());
        }

        echo "<table class=\"table table-bordered\">
            <tr> <th> Act Name </th>
            <th> Album Name </th>
            <th> Year </th> </tr>";
        while ($row = mysql_fetch_assoc($result)){
            echo "<tr> <td>" . $row['ActName'] . "</td> <td>" .
                $row['AlbumName'] . "</td> <td>" . 
                $row['Year'] . "</td> </tr>";
            // echo $row['ActName'];
            // echo $row['AlbumName'];
            //echo $row['Year'];
        }
        echo "</table>"; 
        return;
    }

    //query 2
    //artists who have X years or less on their contracts
    elseif(!empty($contract_years)
        && empty($artist_name)
        && empty($act_name)
        && empty($album_name)
        && empty($song_name)
        && empty($year)
        && empty($last_name)
        && empty($first_name)
        && empty($genre)){

            $sql = "SELECT Artist.ArtistName, Artist.ContractYears
                FROM Artist
                WHERE Artist.ContractYears <= \"$contract_years\"
                ORDER BY Artist.ContractYears DESC"; 

            $result = mysql_query($sql);

            if($result == false){
                die(mysql_error());
            }
            echo "<table class\"table table-bordered\">
                <tr> <th> Artist Name </th>
                <th> Contract Years </th>
                </tr>";
            while ($row = mysql_fetch_assoc($result)){
                echo "<tr> <td>" . $row['ArtistName'] . "</td> <td>" .
                    $row['ContractYears'] . "</td> </tr>";
                //echo $row['ArtistName'];
                //echo $row['ContractYears'];
            }
            echo "</table>";
            return;
        }

    //query 3
    //search acts in a certain genre

    elseif(!empty($genre)
        && empty($artist_name)
        && empty($act_name)
        && empty($album_name)
        && empty($song_name)
        && empty($contract_years)
        && empty($last_name)
        && empty($first_name)
        && empty($year)){

            $sql = "SELECT Act.ActName, Act.Genre
                FROM Act
                WHERE Act.genre = \"$genre\"";

            $result = mysql_query($sql);

            if($result == false){
                die(mysql_error());
            }

            echo "<table class=\"table table-bordered\">
                <tr> <th> Act Name </th>
                <th> Genre </th>
                </tr>";
            while ($row = mysql_fetch_assoc($result)){
                echo "<tr> <td>" . $row['ActName'] . "</td> <td>" .
                    $row['Genre'] . "</td> </tr>";
                //echo $row['actname'];
                // echo $row['genre'];
            }
            echo "</table>";
            return;
        }
    //query for all the data allowed
    //all data allowed, so join all tables?

    elseif(empty($artist_name) 
        && empty($album_name) 
        && empty($song_name)
        && empty($year) 
        && empty($genre)
        && empty($act_name)
        && empty($last_name)
        && empty($first_name)
        && empty($contract_years)) {

            $sql = "SELECT DISTINCT Artist.ArtistName, Act.ActName, Albums.AlbumName, 
                Song.SongName, Albums.Year, Employee.LastName, 
                Employee.FirstName, Act.Genre, Artist.ContractYears 
                FROM Act, Albums, Artist, Discography, Employee, Executives, Producers, Song
                WHERE (Employee.ExecutiveID = Executives.ExecutiveID
                OR Employee.ProducerID = Producers.ProducerID
                OR Employee.ArtistID = Artist.ArtistID
                AND (Employee.LastName <> 'Tiffith'
                AND Employee.LastName <> 'West'))
                AND Artist.Artist_ActName = Act.ActName
                AND Discography.DiscographyID = Act.Act_DiscographyID
                AND Discography.DiscographyID = Albums.Albums_DiscographyID
                AND Discography.DiscographyID = Song.Song_DiscographyID
                AND Albums.AlbumName = Song.AlbumName";

            $result = mysql_query($sql);

            if($result == false){
                die(mysql_error());
            }

            echo "<table class=\"table table-bordered\">
                <tr> <th>Artist Name</th>
                <th> Act Name </th>
                <th> Album Name </th>
                <th> Song Name </th>
                <th> Year </th>
                <th> Last Name </th>
                <th> First Name </th>
                <th> Genre </th>
                <th> Contract Yrs </th>
                </tr>";
            while ($row = mysql_fetch_assoc($result)){

                echo "<tr><td>" . $row['ArtistName'] . "</td><td>" .
                    $row['ActName'] . "</td><td>" . $row['AlbumName'] .
                    "</td> <td>" . $row['SongName'] . "</td> <td>" .
                    $row['Year'] . "</td><td>" . $row['LastName'] . "</td><td>" .
                    $row['FirstName'] . "</td><td>" . $row['Genre'] . "</td><td> " .
                    $row['ContractYears'] . "</td><tr>";
               /* echo $row['artistname'];
                echo $row['actname'];
                echo $row['albumname'];
                echo $row['song_name'];
                echo $row['year'];
                echo $row['lastname'];
                echo $row['firstname'];
                echo $row['genre'];
                echo $row['contractyears'];
                */
            }
            echo "</table>";
            return;
        } 

    //query for data not allowed to user (but this user can access all data)    

}

echo "<br/>";
echo "<a href=\"index.html\">Back to Search</a>";
?>

</div>

<div class="mastfoot">
<div class="inner">
</div>
</div>

</div>

</div>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>

