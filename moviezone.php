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
                    $userName = $_SESSION['username'];
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
                
                $age = "SELECT age_verification FROM users WHERE username = '$userName'";
                $ageResult = mysqli_query($db,$age);

                while($row = mysqli_fetch_assoc($ageResult)){
                    $age = $row['age_verification'];
                    if ($age == 0){
                        $sql13 = "SELECT fName, redirectLink FROM recommended WHERE pg = 'PG 13'";
                        $result13 = mysqli_query($db,$sql13);

                        while($row = mysqli_fetch_assoc($result13)){
                            $file = $row['fName'];
                            $link = $row['redirectLink']
                            ?>
                            
                            <?php echo "<a href='".$link."'>" ?>
                                <?php echo "<img src ='".$file."' alt='img'>" ?>
                            <?php echo "</a>" ?>
                            

                        <?php } 
                    }
                    elseif($age == 1){
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
                    }
                }
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
        <h3 class="no-title">Action Movies</h3>
        <div class="no">
            <?php
            $sql = "SELECT fName, redirectLink FROM `moviedetails` WHERE `ganre1` = 'Action' OR `ganre2` = 'Action'";
            $result = mysqli_query($db,$sql);
            
            while($row = mysqli_fetch_assoc($result)){
                $file = $row['fName'];
                $link = $row['redirectLink']
                ?>
                <?php echo "<a href='".$link."'>" ?>
                    <?php echo "<img src ='".$file."' alt=''>" ?>
                <?php echo "</a>" ?>
            <?php }
            ?>
        </div>
    </div>

    <div class="original1">
        <h3 class="no-title">Sci-Fi Movies</h3>
        <div class="no">
            <?php
            $sql = "SELECT fName, redirectLink FROM `moviedetails` WHERE `ganre1` = 'Sci-Fi' OR `ganre2` = 'Sci-Fi'";
            $result = mysqli_query($db,$sql);
            
            while($row = mysqli_fetch_assoc($result)){
                $file = $row['fName'];
                $link = $row['redirectLink']
                ?>
                <?php echo "<a href='".$link."'>" ?>
                    <?php echo "<img src ='".$file."' alt=''>" ?>
                <?php echo "</a>" ?>
            <?php }
            ?>
        </div>
    </div>

    <div class="original1">
        <h3 class="no-title">Comedy Movies</h3>
        <div class="no">
            <?php
            $sql = "SELECT fName, redirectLink FROM `moviedetails` WHERE `ganre1` = 'Comedy' OR `ganre2` = 'Comedy'";
            $result = mysqli_query($db,$sql);
            
            while($row = mysqli_fetch_assoc($result)){
                $file = $row['fName'];
                $link = $row['redirectLink']
                ?>
                <?php echo "<a href='".$link."'>" ?>
                    <?php echo "<img src ='".$file."' alt=''>" ?>
                <?php echo "</a>" ?>
            <?php }
            ?>
        </div>
    </div>

    <div class="original1">
        <h3 class="no-title">Adventure Movies</h3>
        <div class="no">
            <?php
            $sql = "SELECT fName, redirectLink FROM `moviedetails` WHERE `ganre1` = 'Adventure' OR `ganre2` = 'Adventure'";
            $result = mysqli_query($db,$sql);
            
            while($row = mysqli_fetch_assoc($result)){
                $file = $row['fName'];
                $link = $row['redirectLink']
                ?>
                <?php echo "<a href='".$link."'>" ?>
                    <?php echo "<img src ='".$file."' alt=''>" ?>
                <?php echo "</a>" ?>
            <?php }
            ?>
        </div>
    </div>

    <div class="original1">
        <h3 class="no-title">Horror Movies</h3>
        <div class="no">
            <?php
            $sql = "SELECT fName, redirectLink FROM `moviedetails` WHERE `ganre1` = 'Horror' OR `ganre2` = 'Horror'";
            $result = mysqli_query($db,$sql);
            
            while($row = mysqli_fetch_assoc($result)){
                $file = $row['fName'];
                $link = $row['redirectLink']
                ?>
                <?php echo "<a href='".$link."'>" ?>
                    <?php echo "<img src ='".$file."' alt=''>" ?>
                <?php echo "</a>" ?>
            <?php }
            ?>
        </div>
    </div>
</body>
</html>