<?php
  session_start();
  include("./include/db.php");
  $pdo = connectToDB();
  //If user session doesn't exist, redirect to login
  if(!isset($_SESSION['user_id'])){
      header('Location: index.php#not-logged-in');
  }

  include("./include/templates/header.html");
?>

<main id="container" class="container">
  <div class="heading-wrapper">
    <h2 class="heading">Kasutaja ala</h2>
  </div>
  <div id="response" class="alert" role="alert"></div>
  <form method="POST" action="./ajax_requests/end_session.php" id="end-session-form" class="form">
    <div id="response" class="alert" role="alert"></div>
    <p id="welcome-text">Oled sisse logitud kasutajana <strong><?=getUserName($pdo, $_SESSION['user_id'])?></strong></p>
    <button type="submit" id="end-session" class="button button-session-end ajax-btn">Lõpeta sessioon</button>
  </form>
</main>

<?php
  include("./include/templates/footer.html");
?>