<?php
  session_start();

  //If user session exists, redirect to main page
  if(isset($_SESSION['username'])){
      header('Location: main.php');
  }

  include("./include/templates/header.html");
?>

<main class="container">
  <div class="heading-wrapper">
    <h2 class="heading">Registreeru</h2>
  </div>
  <div id="response" class="alert" role="alert"></div>
  <form method="post" action="./ajax_requests/register.php" id="register-form" class="form">
    <label for="username" class="form-label">Kasutajanimi</label>
    <input type="text" class="form-input" name="username" id="username" placeholder="Sisesta kasutajanimi">
    <button type="submit" class="button button-primary ajax-btn" id="register">Registreeru</button>
    <a href="index.php" class="bottom-link">Kasutaja juba olemas?</a>
  </form>
</main>

<?php
  include("./include/templates/footer.html");
?>