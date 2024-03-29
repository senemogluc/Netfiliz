<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/details-style.css">
  <link rel="icon" href="../images/nico.png">
  <title>Netflix Clone Called Netfiliz!</title>
  <body>
  <section class="movie-detail">
        <div class="container">
          
        <?php
                require_once 'connect.php';
                $sql = "SELECT * FROM `moviedetails` WHERE `movieName` LIKE 'Star Wars: The Phantom Menace'";
                $result = mysqli_query($db,$sql);

                while($row = mysqli_fetch_assoc($result)){
                  $name = $row['movieName'];
                  $pg = $row['pg'];
                  $ganre1 = $row['ganre1'];
                  $ganre2 = $row['ganre2'];
                  $year = $row['releaseYear'];
                  $duration = $row['duration'];
                  $story = $row['storyLine'];
                  $file = $row['fName'];
                  $link = $row['redirectLink'];
                  ?>
              

          <figure class="movie-detail-banner">

          <?php echo "<img src ='".$file."' alt='img'>" ?>

            <button class="play-btn">
              <ion-icon name="play-circle-outline"></ion-icon>
            </button>
          </figure>
          <div class="movie-detail-content">
            <h1 class="h1 detail-title">
              <?php echo "Yıldız Savaşları: Gizli Tehlike" ?>
            </h1>
            <div class="meta-wrapper">
              <div class="badge-wrapper">
                <div class="badge badge-fill"><?php echo "$pg"?></div>

                <div class="badge badge-outline">HD</div>
              </div>
              <div class="ganre-wrapper">
                <a href="#"><?php echo "Aksiyon"?></a>
                <a href="#"><?php echo "Bilim Kurgu"?></a>
              </div>
              <div class="date-time">
                <div>
                  <ion-icon name="calendar-outline"></ion-icon>

                  <time datetime="2021"><?php echo "$year"?></time>
                </div>
                <div>
                  <ion-icon name="time-outline"></ion-icon>

                  <time datetime="PT115M"><?php echo "$duration"?></time>
                </div>
              </div>
            </div>
            <p class="storyline">
            <?php echo "İki Jedi, müttefik bulmak için düşmanca bir ablukadan kaçar ve Güce denge getirebilecek genç bir çocukla karşılaşır, ancak uzun süredir uykuda olan Sith, orijinal ihtişamını geri almak için yeniden ortaya çıkar."?>
            </p>
            <?php }
              ?>

              <?php
                if(isset($_POST['Add'])){
                  $query = "INSERT INTO watchlist (movieName, fName, redirectLink) VALUES ('$name', '$file','$link')";
                  mysqli_query($db, $query);
                  header("Location: moviezone.php");
                }
                elseif(isset($_POST['Remove'])){
                  $query = "DELETE FROM watchlist WHERE `watchlist`.`movieName` = '$name'";
                  mysqli_query($db, $query);
                  header("Location: moviezone.php");
                }
                elseif(isset($_POST['Dislike'])){
                  $query = "DELETE FROM recommended WHERE `recommended`.`movieName` = '$name'";
                  mysqli_query($db, $query);
                  header("Location: moviezone.php");
                }
              ?>

            <div class="details-actions">

              <button class="btn btn-primary">
                <ion-icon name="add-circle-outline"></ion-icon>
                <form method="post">
                  <input class="btn btn-primary" type="submit" name="Add" value='Ekle'>
                </form>
              </button>
              
              <button class="btn btn-primary">
                <ion-icon name="remove-circle-outline"></ion-icon>
                <form method="post">
                  <input class="btn btn-primary" type="submit" name="Remove" value='Sil'>
                </form>
              </button>
              
              <button class="btn btn-primary">
                <ion-icon name="heart-dislike-outline"></ion-icon>
                <form method="post">
                  <input class="btn btn-primary" type="submit" name="Dislike" value='Önerme'>
                </form>
              </button>

            </div>
          </div>
        </div>
      </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>