<?php
include "koneksi.php"; 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Journal</title>
    <link rel="icon" href="img/icon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"/>
  </head>

  <body>
    <!-- nav -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
          <a class="navbar-brand" href="#">My Daily Journal</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#article">Article</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#schedule">Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#aboutme">About Me</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" target="_blank">Login</a>
                </li>
                <i id="light" class="bi bi-brightness-high btn btn-outline-secondary"></i>
                <i id="dark" class="bi bi-moon-stars-fill btn btn-dark"></i>
            </ul>
          </div>
        </div>
    </nav>

    <!-- hero -->
    <section id="hero" class="text-center p-5 bg-danger-subtle text-sm-start">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="https://i.pinimg.com/564x/f1/28/90/f12890466436d87295dd44c20086cb0c.jpg" class="img-fluid" width="300" style="border-radius: 20%;">
                <div>
                    <h2 class="fw-bold display-4">Capture Spells, Chronicle Secrets, Every Day at Hogwarts. </h2>
                    <h5 class="lead display-6" style="font-size: 32px;" >Mencatat semua kegiatan sehari - hari yang ada tanpa terkecuali. 
                        As a Slytherin student at Hogwarts school, hari-hariku dipenuhi ramuan misterius!</h5>
                    <br>
                    <h6>
                        <span id="tanggal"></span>
                        <span id="jam"></span>
                    </h6>
                </div>
            </div>
        </div>
    </section>


     <!-- article begin -->
    <section id="article" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">article</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
          <?php
          $sql = "SELECT * FROM article ORDER BY tanggal DESC";
          $hasil = $conn->query($sql); 

          while($row = $hasil->fetch_assoc()){
          ?>
            <div class="col">
              <div class="card h-100">
                <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title"><?= $row["judul"]?></h5>
                  <p class="card-text">
                    <?= $row["isi"]?>
                  </p>
                </div>
                <div class="card-footer">
                  <small class="text-body-secondary">
                    <?= $row["tanggal"]?>
                  </small>
                </div>
              </div>
            </div>
            <?php
          }
          ?> 
        </div>
      </div>
    </section>
    <!-- article end -->
    
    <!-- gallery -->
    <section id="gallery" class="text-center p-5 bg-danger-subtle">
        <div class="container">
            <h1 class="fw-bold display-4">Gallery</h1> <br>
            <div id="carouselExample" class="carousel slide d-flex justify-content-center">
                <div class="carousel-inner" style="width: 50%;">
                  <div class="carousel-item active">
                    <img src="https://i.pinimg.com/564x/c5/5a/dd/c55add0f33ff22440682f119d571de84.jpg" class="d-block w-100" alt="hogwarts life">
                  </div>
                  <div class="carousel-item">
                    <img src="https://i.pinimg.com/564x/19/81/cd/1981cd32d2af5ed0fdb77bc3da5d3f5e.jpg" class="d-block w-100" alt="hogwarts life">
                  </div>
                  <div class="carousel-item">
                    <img src="https://i.pinimg.com/564x/e9/89/26/e98926953e2515737a2c2c3656dcb904.jpg" class="d-block w-100" alt="hogwarts life">
                  </div>
                  <div class="carousel-item">
                    <img src="img\hogwarts life.png" class="d-block w-100" alt="hogwarts life">
                  </div>
                  <div class="carousel-item">
                    <img src="https://i.pinimg.com/564x/9e/78/25/9e78255cf8d837e82468e55618c15648.jpg" class="d-block w-100" alt="hogwarts life">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- article -->
    <section id="schedule" class="text-center p-5">
      <div class="container">
          <h1 class="fw-bold display-5">Schedule</h1> <br>
          <div>
              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
                  <div class="col">
                      <div class="card h-100 shadow-sm">
                          <div class="card-header bg-danger text-white">
                              <h5 class="card-title m-0">SENIN</h5>
                          </div>
                          <div class="card-body">
                              <p class="card-text">Probabilitas dan Statistik</p>
                              <p class="card-text">12.30 - 15.00 | H.4.7</p>
                              <hr>
                              <p class="card-text">Rekayasa Perangkat Lunak</p>
                              <p class="card-text">15.00 - 18.00 | H.4.6</p>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card h-100 shadow-sm">
                          <div class="card-header bg-danger text-white">
                              <h5 class="card-title m-0">SELASA</h5>
                          </div>
                          <div class="card-body">
                              <p class="card-text">Sistem Operasi</p>
                              <p class="card-text">09.30 - 12.00 | H.3.11</p>
                              <hr>
                              <p class="card-text">Logika Informatika</p>
                              <p class="card-text">15.30 - 18.00 | H.4.5</p>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card h-100 shadow-sm">
                          <div class="card-header bg-danger text-white">
                              <h5 class="card-title m-0">RABU</h5>
                          </div>
                          <div class="card-body">
                              <p class="card-text">Penambangan Data</p>
                              <p class="card-text">09.30 - 12.00 | H.4.9</p>
                              <hr>
                              <p class="card-text">Basis Data (P)</p>
                              <p class="card-text">14.10 - 15.50 | D.3.M</p>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card h-100 shadow-sm">
                          <div class="card-header bg-danger text-white">
                              <h5 class="card-title m-0">KAMIS</h5>
                          </div>
                          <div class="card-body">
                              <p class="card-text">Pemrograman Berbasis Web</p>
                              <p class="card-text">12.00 - 14.10 | D.2.J</p>
                              <hr>
                              <p class="card-text">Kriptografi</p>
                              <p class="card-text">15.00 - 18.00 | H.4.7</p>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card h-100 shadow-sm">
                          <div class="card-header bg-danger text-white">
                              <h5 class="card-title m-0">JUMAT</h5>
                          </div>
                          <div class="card-body">
                              <p class="card-text">Basis Data (T)</p>
                              <p class="card-text">10.20 - 12.00 | H.5.5</p>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card h-100 shadow-sm">
                          <div class="card-header bg-danger text-white">
                              <h5 class="card-title m-0">SABTU</h5>
                          </div>
                          <div class="card-body">
                              <p class="card-text">FREE</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>

    <!-- about me -->
    <section id="hero" class="text-center p-5 bg-danger-subtle text-sm-start">
        <div id="aboutme" class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <div id="profiledetail">
                    <h5 class="lead display-10">A11.2023.15212</h5>
                    <h2 class="fw-bold display-6">Naya Nasywa Puspita Haryanto</h2>
                    <h5 class="lead display-10">Program Studi Teknik Informatika</h5>
                    <a href="https://dinus.ac.id/" style="text-decoration: none;">
                        <h5 class="fw-bold display-10 text-dark" >Universitas Dian Nuswantoro</h5>
                    </a>
                    <br>
                </div>
                <div id="profile" onclick="toggleProfile()">
                    <img src="https://i.pinimg.com/564x/db/38/63/db3863cf592a9210e5b207c56607d97d.jpg" class="img-fluid p-5" width="400" style="border-radius: 100%;">
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="text-center p-5"> 
        <div>
            <a href="https://www.instagram.com/hiraetna.aya/?utm_source=ig_web_button_share_sheet"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
            <a href="https://wa.me/087845191811"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
            <a href="https://x.com/harrypotter"><i class="bi bi-twitter-x h2 p-2 text-dark"></i></a>
        </div>
        <br>
        <div>
            Naya Nasywa Puspita Haryanto &copy; 2024
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
      window.setTimeout("tampilWaktu()", 1000);

      function tampilWaktu() {
        var waktu = new Date();
        var bulan = waktu.getMonth() + 1;

        setTimeout("tampilWaktu()", 1000);
        document.getElementById("tanggal").innerHTML =
          waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
        document.getElementById("jam").innerHTML =
          waktu.getHours() +
          ":" +
          waktu.getMinutes() +
          ":" +
          waktu.getSeconds();
      }

      //DARK MODE SWITCHER
      const toggleLight = document.getElementById("light"); 
      const toggleDark = document.getElementById("dark");

      // Fungsi untuk mengaktifkan Dark Mode
      function enableDarkMode() {
        document.body.classList.add("bg-dark", "text-light"); 
        document.querySelectorAll(".card").forEach((el) => {
          el.classList.add("bg-black", "text-light");
        });
        document.querySelectorAll(".text-body-secondary").forEach((el) => {
          el.classList.add("text-light");
        });
        document.querySelectorAll(".text-dark").forEach((el) => {
          el.classList.replace("text-dark", "text-light");
        });
        document.querySelectorAll(".btn-outline-secondary").forEach((el) => {
          el.classList.replace("btn-outline-secondary", "btn-light");
        });
        document.querySelectorAll(".bg-danger-subtle").forEach((el) => {
          el.classList.replace("bg-danger-subtle", "bg-secondary"); // Ganti dengan kelas abu-abu
          el.classList.add("text-light");
        });
      
        toggleLight.style.display = "inline";
        toggleDark.style.display = "none";
      }

      // Fungsi untuk menonaktifkan Dark Mode
      function disableDarkMode() {
        document.body.classList.remove("bg-dark", "text-light");
        document.querySelectorAll(".card").forEach((el) => {
          el.classList.remove("bg-black", "text-light");
        });
        document.querySelectorAll(".text-light").forEach((el) => {
          el.classList.replace("text-light", "text-dark");
        });
        document.querySelectorAll(".btn-light").forEach((el) => {
          el.classList.replace("btn-light", "btn-outline-secondary");
        });
        document.querySelectorAll(".bg-secondary").forEach((el) => {
          el.classList.replace("bg-secondary", "bg-danger-subtle");
          el.classList.remove("text-light");
        });
        
        toggleLight.style.display = "none";
        toggleDark.style.display = "inline"; //profiledetail
      }

      // hide profile
      function toggleProfile(){
        const profiledetail = document.getElementById("profiledetail");
        const profile = document.getElementById("profile");
         if(profiledetail.style.display === "none"){
            profiledetail.style.display = "block";
            profile.style.transform = "translateX(-10px)";
         } else {
            profiledetail.style.display = "none";
            profile.style.transform = "translateX(-350px)";
         }
      }

      // Event listener untuk tombol toggle
      toggleDark.addEventListener("click", enableDarkMode);
      toggleLight.addEventListener("click", disableDarkMode);

      // Sembunyikan tombol "light" saat mode default terang
      toggleLight.style.display = "none";
    </script>
  </body>
</html>