<?php
require_once 'vendor/autoload.php';

use RobThree\Auth\TwoFactorAuth;

$secret = 'HXV5XXQOPIFRNKEL';// Your secret key. This should be stored in your database for the user

$user= [
  'name' => 'Foxx Azalea Pinkerton',
  'email' => 'foxx@foxxything.com'
];

$tfa = new TwoFactorAuth('My Company');

if (isset($_POST['code'])) {
  $code = $_POST['code'];
  $valid = $tfa->verifyCode($secret, $code);
  if ($valid) {
    echo 'Code is valid!';
  } else {
    echo 'Code is invalid!';
  }
}
$qrCodeUrl = $tfa->getQRCodeImageAsDataUri($user['name'].' ('.$user['email'].')', $secret);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST" >
    <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code" />
    <input type="text" name="code" placeholder="Enter code" />
    <input type="submit" value="Verify" />
  </form>
</body>
</html>

<?php

