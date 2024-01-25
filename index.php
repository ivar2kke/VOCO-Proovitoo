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
    <h2 class="heading">Logi sisse</h2>
  </div>
  <div id="response" class="alert" role="alert"></div>
  <form method="post" action="./ajax_requests/login.php" id="login-form" class="form">
    <label for="username" class="form-label">Kasutajanimi</label>
    <input type="text" class="form-input" name="username" id="username" placeholder="Sisesta kasutajanimi">
    <button type="submit" class="button button-primary ajax-btn" id="login"><span>Sisene</span></button>
    <a href="register.php" class="bottom-link">Pole veel kasutajat?</a>
  </form>
</main>

<?php
  include("./include/templates/footer.html");
?>

