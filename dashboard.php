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
     <div class="container" style="padding-bottom:1%;">     
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
      <div class="table-responsive">
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
        </div>  
        </div>
           <?php }else{ ?>
                <p>No file(s) found...</p>
            <?php } ?> 
        <div>
</main>
<?php include 'include/footer.php'; ?>   
    <script>
     $(document).ready(function() {
    $('#example').DataTable();
     } ); 
</script>


