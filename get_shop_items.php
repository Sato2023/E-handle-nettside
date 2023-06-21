<?php
    include "db.php";

    echo fetchItems($conn);

    function fetchItems($conn) {
        $output = "";
        $query = "SELECT * FROM Produkter ORDER BY ProduktNavn;";
        $stmt = $conn->prepare($query);

        if (isset($_GET['category'])) {
            $temp = "";
            $category = "%{$_GET['category']}%";
            $query = "SELECT * FROM Produkter WHERE Kategori LIKE ? ORDER BY ProduktNavn;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $category);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $produktNavn = $row['ProduktNavn'];
            $produktId = $row['ProduktId'];
            $pris = $row['Pris'];

            $dir = "nettsideBilder/{$produktId}_*";
            $imgs = glob($dir);

            $output .= "<section><a href=\"product.php?produktid={$produktId}\">
            <img src=\"{$imgs[0]}\">";

            if (count($imgs) > 1) {
                $output .= "<img class=\"overlay\" src=\"{$imgs[1]}\">";
            }
            
            $output .= "<p>{$produktNavn}</p>
            <p>{$pris} kr</p>
            </a></section>";    
        }
        return $output; 
    }
?>