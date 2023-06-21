<?php
    include "db.php";

if (!isset($_POST['Epost'], $_POST['Passord'], $_POST['Navn'], $_POST['Adresse'],$_POST['Postnr'],$_POST['Poststed'])) {
    exit('Emty Field(s)');
}

if(empty($_POST['Epost']) || empty($_POST['Passord']) || empty($_POST['Navn']) || empty($_POST['Adresse']) || empty($_POST['Postnr']) || empty($_POST['Poststed'])) {
    exit('Values empty');
}

/* Legg inn sjekk for om epost allerede eksisterer */

if($stmt = $conn->prepare('SELECT Epost FROM brukere WHERE Epost = ?')) {
    $stmt->bind_param('s',$_POST['Epost']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows>0){
        echo 'User account with this E-mail already exist. Try again, or go to LogIn-page.';
    }



    else {
        if($stmt = $conn->prepare('INSERT INTO brukere(Epost, Passord, Navn, Adresse, Add_Adresse, Postnr, Poststed) VALUES (?, ?, ?, ?, ?, ?, ?)')){
            $password = password_hash($_POST['Passord'], PASSWORD_DEFAULT);
            $stmt->bind_param('sssssss', $_POST['Epost'],$_POST['Passord'],$_POST['Navn'],$_POST['Adresse'],$_POST['Add_Adresse'],$_POST['Postnr'],$_POST['Poststed']);
            $stmt->execute();
            //echo 'Registrert';
            header("Location: login.php");
        }
            
        }
    $stmt->close();
}
    


?>