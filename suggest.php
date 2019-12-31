<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = $_POST["name"];
  $email = $_POST["email"];
  $details = $_POST["details"];

  echo "<pre>";
  $email_body = "";
  $email_body .= "Name: $name\n";
  $email_body .= "Email: $email\n";
  $email_body .= "Details: $details\n";
  echo $email_body;
  echo "</pre>";

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
        </table>

        <input type="submit" value="Send">
      </form>
    <?php } ?>

    </div>
  </div>

  <?php include("inc/footer.php"); ?>







