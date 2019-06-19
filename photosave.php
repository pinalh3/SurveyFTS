 <?php
    $image = $_POST['photofile'];
    //Stores the filename as it was on the client computer.
    $imagename = $_FILES['photofile']['name'];
    //Stores the filetype e.g image/jpeg
    $imagetype = $_FILES['photofile']['type'];
    //Stores any error codes from the upload.
    $imageerror = $_FILES['photofile']['error'];
    //Stores the tempname as it is given by the host when uploaded.
    $imagetemp = $_FILES['photofile']['tmp_name'];

    //The path you wish to upload the image to
    $imagePath = "img/";

    if(is_uploaded_file($imagetemp)) {
        if(move_uploaded_file($imagetemp, $imagePath . $imagename)) {
            echo "Successfully uploaded your image.";
        }
        else {
            echo "Failed to move your image.";
        }
    }
    else {
        echo "Failed to upload your image.";
    }
?>