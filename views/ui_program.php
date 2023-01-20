<?php
include_once 'config.php';
$html = '
    <main id="main">

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio section-bg">
          <div class="container">
            <div class="section-title">
              <h2>Files</h2>
                
                
            <div class="d-flex flex-row justify-content-between">
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="bx bx-folder-plus"></i>Create Folder
                </button>

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Folder</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Add your folder here:</p>
                        <div class="mb-3">
                        <br>
                        <input type="text" class="form-control" name="folder" id="exampleFormControlInput1" placeholder="Folder name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" name="create">Create</button>
                    </div>
                    </div>
                </div>
                </div>


                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropfile">
                <i class="bx bx-upload"></i>Upload Files
                </button>

                <div class="modal fade" id="staticBackdropfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Files</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Input your file(s) here:</p>
                            <br>
                            <div class="mb-3">
                            <input class="form-control" type="file" id="formFileMultiple" multiple>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Upload</button>
                    </div>
                    </div>
                </div>
                </div>
             </div>       
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>   
            </div>
            <div class="row" data-aos="fade-up">
              <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">';

        if(isset($_POST['create'])){
            $folder = $POST['folder'];

        }


        // $upload_dir = dirname(__DIR__).'/AACCUP/';
        // if (!empty($_POST)) {
        //   // Get the name of the new folder
        //   $folder_name = $_POST['folder_name'];

        //   // Set the path of the new directory
        //   $dir = $upload_dir .$folder_name;

        //   // Set the permissions for the directory
        //   $permissions = 0775;
        //   // Create the new directory
        //   if (mkdir($dir, $permissions)) {
              
        //   } else {
              
        //   }
        // }
       

        // // Check if the form has been submitted
        // if (isset($_POST['submit'])) {
        //   // Check if a file has been uploaded
        //   if (isset($_FILES['file'])) {
        //     // Get the uploaded file information
        //     $file = $_FILES['file'];
        //     $name = $file['name'];
        //     $tmp_name = $file['tmp_name'];

        //     // Move the uploaded file to the upload directory
        //     move_uploaded_file($tmp_name, $upload_dir . $name);
        //   }
        // }
        // var_dump($upload_dir);
  

       
       
        
  $html .= ' 
              </ul>
              </div>
            </div>
            </div>
            </div>
            </section>

        ';

  echo $html;

?>

<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
    myInput.focus()
    })
</script>