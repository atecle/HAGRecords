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

<div class="masthead clearfix">
<div class="inner">
<h3 class="masthead-brand"><img src="logo.png"/></h3>
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

        echo "Query not accessible by this user.<br>";

    }       

    else if(!empty($last_name)){ //last name

        echo "Query not accessible by this user.<br>";

    }        

    else if(!empty($genre)){ //genre

        echo "Query not accessible by this user.<br>";

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

        while ($row = mysql_fetch_assoc($result))                                                        
        {                                                                                                
            echo $row['ArtistName'];                                                                     
        }  

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

        while ($row = mysql_fetch_assoc($result))                                                        
        {                                                                                                
            echo $row['AlbumName'];                                                                     
        }                             
    }
    else if (!empty($song_name)
        && empty($artist_name)
        && empty($song_name)
        && empty($year))
    {

        $sql = "SELECT SongName FROM Songs WHERE SongName=\"$song_name\"";

        $result = mysql_query($sql);                                                                     

        if ($result == false) {                                                                          
            die(mysql_error());                                                                          
        }                                                                                                

        while ($row = mysql_fetch_assoc($result))                                                        
        {                                                                                                
            echo $row['SongName'];                                                                     
        }                                                                                                

    }
    elseif (empty($song_name)
        && empty($artist_name)
        && empty($album_name)
        && empty($year)
    ){
        $sql = "SELECT Act.ActName, Albums.AlbumName, Songs.SongName, Albums.Year 
            FROM Act, Albums, Songs 
            WHERE Act.Act_DiscographyID = Albums.Albums_DiscographyID
            AND Albums.Albums_DiscographyID = Songs.Song_DiscographyID";                        

        $result = mysql_query($sql);                                                                     

        if ($result == false) {                                                                          
            die(mysql_error());                                                                          
        }                                                                                                

        while ($row = mysql_fetch_assoc($result))                                                        
        {                                                                                                
            echo $row['ArtistName'];
            echo $row['AlbumName'];
            echo $row['SongName'];
            echo $row['ReleaseYear'];                                                                     
        }                                                                                                


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
    //
    $artist_name_length = strlen(trim($artist_name));
    $album_name_length = strlen(trim($artist_name));
    $song_name_length = strlen(trim($artist_name));
    $year_length = strlen(trim($artist_name));
    $employee_name_length = strlen(trim($artist_name));

    if($year_length != 0){
        echo "A producer user cannot access release year.";     
    }
    //Act, Albums, Artist, Discography, Employee, Executives, Producers, Songs
    if($artist_name_length != 0){
        $sql = "SELECT Artist.ArtistName, Act.ActName, Albums.AlbumName, Albums.Year
            FROM Artist, Act, Albums, Discography
            WHERE Artist.ArtistName = \"$artist_name\" 
            AND Artist.ArtistName = Act.ArtistName
            AND Act.Act_DiscographyID = Albums.Albums_DiscographyID";
    }
    else if($album_name_length != 0){
        $sql = "SELECT Act.ActName, Albums.AlbumName, Albums.Year
            FROM Act, Albums, Discography
            WHERE Albums.AlbumName = \"$album_name\" 
            AND Act.Act_DiscographyID = Albums.Albums_DiscographyID";
    }
    else if($song_name_length != 0){
        $sql = "SELECT Songs.SongName, Act.ActName, Albums.AlbumName, Albums.Year
            FROM Songs, Act, Albums, Discography
            WHERE Songs.SongName = \"$song_name\" 
            AND Songs.AlbumName = Albums.AlbumName
            AND Act.Act_DiscographyID = Albums.Albums_DiscographyID";
    } else if ($artist_name_length == 0 && $album_name_length == 0 && $song_name_length == 0 && $year_length == 0 && $employee_name_length == 0){
        $sql = "SELECT Songs.SongName, Act.ActName, Albums.AlbumName, Employee.EmployeeName, 
            FROM Songs, Act, Albums, Employee, Discography
            WHERE Songs.AlbumName = Album.AlbumName
            AND Act.Act_DiscographyID = Albums.Albums_DiscographyID";       
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

    else if(!empty($artist_name) AND !empty($album_name) AND !empty($song_name)
        AND !empty($year) AND !empty($employee_name)) {

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

