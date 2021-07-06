<html>
<head>
    <style>
        h1, h4, h5, a{
            text-align: center;
        }
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <style>
        table, th, td {
            border: 1px solid black;
        },
    </style>
</head>
<body>
<h1>Welcome to the iTunes Website</h1>
<h5> Here you can explore information about songs</h5>

<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/df/ITunes_logo.svg/langfr-800px-ITunes_logo.svg.png" width="200" height="200" align="center">
<h5>
<br/>
<a href="new_song.php", target="_self"> Add a new song</a>
<br/>
<a href="new_file.php", target="_self"> Add a new file</a>
</h5>

<h1>Most Active Artist:</h1>
<?php
include 'sqlConnection.php';
$conn = conn();
$sql="SELECT TOP 1 artistName FROM mostPopular";
$result = sqlsrv_query($conn, $sql);
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    echo "<h4>";
    echo $row['artistName'];
    echo "</h4>";
}
echo "<h4>Songs of the most active artist that satisfy the given conditions:</h4>";

$sql="SELECT * FROM mostPopularArtistSongWithConditions";
$result = sqlsrv_query($conn, $sql);
echo "<table align='center'>";
echo "<th>Song Name</th><th>Album Name</th><th>Released Yeas</th>";
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
{
    echo "<tr> <td>";

    echo $row['songName'] . "</td><td> " . $row['albumName'] . "</td><td> " . $row['releasedYear'];

    echo "</td></tr>";
}
echo"</table>";
?>

</body>
</html>