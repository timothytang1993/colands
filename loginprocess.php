<?php
if($_POST!=NULL){
session_start();
require_once("include/config.php");
$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=$dbcharset", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    
    $stmt = $conn->prepare("SELECT user_id, user_email, user_password, user_name, user_country_name FROM user WHERE user_email = :user_email AND user_password = :user_password");//收集數據
    $stmt->bindParam(':user_email', $user_email);
    $stmt->bindParam(':user_password', $user_password);//將資料匯入變數內

    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];//md5()
    $stmt->execute();

    if($stmt->rowCount()>0){
        $loginCredentials = $stmt->fetch(PDO::FETCH_ASSOC); 
        $_SESSION["user_id"] = $loginCredentials["user_id"];
        $_SESSION["user_email"] = $loginCredentials["user_email"]; //記錄電郵，登入各頁面
        $_SESSION["user_name"] = $loginCredentials["user_name"]; //記錄電郵，登入各頁面
        $_SESSION["user_country_name"] = $loginCredentials["user_country_name"];
        // $_SESSION["user_image"] = $loginCredentials["user_image"];
        // $_SESSION["user_imageType"] = $loginCredentials["user_imageType"];
        // $_SESSION["controlpanel"] = $loginCredentials["controlpanel"]; //檢查帳戶權限
        echo "登入成功";
        header('Refresh:1; url=lobby.php');
    }else{
        echo "登入失敗，請再試";
        header('Refresh:1; url=login.html');
    }
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}else{
    echo "OOPS! Error.";
    header('Refresh:1; url=login.html');
}
?>