<?php
function OpenCon()
{
    $dbhost = "eu-cdbr-west-02.cleardb.net";
    $dbuser = "bf74ebbc73e60f";
    $dbpass = "5b68bb6f";
    $db = " heroku_b3dd5bcc44be8e6";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

    return $conn;
}
function CloseCon($conn)
{
    $conn->close();
}
