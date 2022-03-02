<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "colands";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
   
    $user_id = $_POST['user_id'];
    $stmt = $conn->prepare("UPDATE user 
    SET user_image=:user_image, user_imageType=:user_imageType WHERE user_id=$user_id") ;
    // $stmt->bindParam(':Prod_ID', $Prod_ID);
    
    $stmt->bindParam(':user_image', $user_image);
    $stmt->bindParam(':user_imageType', $user_imageType);

    // insert a row
    // $Prod_ID = $_POST["Prod_ID"];

   

    $user_image=file_get_contents($_FILES["user_image"]["tmp_name"]);
    $imgProperties=getimageSize($_FILES["user_image"]["tmp_name"]); //image/jpg image/png
    $user_imageType=$imgProperties["mime"];
    $stmt->execute();

    echo ("成功上傳");
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
?>
