<?php
    include "db.php";
    $productid = $_GET['produktid'];

    if (isset($productid)) {
        fetch($conn, $productid);
    }   

    $conn->close();
    exit;

    function fetch($conn, $productid) {
        $query = "SELECT * FROM Produkter WHERE ProduktID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $productid);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $output = "";
            $produktNavn = $row['ProduktNavn'];
            $beskrivelse = $row['Beskrivelse'];
            $ingredienser = $row['Ingredienser'];
            $pris = $row['Pris'];

            $dir = "nettsideBilder/{$productid}_*";
            $imgs = glob($dir);

            $output .= "<?php
            <!DOCTYPE html>
            <html>
                <head>
    <meta charset=\"UTF-8\">
                    <title>Product View</title>
                    <link rel=\"stylesheet\" href=\"index.css\">
                    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
                    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
                    <link href=\"https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap\" rel=\"stylesheet\">
                    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                    <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"nettsideBilder/apple-touch-icon.png\">
                    <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"nettsideBilder/favicon-32x32.png\">
                    <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"nettsideBilder/favicon-16x16.png\">
                    <link rel=\"manifest\" href=\"/site.webmanifest\">
                    <link rel=\"mask-icon\" href=\"/safari-    pinned-tab.svg\" color=\"#5bbad5\">
                    <meta name=\"msapplication-TileColor\" content=\"#da532c\">
                    <meta name=\"theme-color\" content=\"#ffffff\">
            
                </head>
                <body>
                    <script src=\"rhosegold.js\"></script>
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
            
                    <section class=\"slogan\">
                        <p class=\"ikon_flytte\">vegan ● handmade ● cruelty free</p>
                    </section>
                    
                    <nav>
                        <ul>
                            <li>
                                <a href=\"index.html\">Home</a>
                            </li>
                            <li>
                                <a href=\"#\">Collections</a>
                                <ul>
                                    <li><a href=\"originalcollection.php?category=Original Collection\">Original Collection</a></li>
                                    <li><a href=\"#\">Holiday Collection</a></li>
                                    <li><a href=\"#\">Juicy Collection</a></li>
                                    <li><a href=\"#\">Valentine Collection</a></li>
                                    <li><a href=\"#\">RhoseGold x Meraki</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href=\"Shop.php\">Shop</a>
                                <ul>
                                    <li><a href=\"Lipgloss.php?category=Lip Gloss\">Lip Gloss</a></li>
                                    <li><a href=\"Lashes.php?category=Lashes\">Lashes</a></li>
                                    <li><a href=\"Bundles.php?category=bundle\">Bundles</a></li>
                                </ul>
                            </li>
                            
                        </ul>
                    </nav>
            
            
                  <section class=\"product_page\">
                      <section id=\"flex_view\">
                          <section class=\"container\">
                              <!-- Bilder-->
                              <section class=\"Slides\">
                                    <section class=\"slidetekst\">1/2</section>
                                    <img  class=\"slidebilde\" src=\"{$imgs[0]}\" alt=\"cinnamon lipgloss\">
                                </section>";
            
                                if (count($imgs) > 1) {
                                    $output .= "<section class=\"Slides\">
                                    <section class=\"slidetekst\">2/2</section>
                                    <img  class=\"slidebilde\" src=\"{$imgs[1]}\" alt=\"cinnamon lipgloss 2\">
                                </section>";
                                }
            
                                $output .= "<!-- neste and forrige buttons -->
                                <a class=\"forrige\" onclick=\"plusSlides(-1)\">&#10094;</a>
                                <a class=\"neste\" onclick=\"plusSlides(1)\">&#10095;</a>
            
                                <!-- Thumbnail images -->
                                <section class=\"rad\">
                                    <section  class=\"kolonne\">
                                        <img class=\"demo cursor\" src=\"{$imgs[0]}\" alt=\"cinnamon lipgloss\" style=\"width:100%\" onclick=\"currentSlide(1)\">
                                    </section>";
            
                                    if (count($imgs) > 1) {
                                        $output .= "<section class=\"kolonne\">
                                        <img id=\"spc\" class=\"demo cursor\" src=\"{$imgs[1]}\" alt=\"cinnamon lipgloss 2\" style=\"width:100%\" onclick=\"currentSlide(2)\">
                                    </section>";
                                    }
                                
                                $output .= "</section> 
                            </section>           
                        </section>
            
                        <section id=\"product_info\">
                            <section id=\"høyre_siden\">
                                <h1 class=\"tittelen\">{$produktNavn}</h1>
                                
                                <section class=\"pris\">
                                      <p>{$pris} kr</p>
                                </section>
                                
                                <section id=\"same_place\">
                                    <section class=\"select\">
                                        <select>
                                            <option value=\"\" selected disabled hidden>Select Type</option>
                                            <option value=\"0\">Squeeze</option>
                                            <option value=\"1\">Tube</option>
                                        </select>
                                    </section>
            
                                    <section class=\"product_count\">
                                        <input type=\"number\" value=\"1\" min=\"1\">
                                    </section>  
                                </section>
            
                                <section id=\"add_cart\">
                                    <button class=\"cart_button\" onclick=\"location.href='https://google.com';\">Add To Cart</button>
                                </section>
            
                                <section class=\"beskrivelse\">  
                                    <p id=\"i_top\">Beskrivelse</p>
                                    <p class=\"b_tekst\">{$beskrivelse}
                                    </p>
                                    <p id=\"i_top\">Ingredients</p>  
                                    <p class=\"b_tekst\">{$ingredienser}</p>
                                </section>
                            </section>  
                        </section>
                    </section>
                    
                    
            
                    
            
                    <script src=\"https://code.jquery.com/ui/1.13.1/jquery-ui.js\" integrity=\"sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=\" crossorigin=\"anonymous\"></script>
                    
            
                     <script>
                        var slideIndex = 1;
                        showSlides(slideIndex);
                        
                        function plusSlides(n) {
                          showSlides(slideIndex += n);
                        }
                        
                        function currentSlide(n) {
                          showSlides(slideIndex = n);
                        }
                        
                        function showSlides(n) {
                          var i;
                          var slides = document.getElementsByClassName(\"Slides\");
                          var dots = document.getElementsByClassName(\"demo\");
                          var captionText = document.getElementById(\"caption\");
                          if (n > slides.length) {slideIndex = 1}
                          if (n < 1) {slideIndex = slides.length}
                          for (i = 0; i < slides.length; i++) {
                              slides[i].style.display = \"none\";
                          }
                          for (i = 0; i < dots.length; i++) {
                              dots[i].className = dots[i].className.replace(\" active\", \"\");
                          }
                          slides[slideIndex-1].style.display = \"block\";
                          dots[slideIndex-1].className += \" active\";
                          captionText.innerHTML = dots[slideIndex-1].alt;
                        }
                        </script>
            
            
                                
                         
                        <footer class=\"footeren\">
                        <section id=\"logo_sosial\"> 
                            <section id=\"logoen_space\">
                                <img class=\"logo\" src=\"nettsideBilder/Original.svg\" height=\"40px\">
                            </section>
                            <section>
                                <ul class=\"sosial\">
                                    <li id=\"sppacen\" class=\"ikon_flytte\"><a href=\"https://www.facebook.com/rhoseg0ld\" target=\"_blank\"><img src=\"nettsideBilder/facebook.png\" height=\"50px\"></a></li>
                                    <li class=\"ikon_flytte\"><a href=\"https://www.instagram.com/rhosegoldbeauty/\" target=\"_blank\"><img src=\"nettsideBilder/instagram.png\" height=\"50px\"></a></li>
                                </ul>
                            </section>
                        </section>
                       
                        <section>
                            <section class=\"info_pages\"> 
                                <a id=\"info_plass\" href=\"about.html\"><p>About</p></a>
                                <a id="info_plass" href="contact.php"><p>Contact</p></a>
                                <a id=\"info_plass\" href=\"faq.html\"><p>FAQ</p></a>
                                <a id=\"info_plass\" href=\"policies.html\"><p>Policies</p></a>
                            </section>
            
                            <section>
                                <form class=\"foorter_inputbutton\" action=\"#\" method=\"post\">
                                    <input placeholder=\"Email\" type=\"text\" required>
                                    <button>Subscribe</button>
                                </form>
                            </section>   
                        </section>
                    </footer>
                </body>
            </html>
            ?>
            
            
            ";

            echo $output;
        }
    }
?>