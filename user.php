<?php require_once 'lstart.php';
require_once 'rb.php';
R::setup('mysql:host=localhost;dbname=users','root', 'root');
$user = R::findOne('userstelegram', 'login = ?', array($_SESSION['login']));?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>INPLAY Predict</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
</head>
<body class="bg-white">
  <?php require 'header.php';
    ?>
    <div class="container">
	  <nav>
  <div class="nav nav-tabs pt-4" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-personal" role="tab" aria-controls="nav-home" aria-selected="true">Personal Data</a>
    <a class="nav-link" id="nav-telegram-tab" data-toggle="tab" href="#nav-telegram" role="tab" aria-controls="nav-telegram" aria-selected="false">Telegram</a>
    <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-marketing" role="tab" aria-controls="nav-contact" aria-selected="false">Match History</a>
    <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-delete" role="tab" aria-controls="nav-contact" aria-selected="false">Delete Account</a>
  </div>
</nav>
<div class="tab-content pt-2" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">
  	
  </div>
  <div class="tab-pane fade" id="nav-telegram" role="tabpanel" aria-labelledby="nav-telegram-tab">
  	<h3>Link Telegram Account</h3>
  	<p style="font-size:14px;">Connecting a Telegram account let's you receive instant alerts from INPLAY Prediciton<br>
  		You can choose to get privete message or add the Bot to a group/channel you manage <span class="badge badge-success">Coming soon</span></p>
  	<?php if (!isset($user)): ?>
  	<form action="telegram/link.php" method="GET">
  	<button type="submit" class="btn btn-primary">Link to my account</button>
  </form>
  	<?php else: ?>
  		<button type="button" class="btn btn-success">Connected</button> Username: <b><?php echo '@' . $user->t_name; ?></b><br>
  		<form action="telegram/unlink.php" method="POST">
  		<button type="submit" class="btn btn-danger mt-1">Unlink</button></form>
  		<?php endif; ?>
  </div>
  <div class="tab-pane fade" id="nav-marketing" role="tabpanel" aria-labelledby="nav-marketing-tab">

  	<h3>Match History</h3>
  	







  </div>
  <div class="tab-pane fade" id="nav-delete" role="tabpanel" aria-labelledby="nav-delete-tab">
  	session key: <code><?php echo $_SESSION['uniquekey']; ?></code>
  </div>
</div>
</div>
</body>
</html>