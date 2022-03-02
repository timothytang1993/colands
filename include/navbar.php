<?php

if (!empty($_SESSION["user_id"])) {
?>
<div class="navbar-header">
                    <!-- <a class="navbar-brand" href="tables.php">檢示產品內容</a> -->
                    <a href="lobby.php"><img src="img/logo.jpg" widht="50wh" height="50vh;"></a>

                    <!-- <?PHP echo '<img width="100%" src="data:'.$_SESSION["user_imageType"].";base64,".
                            base64_encode($_SESSION["user_image"]).'">'; ?> -->
                </div>
                
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                    
                </button>

               
                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown navbar-inverse">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-alerts">
                            <!-- <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li> -->
                            
                            

                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>戰報系統搭建中</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            
                            <i class="fa fa-user fa-fw"></i> 
                            <?php echo $_SESSION["user_name"] ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <!-- <li><a href="../userprofile.php"><i class="fa fa-user fa-fw"></i> 修改用戶密碼</a>
                            </li> -->
                            <li class="divider"></li>
                            <li><a href="./logoutprocess.php"><i class="fa fa-sign-out fa-fw"></i> 登出</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
                <!-- /.navbar-top-links -->
                


 

<?PHP
} else {
    header("Refresh: 0; url=login.html");
}
?>