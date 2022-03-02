<?php
session_start();
if (!empty($_SESSION["user_id"])) {



    try {

        require_once("include/config.php");
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=$dbcharset", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $insertData = "battleCalculator_battleField_id, battleCalculator_battleInfo_name , battleCalculator_user_id, battleCalculator_user_name, battleCalculator_country_name, battleCalculator_operatingTactic, 
    battleCalculator_empireBase, battleCalculator_republicBase, battleCalculator_commonwealthBase, 
    battleCalculator_pointOne, battleCalculator_pointTwo, battleCalculator_pointThree, battleCalculator_pointFour, battleCalculator_pointFive";
        $insertDataValues = ":battleCalculator_battleField_id, :battleCalculator_battleInfo_name, :battleCalculator_user_id, :battleCalculator_user_name, :battleCalculator_country_name, :battleCalculator_operatingTactic, 
    :battleCalculator_empireBase, :battleCalculator_republicBase, :battleCalculator_commonwealthBase, 
    :battleCalculator_pointOne, :battleCalculator_pointTwo, :battleCalculator_pointThree, :battleCalculator_pointFour, :battleCalculator_pointFive";

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO battleCalculator ($insertData) VALUES ($insertDataValues)");
        // $stmt->bindParam(':Prod_ID', $Prod_ID);
        $stmt->bindParam(':battleCalculator_battleField_id', $battleCalculator_battleField_id);
        $stmt->bindParam(':battleCalculator_battleInfo_name', $battleCalculator_battleInfo_name);
        $stmt->bindParam(':battleCalculator_user_id', $battleCalculator_user_id);
        $stmt->bindParam(':battleCalculator_user_name', $battleCalculator_user_name);
        $stmt->bindParam(':battleCalculator_country_name', $battleCalculator_country_name);
        $stmt->bindParam(':battleCalculator_operatingTactic', $battleCalculator_operatingTactic);

        $stmt->bindParam(':battleCalculator_empireBase', $battleCalculator_empireBase);
        $stmt->bindParam(':battleCalculator_republicBase', $battleCalculator_republicBase);
        $stmt->bindParam(':battleCalculator_commonwealthBase', $battleCalculator_commonwealthBase);

        $stmt->bindParam(':battleCalculator_pointOne', $battleCalculator_pointOne);
        $stmt->bindParam(':battleCalculator_pointTwo', $battleCalculator_pointTwo);
        $stmt->bindParam(':battleCalculator_pointThree', $battleCalculator_pointThree);
        $stmt->bindParam(':battleCalculator_pointFour', $battleCalculator_pointFour);
        $stmt->bindParam(':battleCalculator_pointFive', $battleCalculator_pointFive);

        // insert a row
        $battleCalculator_battleField_id = $_POST["battleCalculator_battleField_id"];
        $battleCalculator_battleInfo_name = $_POST["battleCalculator_battleInfo_name"];
        $battleCalculator_user_id = $_POST["battleCalculator_user_id"];
        $battleCalculator_user_name = $_POST["battleCalculator_user_name"];
        $battleCalculator_country_name = $_POST["battleCalculator_country_name"];
        $battleCalculator_operatingTactic = $_POST["battleCalculator_operatingTactic"];

        $battleCalculator_empireBase = $_POST["battleCalculator_empireBase"];
        $battleCalculator_republicBase = $_POST["battleCalculator_republicBase"];
        $battleCalculator_commonwealthBase = $_POST["battleCalculator_commonwealthBase"];

        $battleCalculator_pointOne = $_POST["battleCalculator_pointOne"];
        $battleCalculator_pointTwo = $_POST["battleCalculator_pointTwo"];
        $battleCalculator_pointThree = $_POST["battleCalculator_pointThree"];
        $battleCalculator_pointFour = $_POST["battleCalculator_pointFour"];
        $battleCalculator_pointFive = $_POST["battleCalculator_pointFive"];

        $totalMilitaries = $battleCalculator_empireBase + $battleCalculator_republicBase + $battleCalculator_commonwealthBase +
            $battleCalculator_pointOne + $battleCalculator_pointTwo + $battleCalculator_pointThree + $battleCalculator_pointFour + $battleCalculator_pointFive;

        $limitMilitaries = 1000;

        //other variable
        $urlJoinBattleId = 'joinbattle.php?battleField_id=' . $battleCalculator_battleField_id;
        $currentParticipatedCountry = '';

        $enforceTactic = true;

        //檢查戰術-緊急動員 
        if ($_POST["battleCalculator_operatingTactic"] == "緊急動員") {
            $limitMilitaries = 600;
        };

        if ($_POST["battleCalculator_operatingTactic"] == "緊急動員" && $totalMilitaries > 600) {
            $enforceTactic = false;
        };
        //檢查戰術-防御行動
        if (
            $_POST["battleCalculator_operatingTactic"] == "防御行動" && $battleCalculator_country_name == "漢諾莎皇國" &&
            $battleCalculator_republicBase != 0
        ) {
            $enforceTactic = false;
        } else if (
            $_POST["battleCalculator_operatingTactic"] == "防御行動" && $battleCalculator_country_name == "漢諾莎皇國" &&
            $battleCalculator_commonwealthBase != 0
        ) {
            $enforceTactic = false;
        };

        if (
            $_POST["battleCalculator_operatingTactic"] == "防御行動" && $battleCalculator_country_name == "波瑪倫民國" &&
            $battleCalculator_empireBase != 0
        ) {
            $enforceTactic = false;
        } else if (
            $_POST["battleCalculator_operatingTactic"] == "防御行動" && $battleCalculator_country_name == "波瑪倫民國" &&
            $battleCalculator_commonwealthBase != 0
        ) {
            $enforceTactic = false;
        };

        if (
            $_POST["battleCalculator_operatingTactic"] == "防御行動" && $battleCalculator_country_name == "烏斯爾登國協" &&
            $battleCalculator_empireBase != 0
        ) {
            $enforceTactic = false;
        } else if (
            $_POST["battleCalculator_operatingTactic"] == "防御行動" && $battleCalculator_country_name == "烏斯爾登國協" &&
            $battleCalculator_republicBase != 0
        ) {
            $enforceTactic = false;
        };
        //檢查戰術-焦土作戰 N/A
        //檢查戰術-虛假情報 N/A
        //檢查戰術-閃電戰術 N/A
        //檢查戰術-軍國主義
        if ($_POST["battleCalculator_operatingTactic"] == "軍國主義") {
            $limitMilitaries = 2000;
        };

        //檢查戰術-背水一戰
        if ($_POST["battleCalculator_operatingTactic"] == "背水一戰") {
            $limitMilitaries = 300;
        };

        //檢查戰術-跳島作戰
        if ($_POST["battleCalculator_operatingTactic"] == "跳島作戰") {
            if (
                $battleCalculator_pointOne > 0 || $battleCalculator_pointTwo > 0 ||
                $battleCalculator_pointThree > 0 || $battleCalculator_pointFour > 0 ||
                $battleCalculator_pointFive > 0
            ) {
                $enforceTactic = false;
            };
        };

        // 更新所屬國家已參戰

        if ($_SESSION['user_country_name'] == "漢諾莎皇國") {
            $GLOBALS['currentParticipatedCountry'] = "battlefield_empireParticipation";
        } elseif ($_SESSION['user_country_name'] == "波瑪倫民國") {
            $GLOBALS['currentParticipatedCountry'] = "battlefield_republicParticipation";
        } elseif ($_SESSION['user_country_name'] == "烏斯爾登國協") {
            $GLOBALS['currentParticipatedCountry'] = "battlefield_commonwealthParticipation";
        };


        $updateCountryParticipation = $conn->prepare("UPDATE battleField SET $currentParticipatedCountry = 'joined' where battleField_id = $battleCalculator_battleField_id");

        // 更新所屬國庫
        $currentCountry = $_SESSION['user_country_name'];
        $countryInfo = $conn->prepare("SELECT * FROM country WHERE country_name = '$currentCountry'");
        $countryInfo->execute();
        $countryInfo = $countryInfo->fetch();

        $updateCountryTreasury = $conn->prepare("UPDATE country SET country_treasury = country_treasury-$totalMilitaries where country_name  = '$currentCountry'");

        // 國庫=可動員兵力限制
        if ($countryInfo['country_treasury'] < $limitMilitaries) {
            $limitMilitaries = $countryInfo['country_treasury'];
        };


        // 檢查所屬勢力是否已參戰
        $ChceckParticipation = $conn->prepare("SELECT battleCalculator_country_name FROM battleCalculator Where battleCalculator_battleField_id = $battleCalculator_battleField_id");
        $ChceckParticipation->execute();
        $ChceckParticipation = $ChceckParticipation->fetch();

        // Example usage for: Null Coalesce Operator 檢查battleCalculator_battleField_id == null ??
        $action = $ChceckParticipation['battleCalculator_country_name'] ?? 'default';

        // The above is identical to this if/else statement
        if (isset($ChceckParticipation['battleCalculator_country_name'])) {
            $action = $ChceckParticipation['battleCalculator_country_name'];
        } else {
            $action = 'default';
        }
        //檢查玩家是否    
        if ($_SESSION["user_country_name"] == $action) {
            echo "您的所屬國家已有玩家參戰";
            header("refresh: 1; url=lobby.php");
        } elseif ($enforceTactic == false) {
            echo "不符合戰術發動條件";
            header("refresh: 1; url=$urlJoinBattleId");
        } elseif ($totalMilitaries > $countryInfo['country_treasury']) {
            echo "國庫不足召募兵力";
            header("refresh: 1; url=$urlJoinBattleId");
        } elseif ($totalMilitaries > $limitMilitaries) {
            echo "部署兵力超出可使用數目";
            header("refresh: 1; url=$urlJoinBattleId");
        } elseif ($totalMilitaries < $limitMilitaries) {
            echo "尚未部署所有兵力";
            header("refresh: 1; url=$urlJoinBattleId");
        } else {
            $updateCountryParticipation->execute();
            $stmt->execute();
            $updateCountryTreasury->execute();
            echo "成功部署兵力";
            header("refresh: 1; url=lobby.php");
        };
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
} else {
    header("Refresh: 0; url=login.html");
}
require_once("include/battlecalculation.php");
