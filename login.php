<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>LogIn</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="logIn.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="apple-touch-icon" sizes="180x180" href="nettsideBilder/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="nettsideBilder/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="nettsideBilder/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

    </head>
<html>
    <body>
        <header>    
            <section>
                <img class="menu" src="nettsideBilder/flagg.png" height="25px">
            </section>
    
            <section>
                <a href=index.html><img class="logo" src="nettsideBilder/Original.svg"></a>
            </section>
  
           <section class="ikoner">
               <a class="ikon_flytte" href=""><img class="flagg" id="icon" src="nettsideBilder/flagg.png"></a>
               <a class="ikon_flytte" href="login.php"> <img class="account" id="icon" src="nettsideBilder/account.png"></a>
               <a class="ikon_flytte" href="cart.html"><img  class="cart" id="icon" src="nettsideBilder/cart.png"></a>
            </section>
        </header>

        <section class="slogan">
            <p>vegan ● handmade ● cruelty free</p>
        </section>
        
        <nav>
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a href="#">Collections</a>
                    <ul>
                        <li><a href="originalcollection.php?category=Original Collection">Original Collection</a></li>
                        <li><a href="#">Holiday Collection</a></li>
                        <li><a href="#">Juicy Collection</a></li>
                        <li><a href="#">Valentine Collection</a></li>
                        <li><a href="#">RhoseGold x Meraki</a></li>
                    </ul>
                </li>
                <li>
                    <a href="Shop.php">Shop</a>
                    <ul>
                        <li><a href="Lipgloss.php?category=Lip Gloss">Lip Gloss</a></li>
                        <li><a href="Lashes.php?category=Lashes">Lashes</a></li>
                        <li><a href="Bundles.php?category=bundle">Bundles</a></li>
                    </ul>
                </li>
                
            </ul>
        </nav>
   
	
    <?php
	session_start();
    include "db.php";
    //include "get_logInData.php";
	 
//	$email = trim(strip_tags($_POST['Epost']));
//	$password = trim(strip_tags($_POST['Passord']));
   
	
		
	//if(isset($_POST["submit_form"]))
    if($_SERVER['REQUEST_METHOD'] =="POST")

	{	$Epost = trim(strip_tags($_POST['Epost']));
        $Passord = trim(strip_tags($_POST['Passord']));	
        $message = 'Hei';
        //echo($Epost );

        if(!empty($Epost) && !empty($Passord))
        {
            $query = "SELECT * FROM brukere WHERE Epost ='$Epost'  limit 1";
            $result = mysqli_query($conn,$query) or die(mysql_error());
            $rows = mysqli_num_rows($result);
            //echo($result);

            if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);

                //echo($user_data);

                if($user_data['Passord'] === $Passord)

                {
                    $_SESSION['Epost'] = $user_data['Epost'];
                    $_SESSION['Navn'] = $user_data['Navn'];
                   header("Location: mypage.php");
                    die;
 
                } else $message ="Invalid username or password";
                echo "invalid Email or Password";

            }
        }
//		if($rows==1){
//			$_SESSION['Epost'] = $Epost;
				// Redirect user to index.php
//			header("Location: mypage.php");
//		}
		else{
            $message = "username or password is incorrect";
            echo "feil passord";
        }
        
		}	 
	}  
?>

<h1 class="page_title">Log in to your account</h1>
 <section class="logReg_page">
           
                <section class="container">
                  <form  method = "post" class="logReg" id = "submit_form">
                      <p>
                          <input type="email" placeholder="Enter Email" name="Epost" id = "Epost" required>
                      </p>
                      <p>   
                          <input type="password" placeholder="Enter Password" name="Passord" id = "Passord" required>
                      </p>
                      <a><?php $message ?></a>
                      <section class="logReg_btns">
                          <button class = "submit", type="submit">Log In</button>
                    
                        <button onclick="window.location.href='register.html';">Create new account</button>
                    </form>
                </section> 
                 
		<br><br> 
            
                    
    </section>
</section>
		
		

	
        <footer class="footeren">
        <section id="logo_sosial"> 
            <section id="logoen_space">
                <img class="logo" src="nettsideBilder/Original.svg" height="40px">
            </section>
            <section>
                <ul class="sosial">
                    <li id="sppacen" class="ikon_flytte"><a href="https://www.facebook.com/rhoseg0ld" target="_blank"><img src="nettsideBilder/facebook.png" height="50px"></a></li>
                    <li class="ikon_flytte"><a href="https://www.instagram.com/rhosegoldbeauty/" target="_blank"><img src="nettsideBilder/instagram.png" height="50px"></a></li>
                </ul>
            </section>
        </section>
       
        <section>
            <section class="info_pages"> 
                <a id="info_plass" href="about.html"><p>About</p></a>
                <a id="info_plass" href="contact.php"><p>Contact</p></a>
                <a id="info_plass" href="faq.html"><p>FAQ</p></a>
                <a id="info_plass" href="policies.html"><p>Policies</p></a>
            </section>

            <section>
                <form class="foorter_inputbutton" action="#" method="post">
                    <input placeholder="Email" type="text" required>
                    <button>Subscribe</button>
                </form>
            </section>   
        </section>
    </footer>
</body>
</html>




