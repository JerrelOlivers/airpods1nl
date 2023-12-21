<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../register/style.css">
</head>
<body>

<div class="header">
    <h1> Register </h1>
</div>
    <form method="post" action="register.php">
        <?php include('errors.php'); ?> 
        <div class="input">
         <label>Username</label> 
         <input type="text" name="username" value="<?php echo $username; ?>">
        </div>

        <div class="input">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input">
            <label>Password</label>
            <input type="password" name="password1">
        </div>
        <div class="input">
            <label>Confirm password</label>
            <input type="password" name="password2">
        </div>
        <div class="input-group">
          <button type="submit" class="btn" name="regUser">Register</button>
        </div>
        <p>
                Already a member? <a href="login.php">Sign in</a>
</p>




    </form>
</body>
</html>