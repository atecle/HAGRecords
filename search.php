
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
} elseif($selected_radio == "executive") {

    echo "executive";
}

echo "<br/>";
echo "<a href=\"index.html\">Back to Search</a>";
?>
