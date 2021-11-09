<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | My Library</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css">
</head>


<body id="bg-login">
<body>
      <center>
        <h1>Login</h1>
		<br>
		<h3>| My Library |</h3>
      <center>
		  <br>
    <div class="box-login">
      <!--<h2>Login</h2>-->

        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="Password" class="input-control">
            <input type="submit" name="submit" value="Login" class="btn">
        </form>
        <?php 	
			if(isset($_POST['submit'])){
				session_start();
				include 'koneksi.php';

				$user = mysqli_real_escape_string($koneksi, $_POST['user']);
				$pass = mysqli_real_escape_string($koneksi, $_POST['pass']);

				$cek = mysqli_query($koneksi, "SELECT * FROM tb_login WHERE username = '".$user."' AND password = '".md5($pass)."'");
				if(mysqli_num_rows($cek) > 0){
					$d = mysqli_fetch_object($cek);
					$_SESSION['status_login'] = true;
					$_SESSION['a_global'] = $d;
					$_SESSION['id'] = $d->admin_id;
					echo '<script>window.location="index.php"</script>';
				}else{
					echo '<script>alert("Username atau password Anda salah!")</script>';
				}

			}
        ?>
		
    </div>
</body>
</html>