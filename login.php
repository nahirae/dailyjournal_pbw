<?php
//memulai session atau melanjutkan session yang sudah ada
    session_start();

    //menyertakan code dari file koneksi
    include "koneksi.php";

    //check jika sudah ada user yang login arahkan ke halaman admin
    if (isset($_SESSION['username'])) { 
        header("location:admin.php"); 
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    
    //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
    $password = md5($_POST['pass']);

        //prepared statement
    $stmt = $conn->prepare("SELECT username 
                            FROM user 
                            WHERE username=? AND password=?");

        //parameter binding 
    $stmt->bind_param("ss", $username, $password);//username string dan password string
    
    //database executes the statement
    $stmt->execute();
    
    //menampung hasil eksekusi
    $hasil = $stmt->get_result();
    
    //mengambil baris dari hasil sebagai array asosiatif
    $row = $hasil->fetch_array(MYSQLI_ASSOC);

    //check apakah ada baris hasil data user yang cocok
    if (!empty($row)) {
        //jika ada, simpan variable username pada session
        $_SESSION['username'] = $row['username'];

        //mengalihkan ke halaman admin
        header("location:admin.php");
    } else {
        //jika tidak ada (gagal), alihkan kembali ke halaman login
        header("location:login.php");
        $error = "Username atau Password salah!";
    }

        //menutup koneksi database
    $stmt->close();
    $conn->close();
    } else {
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

  <body class="bg-danger-subtle">
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow rounded-5">
                    <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="bi bi-person-circle h1 display-4"></i>
                        <p>Welcome to My Daily Journal</p>
                        <hr />
                    </div>
                    <form action="" method="post">
                        <input
                        type="text"
                        name="user"
                        class="form-control my-4 py-2 rounded-4"
                        placeholder="Username"
                        />
                        <input
                        type="password"
                        name="pass"
                        class="form-control my-4 py-2 rounded-4"
                        placeholder="Password"
                        />
                        <div class="text-center my-3 d-grid">
                        <button class="btn btn-danger rounded-4">Login</button>
                        </div>
                    </form>
                    <!-- Error Message -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center mt-3 rounded-4">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PHP -->
    <?php
    //set variable username dan password dummy
    $username = "admin";
    $password = "123456";
    ?>
    
    <div class="row mt-4" style="padding-bottom: 30px;">
        <div class="col-12 col-sm-5 col-md-3 m-auto">
            <?php 
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                //check apakah username dan password yang di POST sama dengan data dummy
                if ($_POST['user'] == $username && $_POST['pass'] == $password) { ?>
                <div class="alert text-center rounded-5 shadow-sm bg-success-subtle">
                <?php 
                    foreach($_POST as $key => $val){
                        echo $key . " : " . $val ."<br>";
                    }
                    echo '<p class="text-success mb-0"> Username dan Password Benar</p>'; ?>
                </div>
                <?php
                } else { ?>
                    <div class="alert text-center rounded-5 shadow-sm bg-warning-subtle"> 
                    <?php
                    foreach($_POST as $key => $val){
                        echo $key . " : " . $val ."<br>";
                    }
                    echo '<p class="text-danger mb-0"> Username dan Password Salah</p>';
                }
            };
            ?> </div>
        </div>
    </div>
            

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>

<?php
    }
?>