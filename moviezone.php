<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/moviezone.css">
    <link rel="icon" href="images/nficon.ico">
    <title>Netflix Clone Called Netfiliz!</title>
</head>
<body>
    <section class="container">
        <div class="head">
            <img src="images/netflixlogo.png" alt="">
            <div class="user-info">
                <span>Welcome, 
                    <?php 
                    session_start();
                    if (!isset($_SESSION['username'])) {
                        header("Location: login.php");
                    }
                    echo $_SESSION['username']; 
                    ?>
                </span>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </section>
    
    <div class="original1">
        <h3 class="no-title">Recommended</h3>
        <div class="no">

            <?php
                require_once 'connect.php';
                
                $sql = "SELECT fName, redirectLink FROM recommended";
                $result = mysqli_query($db,$sql);

                while($row = mysqli_fetch_assoc($result)){
                    $file = $row['fName'];
                    $link = $row['redirectLink']
                    ?>
                    
                    <?php echo "<a href='".$link."'>" ?>
                        <?php echo "<img src ='".$file."' alt='img'>" ?>
                    <?php echo "</a>" ?>
                    
                <?php }
                ?>
        </div>
    </div>

    <div class="original">
        <h3 class="no-title">My Watch List</h3>
        <div class="no">

            <?php
                $sql = "SELECT fName, redirectLink FROM watchlist";
                $result = mysqli_query($db,$sql);

                while($row = mysqli_fetch_assoc($result)){
                    $file = $row['fName'];
                    $link = $row['redirectLink']
                    ?>
                    
                    <?php echo "<a href='".$link."'>" ?>
                        <?php echo "<img src ='".$file."' alt='img'>" ?>
                    <?php echo "</a>" ?>
                    
                <?php }
                ?>

        </div>
    </div>

    <div class="original1">
        <h3 class="no-title">Comedy Movies</h3>
        <div class="no">
            <img src="assests/co1.jpg" alt="">
            <img src="assests/co2.jpg" alt="">
            <img src="assests/co3.png" alt="">
            <img src="assests/co4.jpg" alt="">
            <img src="assests/co5.jpg" alt="">
            <img src="assests/co6.jpg" alt="">
            <img src="assests/co7.jpg" alt="">
            <img src="assests/co8.jpg" alt="">
            <img src="assests/poster1.jpg" alt="">
            <img src="assests/ro4.jpg" alt="">
            <img src="assests/poster22.jpeg" alt="">
            <img src="assests/poster18.jpg" alt="">
            <img src="assests/poster5.jfif" alt="">
            <img src="assests/poster6.jpg" alt="">
            <img src="assests/poster7.jfif" alt="">
            <img src="assests/poster1.jpg" alt="">
            <img src="assests/poster3.jfif" alt="">
            <img src="assests/poster10.jfif" alt="">
        </div>
    </div>

    <div class="original1">
        <h3 class="no-title">Romantic Movies</h3>
        <div class="no">
            <img src="assests/ro1.jpg" alt="">
            <img src="assests/ro2.jpg" alt="">
            <img src="assests/ro3.jpg" alt="">
            <img src="assests/ro4.jpg" alt="">
            <img src="assests/ro6.jpg" alt="">
            <img src="assests/ro7.jpg" alt="">
            <img src="assests/ro8.jpg" alt="">
            <img src="assests/poster1.jpg" alt="">
            <img src="assests/poster22.jpeg" alt="">
            <img src="assests/co7.jpg" alt="">
            <img src="assests/co4.jpg" alt="">
            <img src="assests/co3.png" alt="">
            <img src="assests/poster7.jfif" alt="">
            <img src="assests/co8.jpg" alt="">
            <img src="assests/poster7.jfif" alt="">
            <img src="assests/poster1.jpg" alt="">
            <img src="assests/poster3.jfif" alt="">
            <img src="assests/poster10.jfif" alt="">
        </div>
    </div>
    <div class="original1">
        <h3 class="no-title">Action Movies</h3>
        <div class="no">
            <img src="assests/poster13.jpg" alt="">
            <img src="assests/poster14.jpg" alt="">
            <img src="assests/poster19.jpg" alt="">
            <img src="assests/poster16.jpg" alt="">
            <img src="assests/poster17.jpg" alt="">
            <img src="assests/poster18.jpg" alt="">
            <img src="assests/poster20.jpg" alt="">
            <img src="assests/poster12.jfif" alt="">
            <img src="assests/poster22.jpeg" alt="">
            <img src="assests/poster10.jfif" alt="">
            <img src="assests/poster11.jfif" alt="">
            <img src="assests/poster12.jfif" alt="">
            <img src="assests/poster5.jfif" alt="">
            <img src="assests/poster6.jpg" alt="">
            <img src="assests/poster7.jfif" alt="">
            <img src="assests/poster1.jpg" alt="">
            <img src="assests/poster19.jpg" alt="">
            <img src="assests/poster10.jfif" alt="">
        </div>
    </div>

</body>
</html>