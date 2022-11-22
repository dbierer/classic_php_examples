<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>


<form action="index.php" method="post" enctype="multipart/form-data">
    <p>Your name: <input type="text" name="username" /><span class='error'>* <?= (!empty($error['username'])) ? $error['username'] : ''; ?></span></p>
    <p>Your e-mail: <input type="text" name="email" /><span class='error'>* <?= (!empty($error['email'])) ? $error['email'] : ''; ?></span></p>
    <p>Your password: <input type="text" name="password" /><span class='error'>* <?= (!empty($error['password'])) ? $error['password'] : ''; ?></span></p>
    <p>File: <input type="file" name="upload" /></p>
    <p><input type="submit" /></p>
</form>

<p style="color: black"> Username: <?= $username; ?>
<p style="color: black"> E-Mail <?= $email; ?>
<p style="color: red"> Password: <?= str_repeat('*', 8); ?> </p>
<?= (!empty($error)) ? implode('<br />', $error) : ''; ?>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>