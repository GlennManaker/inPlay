<div class="container-fluid">
<nav class="navbar navbar-dark bg-secondary">
  <a class="navbar-brand" href="index.php"><span class="badge badge-success">INPLAY</span> <b>PREDICTION</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="strategy.php">Strategy</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li>
        <li class="nav-item active">
        <a class="nav-link" href="publicapi.php">Public API</a>
      </li>
      <li class="nav-item active">
        <?php if (isset($_SESSION['login'])): ?>
  <a class="nav-link" href="user.php">
    <?php echo $_SESSION['login']; ?>
  </a>
        <?php else: ?>
        <a class="nav-link" id="signModal" href="#">Sign In</a>
        <?php endif ?>
      </li>
    </ul>
  </div>
</nav>
</div>
<div class="modal fade" id="SignInModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SIGN IN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="login.php" method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Login:</label>
            <input type="text" class="form-control" name="login">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Password:</label>
            <input type="password" class="form-control" name="password">
          </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Sign In</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#signModal").click(function(){
    $("#SignInModal").modal();
  });
});
</script>