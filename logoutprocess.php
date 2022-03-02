<?PHP
    session_start();
    echo "成功登出";
    unset($_SESSION["user_id"]);
    header("Refresh: 1; url=login.html");
?>