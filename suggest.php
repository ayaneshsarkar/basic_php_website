<?php 

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/src/Exception.php';
require 'vendor/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
  $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
  $details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

  if ($name == "" || $email == "" || $details == "") {
    echo "Please fill out these fields: Name, Email, Detail";
    exit;
  }

  if ($_POST["address"] != "") {
    echo "Bad form input";
    exit;
  }

  if (!PHPMailer::validateAddress($email)) {
    echo "Invalid Email Address";
    exit;
  }

  $email_body = "";
  $email_body .= "Name: $name\n";
  $email_body .= "Email: $email\n";
  $email_body .= "Details: $details\n";

  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer;

  //Tell PHPMailer to use SMTP
  $mail->isSMTP();
  //Enable SMTP debugging
  // SMTP::DEBUG_OFF = off (for production use)
  // SMTP::DEBUG_CLIENT = client messages
  // SMTP::DEBUG_SERVER = client and server messages
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  //Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
  // use
  // $mail->Host = gethostbyname('smtp.gmail.com');
  // if your network does not support SMTP over IPv6
  //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;
  //Set the encryption mechanism to use - STARTTLS or SMTPS
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  //Whether to use SMTP authentication
  $mail->SMTPAuth = true;
  //Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = 'ayaneshsarkar101@gmail.com';
  //Password to use for SMTP authentication
  $mail->Password = 'ctqwwyprgcaxntlo';

  $mail->setFrom('ayaneshsarkar101@gmail.com', $name);
  $mail->addReplyTo($email, $name);
  $mail->addAddress('ayaneshsarkar101@gmail.com', 'Ayanesh Sarkar');
  $mail->Subject  = 'Library Suggesstion from ' . $name;
  $mail->Body     = $email_body;
  if(!$mail->send()) {
    echo 'Mailer error: ' . $mail->ErrorInfo;
    exit;
  }

  // To do: Send email 
  header("location:suggest.php?status=thanks"); 

}

$pageTitle = "Suggest a Media Item";
$section = 'suggest';

include("inc/header.php");

?>

  <div class="section page">
    <div class="wrapper">
      <h1><?php echo $pageTitle; ?></h1>

    <?php 
    if(isset($_GET["status"]) && isset($_GET["status"]) == "thanks") { 
      echo "<p>Thank You! Thanks for your email, I&rsquo;ll check out your suggesstiomn shortly.</p>";
    } else {
    ?>
      <p>If you think there is something I&rsquo;m missing, let me know! Complete the form to send me an email.</p>
      <form method="post" action="suggest.php">
        <table>
          <tr>
            <th><label for="name">Name:</label></th>
            <td><input type="text" id="name" name="name"></td>
          </tr>
          <tr>
            <th><label for="email">Email</label></th>
            <td><input type="email" id="email" name="email"></td>
          </tr>
          <tr>
            <th><label for="details">Suggest Item Details</label></th>
            <td><textarea name="details" id="details"></textarea></td>
          </tr>
          <tr style="display:none">
            <th><label for="address">Address</label></th>
            <td><input type="text" id="address" name="address"></td>
            <p style="display:none">Please leave this field blank, or you will be banned!</p>
          </tr>
        </table>

        <input type="submit" value="Send">
      </form>
    <?php } ?>

    </div>
  </div>

  <?php include("inc/footer.php"); ?>







