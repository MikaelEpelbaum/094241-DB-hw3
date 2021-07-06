<?php
function conn() {
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "eduardogol";
    $pass = "Qwerty12!";
    $database = "eduardogol";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if($conn === false)
    {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }
    return $conn;
}

function uploadSingle($song, $artist, $album, $genre, $date, $price, $duration){
    $sql="INSERT INTO iTunes
    VALUES('".$song."','".$artist."','" .$album."','".$genre."','".$date."','".$price."',".$duration.");";
    return  sqlsrv_query(conn(), $sql);
}

function CVSUpload($file){
    $success = 0;
    $failed = 0;
    $row = 1;
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($row == 1) {
                $row++;
                continue;}
            $row++;
            $result = uploadSingle($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
            if (!$result) {$failed++;}
            else {$success++;}
            }
        }
    else {return array('Success' => 'FAILED', 'Failed' => 'FAILED');}
    fclose($handle);
    return array('Success' => $success, 'Failed' => $failed);
}
?>