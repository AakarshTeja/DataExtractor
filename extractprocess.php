<?php
$targetDir = "files/";      
$allowTypes = array('pdf','doc','docx');
$path =  $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
        if(isset($_POST['mul_submit'])){
            if(!empty(array_filter($_FILES['files']['name']))){
                foreach($_FILES['files']['name'] as $key=>$val){                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                    // File upload path
                    $fileName = basename(/*$id."_".*/$_FILES['files']['name'][$key]);
                    // echo $fil= basename($fileName,".pdf");

                    $info = pathinfo($fileName);
                    $file_name =  basename($fileName,'.'.$info['extension']);
                    
                    $targetFilePath = $targetDir . $fileName;
                    
                    // Check whether file type is valid
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                    if(in_array($fileType, $allowTypes)){
                        // Upload file to server
                        $path = move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath);
                        if($path){
                        // if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                            // Image db insert sql
                            $insertValuesSQL .= "('".$fileName."', NOW()),";/*for date nd time other option are like $date = date('Y-m-d H:i:s');*/
                        }
                        else{
                                $errorUpload .= $_FILES['files']['name'][$key].', ';
                            }
                    }
                    else{
                            $errorUploadType .= $_FILES['files']['name'][$key].', ';
                    }
                    
                }
                    if(!empty($insertValuesSQL)){
                        include "include/db.php";
                        $insertValuesSQL = trim($insertValuesSQL,',');
                        // Insert image file name into database
                        $insert = $conn->query("INSERT INTO files (file_name, uploaded_on) VALUES $insertValuesSQL");
                        if($insert){
                            $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                            $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                            $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                            $statusMsg = "Files are uploaded successfully.".$errorMsg;
                        }else{
                            $statusMsg = "Sorry, there was an error uploading your file.";
                        }
                    } 
                    // print_r($conn->error_get_last);
                    print_r("inside sql");
                }
                else{
                    $statusMsg = 'Please select a file to upload.';
                }
                
                
                // Display status message
                // echo $statusMsg;
                ini_set('max_execution_time', 300);
                set_time_limit(300);
                try {
                    $output=system("ex-win\scripts\activate && python extractor.py && deactivate");
                    print_r($output);
                    // echo "<script>alert('excel created'); window.location.href='dataextractor/dashboard.php'</script>"; 
                } 
                
                catch (Throwable $e) {
                    report($e);
                } 
                echo "<script>alert('$statusMsg'); </script>"; 
                print_r("inside extract");
                header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        if(isset($_POST['download'])){


            if(file_exists("resume_data.xls")){
                $file = ("resume_data.xls");
                $filetype=filetype($file);
                $filename=basename($file);
                header ("Content-Type: ".$filetype);
                header ("Content-Length: ".filesize($file));
                header ("Content-Disposition: attachment; filename=".$filename);
                readfile($file);
                echo "<script>alert('file downloaded, now redirecting to Dashboard'); </script>"; 
                // header('Location: ' . $_SERVER['HTTP_REFERER']);                       
            }
            else{
                echo "<script>alert('Some error Try again');</script>";
                // header('Location: ' . $_SERVER['HTTP_REFERER']);                        
            
            }
        }   

?>        