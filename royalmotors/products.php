<?php
    require "connect.php";

    $sql = "SELECT * FROM available_cars";
    $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Royal Motors Auction House</title>
        <link rel="stylesheet" href="style.css">

        <script type="module" src="template.js"></script>

        <!--------- header -------->
        <template-header></template-header>

    </head>
    <body>
        
        <!--------- dynamic section -------->
        <div class="small-container">
            <h1>All Available Auctions</h1>
            <div class="grid">
                <?php
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result)){
                            echo"<div class=\"product\">\n";
                            echo"<a href=\"product-details.php?ID={$row['car_id']}\"><img src=\"images/{$row['image_id']}{$row['car_manufacturer']}-Sq.jpg\"></a>\n";
                            echo"<h4>{$row['car_manufacturer']} {$row['car_model']}</h4>\n";
                            echo"<p>Price: {$row['price']}$</p>\n";
                            echo"<p>Time left: {$row['time_left']} hours</p>\n";
                            echo"</div>\n";
                        }
                    }else{
                        echo"<h2>No Images to display</h2>";
                    }
                ?>

            </div>
        </div>
        
    </body>

    <footer>
        <!--------- footer -------->
        <template-footer></template-footer>
    </footer>

</html>