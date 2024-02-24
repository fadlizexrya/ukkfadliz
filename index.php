<!DOCTYPE html>
<html>
<head>
    <title>ukk_fadliz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<br><br><br><br>
<body style="background-color: black;">
    <div class="container">
        <div class="content">
            <div class="card mt-5" style="background-color: #00c9ff;">
                <div class="row" style="background-color: black">
                    <div class="col-6">
                        <div class="card-body" style="background-color: black">
                            <p class="text-center mt-5" style="color: #ffff">Silahkan Masukan Username dan password</p>
                            <?php 
                            if(isset($_GET['pesan'])){
                                if($_GET['pesan']=="gagal"){
                                    echo "<div class='alert' style='color: #fa2555'>USERNAME DAN PASSWORD TIDAK SESUAI !</div>";
                                }
                            }
                            ?>
                            <form method="post" action="cek_login.php">
                                <div class="form-group">
                                    <label style="color: #ffff">Username</label>
                                    <input type="text" class="form-control" name="username">
                                </div>
                                <div class="form-group">
                                    <label style="color: #ffff">password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="form-group mt-3">
                                    <button class="btn btn-outline-info form-control" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-6" style="background-color: black;">
                        <div class="card-body" style="background-color: black">
                            <img src="assets/login2.png" width="300">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>