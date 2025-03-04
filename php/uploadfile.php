<?php
if(isset($_POST['request']) && $_POST['request'] === 'uploadimage') {
    $target_dir = "../img/products/";
    $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["hinhanh"]["tmp_name"]);
    if($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        http_response_code(400);
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
            echo "The file has been uploaded successfully.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            http_response_code(500);
        }
    }
    exit;
}
?>