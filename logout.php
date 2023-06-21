<?php
session_start();

if(isset($_SESSION['Epost']))
{
    unset($_SESSION['Epost']);
}

header("Location: index.html");
die;
?>