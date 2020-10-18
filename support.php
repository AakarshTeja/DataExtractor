<?php include 'include/header.php'; ?>
<div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Welcome to Data Extractor Support</h1>
          <p>We as a quality service thrive to support our consumers.So please contact us through Mail.
             Our mail Id is <strong>aaaa@aaaa.com</strong>. Or click on below link to redirect to your mail application.</p>
          <p><a class="btn btn-primary btn-lg" href="#" role="button">Mail Us</a></p>
        </div>
</div>
<div class="container">
<div style="padding:2%">
<form method="post">
  <div class="form-group">
    <h3>Please Give Your Suggestions/comments</h3>
    <input type="text-area" class="form-control" id="comment" name="comment" placeholder="This Website looks awesome">
  </div>
  <input type="submit" value="submit" class="btn btn-primary" name="submit">
</form>
</div>
<?php
    if(isset($_POST['submit'])){
      $comment =$_POST['comment'];
?>
<div class="card" style="margin:2%">
  <div class="card-body">
     <?php  echo $comment;?>
  </div>
</div>
<?php 
    } //Endif
?>
</div>
<?php include 'include/footer.php'; ?>