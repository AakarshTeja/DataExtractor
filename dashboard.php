<?php include 'include/header.php'; ?>

<div class="jumbotron">
    <div class="container">

        <h1> Hi <?php if(isset($_SESSION['name'])){ echo $_SESSION['name'];}?>,<br> Welcome to Data Extractor Service</h1>
    </div>
</div>

<?php include 'include/footer.php'; ?>