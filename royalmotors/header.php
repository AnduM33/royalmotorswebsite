<div class="container">
    <div class="navbar">
        <div class="logo">
            <img src="images/royal-motors-logo.svg" width="175px">
        </div>
        <nav>
            <ul>
                <li><input type="text" placeholder="Search for cars..."></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Buy</a></li>
                <li><a href="sell.html">Sell</a></li>
                <li><a href="about-us.html">About Us</a></li>
                
                <?php
                    if($authenticated==false){
                        echo"<li><a href=\"register.php\">Sign Up</a></li>";
                        echo"<li><a href=\"login.php\">Log In</a></li>";
                    }else{
                        echo"<li><a href=\"logout.php\">Log Out</a></li>";
                        echo"<li><img src=\"images/user.png\" width=30px align=center></li>";
                    }
                ?>
                
            </ul>
        </nav>
    </div>
</div>