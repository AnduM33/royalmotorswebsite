<?php
    if(isset($_GET['ID'])){
        require "connect.php";

        $ID = mysqli_real_escape_string($conn, $_GET['ID']);
        $sql = "SELECT * FROM available_cars WHERE car_id='$ID'";
        $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
        $row = mysqli_fetch_array($result);

    }else{
        header('Location: products.php');
    }
    

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
            <div class="grid">
                <div class="column-2">
                    <div class="slideshow-container">

                        <?php 
                            for($i = 1; $i <= 3; $i++){
                                echo "<img class=\"slideshow-image\" src=\"images/{$row['image_id']}{$row['car_manufacturer']}-{$i}.jpg\">";
                            }
                        
                        ?>

                        <a class="left-slide" onclick="plusDivs(-1)">&#10094;</a>
                        <a class="right-slide" onclick="plusDivs(1)">&#10095;</a>
                    </div>
                    

                    <script>
                        var slideIndex = 1;
                        showDivs(slideIndex);

                        function plusDivs(n) {
                            showDivs(slideIndex += n);
                        }

                        function showDivs(n) {
                            var i;
                            var x = document.getElementsByClassName("slideshow-image");
                            if (n > x.length) {slideIndex = 1}
                            if (n < 1) {slideIndex = x.length}
                            for (i = 0; i < x.length; i++) {
                                x[i].style.display = "none";  
                            }
                            x[slideIndex-1].style.display = "block";  
                        }
                        
                    </script>
                </div>
                <div class="column-2">
                    <h1><?php echo $row['car_manufacturer'] . ' ' . $row['car_model']  ?></h1>
                    <h4>Price: <?php echo $row['price']  ?>$</h4>
                    <h4>Time left: <?php echo $row['time_left']  ?> hours</h4>
                </div>
            </div>



            <div class="column-2">
                <h4>McLaren 720S specs</h4>
            <p>Price in Europe	€247,350 - €357,920<br>
                Car type	Coupe<br>
                Curb weight	1419-1437 kg (3128-3168 lbs)<br>
                Introduced	2017<br>
                Origin country	United Kingdom<br>
                Gas mileage	43.7-9.6 l/100 km (5-25 mpg US / 6-29 mpg UK)
            </p>
            <h4>General performance</h4>
            <p>
                Top speed	348 kph (216 mph)<br>
                0 - 100 mph - 0	10.0 s<br>
                Est. max acceleration	1.02 g (10 m/s²)<br>
                18m slalom	73.6 kph (45.7 mph)<br>
                Emissions	319 g/km<br>
                Lateral acceleration	1.09 g (11 m/s²)
            </p>
            <h4>Powertrain specs</h4>
            <p>
                Engine type	twin-turbocharged V8<br>
                Displacement	4.0 l (244 ci)<br>
                Power	720 ps (710 bhp / 529 kw) @ 7500 rpm<br>
                Torque	770 Nm (568 lb-ft) @ 5500 rpm<br>
                Power / liter	180 ps (178 hp)<br>
                Power / weight	504 ps (497 bhp) / t<br>
                Torque / weight	539 Nm (398 lb-ft) / t<br>
                Efficiency	37 PS per l/100 km<br>
                Power / €5000	13 ps<br>
                Transmission	7 Speed SSG<br>
                Layout	middle engine, rear wheel drive
            </p>
            </div>
        </div>
    </body>

    <footer>
        <!--------- footer -------->
        <template-footer></template-footer>
    </footer>
</html>