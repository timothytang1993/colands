<?php
if (!empty($_SESSION["user_id"])) {
?>
<div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <!-- <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                                /input-group
                            </li> -->
                            <li>
                                <a href="#"><i class="fa fa-dashboard fa-fw"></i>歷史：格蘭斯大陸</a>
                            </li>
                            <li>
                                <a href="character.php"><i class="fa fa-dashboard fa-fw"></i>英雄事跡：人物簡介</a>
                            </li>
                            <li>
                                <a href="userlist.php"><i class="fa fa-dashboard fa-fw"></i>群雄並起：玩家列表</a>
                            </li>
                            <li>
                                <a href="tactic.php"><i class="fa fa-dashboard fa-fw"></i>軍事學堂：戰術簡介</a>
                            </li>
                            <li>
                                <a href="battleinfo.php"><i class="fa fa-dashboard fa-fw"></i>地理要略：戰場簡介</a>
                            </li>
                            <li>
                                <a href="countrymarks.php"><i class="fa fa-dashboard fa-fw"></i>勢力分佈：國家資訊</a>
                            </li>
                            <li>
                                <a href="lobby.php"><i class="fa fa-dashboard fa-fw"></i>戰場：對戰大廳</a>
                            </li>
                            <li>
                                <a href="http://urbase.net/bbs/forum.php"><i class="fa fa-dashboard fa-fw"></i>討論：戰略要地</a>
                            </li>
                            <?php
                            if (!empty($_SESSION["controlpanel"])) {
                            ?>
                                <!-- 如有管理員權限，即顯示管理員後臺 -->
                                <li>
                                    <a href="controlpanel.php"><i class="fa fa-dashboard fa-fw"></i>管理員後臺</a>
                                </li>
                            <?php
                            } else {
                            }
                            ?>
                            <!-- 管理員權限結尾 -->
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
                <?PHP
} else {
    header("Refresh: 0; url=login.html");
}
?>