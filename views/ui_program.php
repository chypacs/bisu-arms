<?php

$html = '
    <main id="main">

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio section-bg">
          <div class="container">
            <div class="section-title">
              <h2>Files</h2>
                <div>
                    <button type="button" class="btn btn-labeled btn-primary" id="Add_Folder">
                    <span class="btn-label "><i class="bx bx-folder-plus"></i></span>Add Folder</button>
                                 
                    <div id="folder" class="modal container-fluid col-12">
                        <div id ="main" class="modal-content w-25 ">
                            <form  action="" method="POST">
                                <div class="modal-header">
                                <button class="btn btn-outline-secondary close">X</button>
                                </div>
                                <div class="modal-body">
                                    <h3 class="modal-title">Add Folder</h3>
                                    <p>Enter folder name:</p>
                                    <br/>
                                    <input type="text" class="form-control" id="folder_name" name="folder_name"/>
                                    <br/>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" value="Create folder" class="btn btn-primary">Add</button>
                                    <button class="btn btn-secondary close">Cancel</button>
                                </div>                    
                            </form>
                        </div>
                    </div>

                    <button type="button" class="btn btn-labeled btn-primary" id="Upload">
                    <span class="btn-label "><i class="bx bx-upload"></i></span>Upload Files</button>

                    <div id="files" class="modal container-fluid">
                    <div id ="main" class="modal-content w-25">
                        <form  action="" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                            <button  class="btn btn-outline-secondary close">X</button>
                            </div>
                            <div class="modal-body">
                            <h3 class="modal-title">Upload Files</h3>
                              <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Input Files to upload:</label>
                                  <input class="form-control" type="file" id="formFileMultiple" multiple>
                              </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <button class="btn btn-secondary close">Cancel</button>
                            </div>                    
                        </form>
                    </div>
                    </div>
                  

                 
                    
    
            <div class="row" data-aos="fade-up">
              <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">';

        $upload_dir = dirname(__DIR__).'/AACCUP/';
        if (!empty($_POST)) {
          // Get the name of the new folder
          $folder_name = $_POST['folder_name'];

          // Set the path of the new directory
          $dir = $upload_dir .$folder_name;

          // Set the permissions for the directory
          $permissions = 0775;
          // Create the new directory
          if (mkdir($dir, $permissions)) {
              
          } else {
              
          }
        }
       

        // Check if the form has been submitted
        if (isset($_POST['submit'])) {
          // Check if a file has been uploaded
          if (isset($_FILES['file'])) {
            // Get the uploaded file information
            $file = $_FILES['file'];
            $name = $file['name'];
            $tmp_name = $file['tmp_name'];

            // Move the uploaded file to the upload directory
            move_uploaded_file($tmp_name, $upload_dir . $name);
          }
        }
        var_dump($upload_dir);
        $files = scandir($upload_dir);

        // Remove "." and ".." from the list of files
        $files = array_diff($files, array('.', '..'));

        // Display the file list
        echo '<ul>';
        foreach ($files as $file) {
          echo '<li>';
          echo '<a href="' . $upload_dir . $file . '">' . $file . '</a>';
          echo ' - ' . filesize($upload_dir . $file) . ' bytes';
          echo '</li>';
        }
        echo '</ul>';
        
  $html .= ' 
              </ul>
              </div>
            </div>';

  echo $html;


?>

<script>
    var modal = document.getElementById("folder");
    var modal1 = document.getElementById("files");
    var add = document.getElementById("Add_Folder");
    var add1 = document.getElementById("Upload");
    var close = document.getElementById("close");

    add.onclick = function() {
    modal.style.display = "block";
    }

    add1.onclick = function() {
    modal1.style.display = "block";
    }

    close.onclick = function() {
    modal.style.display = "none";
    }

    close.onclick = function() {
    modal1.style.display = "none";
    }


    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }

        else if (event.target == modal1) {
            modal1.style.display = "none";
        }
    }
</script>