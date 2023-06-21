<?php
if ($_POST){
    $name = "";
    $email= "";
    $ordernr = "";
    $subject = "";

    if (isset($_POST['name'])){
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }

    if(isset($_POST['email'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['order'])){
        $ordernr = filter_var($_POST['order'], FILTER_SANITIZE_STRING);
    }

    if(isset($_POST['subject'])) {
        $subject = htmlspecialchars($_POST['subject']);
    }


    if(!empty($name)){
        include('contactsucces.php');
        exit;
    } else {
        include('contactfailure.php');
        exit;
    }
    
    
} else {
    echo '<p>Something went wrong</p>';
}
