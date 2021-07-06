<html>
<head>
    <style>
        h1, h4, h5{
            text-align: center;
        },
    </style>
    <style>
        label{
            text-align: left;
        }
    </style>
</head>
<body style="text-align: center">
<h1>New Song</h1>
<h5>Fill song Details:</h5>
<form style="display: inline-block" name="song" method="post">
    <table>
        <tr>
            <td>Song Name:</td>
            <td><input type="text", name="songName", maxlength="100", size="100" required>*</td>
        </tr>
        <tr>
            <td><label>Artist Name:</label></td>
            <td><input type="text", name="artistName", maxlength="100", size="100"></td>
        </tr>
        <tr>
            <td>Album Name:</td>
            <td><input type="text", name="albumName", maxlength="100", size="100"></td>
        </tr>
        <tr>
            <td>Genre:</td>
            <td>
                <select name="genre">
                    <?php
                    include "sqlConnection.php";
                    $conn = conn();
                    $sql="SELECT distinct genre FROM iTunes";
                    $result = sqlsrv_query($conn, $sql);
                    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
                    {
                        echo "<option value='";
                        echo $row['genre'];
                        echo "'>";
                        echo $row['genre'];
                        echo "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Released Date:</td>
            <td><input type="date" name="releasedDate" min="2000-01-01" value="2000-01-01"></td>
        </tr>
        <tr>
            <td>Price:</td>
            <td>
                <input type="radio" id="Cheap" name="price" value="Cheap" checked>
                <label for="Cheap">Cheap</label>
                <br/>
                <input type="radio" id="Expensive" name="price" value="Expensive">
                <label for="Expensive">Expensive</label>
            </td>
        </tr>
        <tr>
            <td>Duration:</td>
            <td><input type="number" name="duration" min="30" required>*</td>
        </tr>
    </table>
    <input name="submit" type="submit" value="Send">
    <br/><br/>
    <input type="reset" value="reset">
</form>
<?php
if (isset($_POST["submit"])) {
     $result = uploadSingle($_POST["songName"],$_POST["artistName"],$_POST["albumName"],$_POST["genre"],$_POST["releasedDate"],$_POST["price"],$_POST["duration"]);
    echo "<br/>";
    if (!$result) {
    die("Couldn't add the part to the catalog.<br>");
    }
    else echo "The details have been added to the database.<br><br>";
}
?>
</body>
</html>
