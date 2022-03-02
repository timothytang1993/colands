<?php
session_start();
if(!empty($_SESSION["user_id"])){
   
?> 
<!DOCTYPE html>
<html lang="zh-Hant-HK" ng-app="myApp">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-Control" content="no-cache, max-age=0" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>部署兵力</title>

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
    <body>

        <<div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php
                require_once("include/navbar.php");
                require_once("include/sidebar.php");
            ?>
            </nav>

            <div id="page-wrapper">
                <div class="row">
                   
                
                        <?PHP
                       
                        
                        try {
                            require_once("include/config.php");
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=$dbcharset", $username, $password);
	                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare("SELECT * FROM battleField WHERE battleField_id=:battleField_id");
                            $stmt->bindParam(':battleField_id', $battleField_id);
                            $battleField_id = $_GET['battleField_id'];
                            $stmt->execute();
                            $battleFieldData = $stmt->fetchAll();

                            $current_battleField_battleInfo_name = $battleFieldData[0]["battleField_battleInfo_name"];// 收集戰場適用那些戰術
 
                            $tactic = $conn->prepare("SELECT * FROM battleInfo WHERE batlleInfo_name = '$current_battleField_battleInfo_name' ");
                            $tactic->execute();
                            $tacticResult = $tactic->fetch();

                            
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;

                        ?>
                        
                        <div class="col-lg-12">
                        <h1 class="page-header">部署兵力</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                         <form name="myform" role="form" action="battleprepare.php" method="POST" enctype="multipart/form-data" ng-controller="calculationInfo">
                                         <div class="form-group">
                        
                                            <input type="hidden" name="battleCalculator_battleField_id" value="<?PHP echo htmlspecialchars($battleFieldData[0]["battleField_id"])?>">
                                            <input type="hidden" name="battleCalculator_battleInfo_name" value="<?PHP echo htmlspecialchars($battleFieldData[0]["battleField_battleInfo_name"])?>">
                                            <input type="hidden" name="battleCalculator_user_id" value="<?php echo htmlspecialchars($_SESSION["user_id"]) ?>">
                                            <input type="hidden" name="battleCalculator_user_name" value="<?php echo htmlspecialchars($_SESSION["user_name"]) ?>">
                                            <input type="hidden" name="battleCalculator_country_name" value="<?php echo htmlspecialchars($_SESSION["user_country_name"]) ?>">
                                            <h3>戰役編號:  <?PHP echo htmlspecialchars($battleFieldData[0]["battleField_id"])?></h3><br>
                                        </div>
                                        <div class="form-group">
                                                
                                                <label for="base">使用戰術</label><br />

                                                <select name="battleCalculator_operatingTactic" id="changeTactic" onchange="tactic()">
                                                <!-- <option value="<?php echo htmlspecialchars($tacticResult['tactic_one']) ?>"><?php echo htmlspecialchars($tacticResult['tactic_one']) ?></option>
                                                <option value="<?php echo htmlspecialchars($tacticResult['tactic_two']) ?>"><?php echo htmlspecialchars($tacticResult['tactic_two']) ?></option>
                                                <option value="<?php echo htmlspecialchars($tacticResult['tactic_three']) ?>"><?php echo htmlspecialchars($tacticResult['tactic_three']) ?></option>  -->
                                                <option value="不使用戰術">不使用戰術</option> 
                                                <option value="緊急動員">緊急動員</option>
                                                <option value="防御行動">防御行動</option>
                                                <option value="焦土作戰">焦土作戰</option>  
                                                <option value="虛假情報">虛假情報</option> 
                                                <option value="軍國主義">軍國主義</option> 
                                                <option value="閃電戰術">閃電戰術</option>
                                                <option value="背水一戰">背水一戰</option>
                                                <option value="跳島作戰">跳島作戰</option>
                                            </select>
                                        </div>    

                                            <div class="form-group">
                                                <label for="battleCalculator_empireBase">皇國基地</label>
                                                <input class="form-control" name="battleCalculator_empireBase" type="number" min="0" step="1" value="" placeholder="請部署兵力" ng-model="empireBaseMilitary" required>
                                                <!-- <p class="help-block">請部署兵力</p> -->
                                            </div>
                                            <div class="form-group">
                                                <label for="battleCalculator_republicBase">民國基地</label>
                                                <input class="form-control" name="battleCalculator_republicBase" type="number" min="0" step="1" value="" placeholder="請部署兵力" ng-model="republicBaseMilitary" required>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="battleCalculator_commonwealthBase">國協基地</label>
                                                <input class="form-control" name="battleCalculator_commonwealthBase" type="number" min="0" step="1" value="" placeholder="請部署兵力" ng-model="commonwealthBaseMilitary" required>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="battleCalculator_pointOne">據點一</label><br>
                                                <input class="form-control" name="battleCalculator_pointOne" type="number" min="0" step="1" value="" placeholder="請部署兵力" ng-model="pointOneMilitary" required>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="battleCalculator_pointTwo">據點二</label><br>
                                                <input class="form-control" name="battleCalculator_pointTwo" type="number" min="0" step="1" value="" placeholder="請部署兵力" ng-model="pointTwoMilitary" required>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="battleCalculator_pointThree">據點三</label><br>
                                                <input class="form-control" name="battleCalculator_pointThree" type="number" min="0" step="1" value="" placeholder="請部署兵力" ng-model="pointThreeMilitary" required>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="battleCalculator_pointFour">據點四</label><br>
                                                <input class="form-control" name="battleCalculator_pointFour" type="number" min="0" step="1" value="" placeholder="請部署兵力" ng-model="pointFourMilitary" required>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="battleCalculator_pointFive">據點五</label><br>
                                                <input class="form-control" name="battleCalculator_pointFive" type="number" max = "<?php echo "$response" ?>"min="0" step="1" value="" placeholder="請部署兵力" ng-model="pointFiveMilitary" required>
                                              
                                            </div>
                                            <!-- <div class="form-group">
                                                <p style="color:red; font-size:24px;">部署兵力總數：{{empireBaseMilitary+republicBaseMilitary+commonwealthBaseMilitary
                                                                                                    +pointOneMilitary+pointTwoMilitary+pointThreeMilitary+pointFourMilitary+pointFiveMilitary}}</p>
                                            </div> -->
                                    
                                            <br><br>
                                            <!-- <input type="button"  class="btn btn-default" onclick="check()" value="提交"> -->
                                            <button type="submit" class="btn btn-default">提交</button>
                                            <button type="reset" class="btn btn-default">重設</button>
                                        </form>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                    
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <?php
        require_once("include/bot.php");
        ?>
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
}else{
    header("Refresh: 0; url=login.html");
}
?>