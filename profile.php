<?php
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

?>
<div class="container">
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="password">Ganti Password:</label>
            <input type="password" class="form-control mt-2" id="password"
                placeholder="Tuliskan Password Baru Jika Ingin Mengganti Password Saja" name="password">
        </div>
        <div class="form-group">
            <label for="profile_picture" class="mt-3">Ganti Foto Profile:</label>
            <input type="file" class="form-control mt-2" id="profile_picture" name="profile_picture">
        </div>
        <div class="d-flex flex-column mb-4">
            <label for="" class="mt-3">Foto Profil Saat Ini</label>
            <img src="img/<?= $user['foto'] ?>" alt="Foto Profil" class="mt-2" width="150">
            <input type="hidden" name="foto_lama" value="<?= $user['foto'] ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
    </form>
</div>

<?php

include 'upload_foto.php';

if (isset($_POST['simpan'])) {
    $password = $_POST['password'] ? md5(trim($_POST['password'])) : '';
    $foto = '';
    $nama_foto = $_FILES['profile_picture']['name'];

    // Jika ada file foto yang diunggah
    if ($nama_foto != '') {
        $cek_upload = upload_foto($_FILES['profile_picture']);
        if ($cek_upload['status']) {
            $foto = $cek_upload['message'];
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                    document.location='admin.php?page=profile';
            </script>";
            die();
        }
    }

    // Cek apakah ada ID yang dikirimkan dari form
    if (isset($user['id'])) {
        // Update data user berdasarkan ID
        $id = $user['id'];

        if ($nama_foto == '') {
            $foto = $_POST['foto_lama']; // Jika tidak ada file foto baru, gunakan foto lama
        } else {
            unlink('img/' . $_POST['foto_lama']); // Hapus foto lama jika ada file foto baru
        }

        // Cek apakah password diisi
        if ($password != '') {
            // Update termasuk password
            $stmt = $conn->prepare("UPDATE user 
                                    SET 
                                    password =?,
                                    foto =?
                                    WHERE id = ?");
            $stmt->bind_param('ssi', $password, $foto, $id);
        } else {
            // Update tanpa mengubah password
            $stmt = $conn->prepare("UPDATE user 
                                    SET 
                                    foto =?
                                    WHERE id = ?");
            $stmt->bind_param('si', $foto, $id);
        }

        $simpan = $stmt->execute();
    } else {
        // Insert data baru ke tabel user
        $stmt = $conn->prepare("INSERT INTO user (password, foto) VALUES (?, ?)");
        $stmt->bind_param('ss', $password, $foto);
        $simpan = $stmt->execute();
    }

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
                document.location='admin.php?page=profile';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
                document.location='admin.php?page=profile';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

?>