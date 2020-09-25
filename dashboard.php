<?php include 'include/header.php'; ?>

<div class="jumbotron">
    <div class="container">
        <h1> Hi <?php if(isset($_SESSION['name'])){ echo $_SESSION['name'];}?>,<br> This is your Dashboard</h1>
    </div>
</div>
<main style="font-size:12px;" role="main" class="col">

          <div class="flash-message">
            <?php 
             foreach (['danger', 'warning', 'success', 'info'] as $msg){
              if(isset($_SESSION['alert-' . $msg])){
                 $info=$_SESSION["alert-$msg"];
               echo '<p class="alert alert-'.$msg.'">'.$info.'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>';
              }
             }
            ?>
          </div>
          
    <form action="extractprocess.php" method="post" enctype="multipart/form-data">
      <h3>Select Files to Upload:</h3>
      <label>Please make sure doc files are converted to docx:</label>
      <div class="form-group row">
        <div class="col-md-6">
          <input style="height:40px; font-size:15px;" class="form-control" type="file" name="files[]" multiple="">
        </div>
        <div class="col-md-3">
          <input style="width:100%; height:40px; font-size:20px;" class="btn btn-info " type="submit" name="mul_submit" value="Upload & Extract">
        </div>
        <button class="btn" name='download' style="
            background-color: DodgerBlue;
            border: none;
            color: white;
            padding: 5px 25px;
            cursor: pointer;
            font-size: 20px;
            :hover {
            background-color: RoyalBlue;"><i class="fa fa-download"></i> Download</button>
      </div>
  </form>

  <?php
        
?>

      <?php
            // Include the database configuration file
            include('include/db.php'); 

            // Get images from the database
            $num_rows=0;
            $query = $conn->query("SELECT * FROM files ORDER BY id DESC");
            
            if($query){
            $num_rows=mysqli_num_rows($query);
            // return $num_rows;
            }
            if($num_rows > 0){
      ?>

      <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Serial Number</th>
                <th>upload Date</th>
                <th>File Names</th>
            </tr>
        </thead>
        <tbody>
          <?php
          while($row = $query->fetch_assoc()){
                    // $imageURL = 'uploads/'.$row["file_name"]; ?>

          <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['uploaded_on']; ?></td>
                <td><a href="#"><?php echo $row['file_name']; ?></a><br></td>
          </tr>
                 <?php } ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Serial Number</th>
                <th>upload Date</th>
               <th>File Names</th>
            </tr>
        </tfoot>
        </table>
           <?php }else{ ?>
                <p>No file(s) found...</p>
            <?php } ?> 


        </main>
      </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php include 'include/footer.php'; ?>