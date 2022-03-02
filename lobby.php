<?php
session_start();
if (!empty($_SESSION["user_id"])) {
?>
    <!DOCTYPE html>
    <html lang="zh-Hant-HK" ng-app="myApp">
    <head>
        
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Cache-Control" content="no-cache, max-age=0" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="格蘭斯戰記是一款網頁地域壓制型模擬遊戲" />
    <meta name="keywords" content="逍遙的安少, 格蘭斯戰記, 格蘭斯, 戰略要地, 模擬戰略部, 紙上遊戲廳" />
    <meta name="author" content="Colands Tang, 逍遙的安少" />

    <title>對戰大廳</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet">

        <!-- bot CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link href="css\styleBot.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body >
    
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">    
            <?php
                require_once("include/navbar.php");
                require_once("include/sidebar.php");
            ?>
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">對戰大廳</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">

                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <?php
                                    echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'>";
                                    //echo "<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Image</th><th>Action</th></tr></thead> <tbody>";
                                    echo "<thead><tr><th>戰役編號</th><th>戰役名稱</th><th>勝利者</th><th>執行指令</th></tr></thead> <tbody>";

                                    require_once("include/config.php");
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=$dbcharset", $username, $password);
	                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    try {
                                    
                                        $stmt = $conn->prepare("SELECT * FROM battleField Group by battleField_id");
                                        $stmt->execute();
                                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                        
                                        foreach ($stmt->fetchAll() as $row) {
                                            
                                            require ("include/whetherparticiation.php");
                                            
                                            if ($countryParticipation == 'joined') {
                                                $displayJoin = 'none';
                                               
                                            } else {
                                                $displayJoin = 'block';
                                                
                                            };

                                            if ($row["battleField_status"] != "未分高下"){
                                                $displayPlayerParticipated = 'none';
                                            }elseif($countryParticipation == 'joined'){
                                                $displayPlayerParticipated = 'block';
                                            }else{
                                                $displayPlayerParticipated = 'none';
                                            };

                                            if ($row["battleField_status"] == "未分高下"){
                                                $displayResult = 'none';
                                            }else{
                                                $displayResult = 'block';
                                            };
                                    ?>

                                            <tr>
                                                <td style='width:150px;border:1px solid black;'>
                                                    <?PHP echo htmlspecialchars($row["battleField_id"]) ?>
                                                </td>
                                                <td style='width:150px;border:1px solid black;'>
                                                    <?PHP echo htmlspecialchars($row["battleField_battleInfo_name"]) ?>
                                                </td>
                                                <td style='width:150px;border:1px solid black;'>
                                                    <?PHP echo htmlspecialchars($row["battleField_status"]) ?>
                                                </td>
                                                <td style='width:150px;border:1px solid black;'>
                                                <span style="display:<?php echo $displayPlayerParticipated ?>">我國已有玩家參戰</span>
                                                <button style="display:<?php echo $displayJoin ?>" id="joinBattle" onclick="joinBattle(<?php echo htmlspecialchars($row['battleField_id']) ?>)">參戰<i class="fas fa-fighter-jet" style="color:green"></i></button>
                                                <button style="display:<?php echo $displayResult ?>" id="checkResult" onclick="checkResult(<?php echo htmlspecialchars($row['battleField_id']) ?>)"><i class="fas fa-gavel" style="color:tan"></i>戰況匯報</button>
                                                
                                             </td>
                                            </tr>

                                            
                                            
                                    <?PHP

                                        }
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                    $conn = null;
                                    echo "</tbody></table>";
                                    require_once("include/bot.php");
                                    ?>
                                    
                                </div>
                                <!-- /.table-responsive -->

                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <div style="color:black; text-align:center;">
            <copyright></copyright>
        </div>
        
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="js/dataTables/jquery.dataTables.min.js"></script>
        <script src="js/dataTables/dataTables.bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/startmin.js"></script>

        <!-- function created by timothy tang-->
        <script src="js/function.js" rel="stylesheet"></script>

        <!--angular-->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular.min.js"></script>
        <script src="js/myApp.js"></script>
    </body>
    </html>
<?PHP
} else {
    header("Refresh: 0; url=login.html");
}
?>
