<?php
include 'db.php';
if (isset($_POST["nom"])) {

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $codeF = $_POST["filier_id"];
    $file = $_FILES["image"];
    //Getting the file name of the uploaded file
    $fileName = $_FILES['image']['name'];
    //Getting the Temporary file name of the uploaded file
    $fileTempName = $_FILES['image']['tmp_name'];
    //Getting the file size of the uploaded file
    $fileSize = $_FILES['image']['size'];
    //getting the no. of error in uploading the file
    $fileError = $_FILES['image']['error'];
    //Getting the file type of the uploaded file
    $fileType = $_FILES['image']['type'];

    //Getting the file ext
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    //Array of Allowed file type
    $allowedExt = array("jpg", "jpeg", "png");

    //Checking, Is file extentation is in allowed extentation array
    if (in_array($fileActualExt, $allowedExt)) {
        //Checking, Is there any file error
        if ($fileError == 0) {
            //Checking,The file size is bellow than the allowed file size
            if ($fileSize < 10000000) {
                //Creating a unique name for file
                $fileNemeNew = "$nom" ."$prenom" ."." . $fileActualExt;
                //File destination
                $fileDestination = 'images/' . $fileNemeNew;
                //function to move temp location to permanent location
                move_uploaded_file($fileTempName, $fileDestination);
                $query  = "INSERT INTO stagiaires (`nomS`,`prenom`,`image`,`codeF`) VALUES('$nom','$prenom','$fileNemeNew','$codeF')";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    header("Location:index.php?added=true");
                }
                else {
                    header("Location:add.php?add=false");
                }
            } else {
                //Message,If file size greater than allowed size
                echo "File Size Limit beyond acceptance";
            }
        } else {
            //Message, If there is some error
            echo "Something Went Wrong Please try again!";
        }
    } else {
        //Message,If this is not a valid file type
        echo "You can't upload this extention of file";
    }  
} 