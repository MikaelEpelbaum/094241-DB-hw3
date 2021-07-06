<html>
<style>
    h1, h3, h5, input{
        text-align: center;
    }
</style>
</head>
<body>
<h1>Add file</h1>
<h3> Choose file:</h3>

<div style="text-align: center">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <input name="csv" type="file" id="csv" />
    <br/> <br/>
    <input type="submit" name="submit" value="submit" />
    </form>
</div>

<?php
include "sqlConnection.php";
if (isset($_POST["submit"])) {
    //get the csv file
    $file = $_FILES[csv][tmp_name];
    $result = CVSUpload($file);
    echo "<h5> Number of failed tuples uploads: ";
    echo $result['Failed'];
    echo "</h5><h5> Number of success uploads: ";
    echo $result['Success'];
    echo "</5>";
}
?>
</html>