<?php

const DEFAULT_URL = 'https://pakapp.firebaseio.com/';
const DEFAULT_TOKEN = '';

session_start();
include 'firebase-php-master/src/firebaseInterface.php';
include 'firebase-php-master/src/firebaseLib.php';
include 'firebase-php-master/src/firebaseStub.php';

$db_host = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'dropyour_master';

$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$connection) {
    echo 'Not connected : '.mysqli_error();
    die();
} else {
    mysqli_select_db($connection, $db_name) or die('No Datebase');
    mysqli_query($connection, 'SET NAMES UTF8');
}

function query($connection, $sql)
{
    $result = mysqli_query($connection, $sql);
    $value = '';
    if ($result) {
        if (is_object($result)) { // SELECT
      $i = 0;
            while ($rs = mysqli_fetch_assoc($result)) {
                foreach ($rs as $key => $val):
          $value[$i][$key] = $val;
                endforeach;
                ++$i;
            }
        } else { // INSERT UPDATE DELETE
      $value = 'Success';
        }
    }

    return $value;
}

function redirect($url)
{
    echo '<script>document.location = "'.$url.'"</script>';
    exit;
}

function removeQuote($string)
{
    $string = str_replace('"', '', $string);
    $string = str_replace("'", '', $string);

    return $string;
}
