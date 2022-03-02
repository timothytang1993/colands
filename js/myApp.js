var app = angular.module('myApp',[])




.controller("tacticInfo", function($scope) {
    $scope.tacticDetail = [ 
    {
      "name" : "戰術名稱",
      "pros" : "效果",
      "cons" : "弱點",
    },
    {
        "name" : "焦土作戰",
        "pros" : "敵方成功攻佔我方駐軍據點，將不獲勝利點。",
        "cons" : "我方在相關據點需駐軍200。",
    },
    {
        "name" : "緊急動員",
        "pros" : "額外增加我方基地駐軍800。",
        "cons" : "我方可部署兵力由1000減至600。",
    },
    {
        "name" : "防禦行動",
        "pros" : "我方在據點駐軍後，額外增加相關據點駐軍100。",
        "cons" : "不可攻擊敵方基地。",
    },
    {
        "name" : "虛假情報",
        "pros" : "自動減少相關據點的敵軍100，不足100降至0。",
        "cons" : "我方基地駐軍必須多於相關據點的敵軍。",
    },
    {
        "name" : "軍國主義",
        "pros" : "我方可部署兵力由1000升至2000。",
        "cons" : "敵軍佔領兩個據點，將算作我方基地淪陷。",
    },
    {
        "name" : "閃電戰術",
        "pros" : "所有敵方戰術效果無效。如敵方部署兵力超過1000，相關敵方基地淪陷。",
        "cons" : "我方在所有敵方基地駐軍自動減少50%。",
    },
    {
        "name" : "背水一戰",
        "pros" : "我方勝利，國家威望加5。",
        "cons" : "我方可部署兵力由1000減至300",
    },
    {
        "name" : "跳島作戰",
        "pros" : "佔領一個敵方基地，獲得勝利點2點。",
        "cons" : "不可攻擊任何據點。",
    },
    // {
    //     "name" : "穩守突擊",
    //     "pros" : "只要成功防守我方戰略指揮部，我方戰略指揮部駐軍將自動攻擊所有敵方戰略指揮部。",
    //     "cons" : "我方總兵力由1000減至500。",
    // },
    // {
    //     "name" : "民族主義",
    //     "pros" : "猜中第一名玩家，玩家國家將嬴得1點威望",
    //     "cons" : "我方總兵力由1000減至0，並不參加戰鬥。如猜不中，玩家國家失去1點威望。",
    // },
    // {
    //     "name" : "縱深防禦",
    //     "pros" : "敵軍在相關據點大於我方時，我方駐軍無損撤回我方戰略指揮部。",
    //     "cons" : "只可以攻擊兩個據點。",
    // },
    ]
  })

  .controller("battleInfo", function($scope) {
    $scope.battleDetail = [ 
    {
      "name" : "戰場名稱",
      "content" : "簡介",
    },
    {
        "name" : "刀刺平原",
        "content" : "刀刺平原，位於格蘭斯大陸南方，高山上平原，南方要道必經之地，可以說是兵家必爭之地。本是漢諾莎皇國領土，但波瑪倫出逃建國後，雙方一直圍繞此處爆發爭奪戰。",
      },
      {
        "name" : "圓舞曲之湖",
        "content" : " 圓舞曲之湖、又名新秩序之湖，是由諸多小島嶼組成的內陸湖。在波瑪倫的新秩序計劃中，為了摧毀中下游的川流之城，而擴充湖泊，進則水攻淹城，退則截流孤立城池。由於涉及烏斯爾登國協利益，三國一直在此處爆發大規模衝突。",
      },
      {
        "name" : "琉璃樂都",
        "content" : "琉璃樂都，西南方沙漠中的唯一綠州，也是南方要道的一站，匯聚八方商旅之地，盛產琉璃等加工製品。雖然是漢諾沙皇國的內領，但波瑪倫與烏斯爾登一直試圖掌握此城，獲取龐大財富，而爆發衝突。",
      },
      {
        "name" : "川流之城",
        "content" : "川流之城，格蘭斯大陸中央，在中下游匯流之處的一座雙城牆要塞，由漢諾沙皇國持有。作為東進烏斯爾登國，東南進逼波瑪倫國的戰略要地，爆發眾多之戰爭，也是波瑪倫新秩序計劃的目標。",
      },
      {
        "name" : "漢諾莎大帝之墓",
        "content" : "漢諾莎大帝之墓，在三一五刺殺案後，漢諾莎大帝葬於烏斯爾登與漢諾沙領土交界處，有漢諾莎大帝領導征服烏斯爾登意思。由於有大量陪葬品及增加聲望意義，三國一直希望佔據此處。",
      },
      {
        "name" : "烏斯爾登森林",
        "content" : "烏斯爾登森林，本身不是烏斯爾登的領土，但隨著漢諾沙大帝征伐，處於森林內的自由人加入國協，而有此稱呼。事實上，在自由人之中，它有千種名字，烏斯爾登實際上無法全面管理。",
      },
      {
        "name" : "波瑪倫礦山",
        "content" : "波瑪倫礦山，在波瑪倫執政時期開發的礦山，具有大量貴金屬，作為支撐波瑪倫征伐的重要收入來源。",
      },
    ]
  })

  .controller("characterInfo", function($scope) {
    $scope.characterDetail = [ 
    // {
    //   "title-name" : "人物名稱",
    //   "title-content" : "簡介",
    // },
    {
        "name" : "名稱：漢諾莎大帝",
        "image" : "img/urbase/24.gif",
        "height" : "身高：168cm",
        "nationality" : "國籍：漢諾莎皇國",
        "content" : "簡介：漢諾莎皇國開創者，軍事家、政治家，主張人民有當家作主的權利，改組要地維和部隊為皇家近衛隊，佔領格蘭斯大陸八成江山，並建立漢諾莎皇國。然而，在一次前往貴族會議的途中，不幸遭到刺殺，結束其輝煌的一生。",
        "claim" : "格言：國家是由人民組成，人民有權利參與政治，但社會缺乏基礎讓人民有時間、精力、能力判斷一切，必須在有識之士引領下，漸進地實現民主。",
      },
      {
        "name" : "名稱：漢諾莎少帝",
        "image" : "img/urbase/13.gif",
        "height" : "身高：175cm",
        "nationality" : " 國籍：漢諾莎皇國",
        "content" : "簡介：漢諾莎大帝之子，又名漢諾莎少帝。三一五刺殺案後，獲得貴族支持，成為第二任皇帝。由於缺乏私人部隊，皇國實權落入貴族手上，但父親威望帶來的民望，成為他唯一的政治本錢。",
        "claim" : "格言：人生來便能主宰身體，同樣生來可以主宰國家命運，不需要循序漸進。錯誤決策也無需介懷，因為跌倒是為了未來走得更好。",
      },
      {
        "name" : "名稱：波瑪倫",
        "image" : "img/urbase/25.gif",
        "height" : "身高：180cm",
        "nationality" : " 國籍：波瑪倫民國",
        "content" : "簡介：前要地維和部隊將領，跟隨漢諾莎大帝南征北伐，具備豐富作戰經驗，後任漢諾莎皇國近衛隊隊長。被少帝為首的貴族集團指控策劃三一五刺殺案，九成近衛隊隊員遭到殺害，憑作戰經驗奪門出逃，在格蘭斯大陸東南方建立民國，以漢諾莎大帝民主主義繼承人自居。每一次民主選舉中，都以最少9成5支持度勝出。",
        "claim" : "格言：民主不是讓一百種人實現一百種想法，而是讓一百種人實現一種想法。",
      },
      {
        "name" : "名稱：烏族族長",
        "image" : "img/urbase/26.gif",
        "height" : "身高：175cm",
        "nationality" : " 國籍：烏斯爾登國協",
        "content" : "簡介：東北四國首領之一，率領族人抵抗漢諾莎大帝東征，大敗，因而與其他三國及自由人組成烏斯爾登國協。主張用分離方式，驅遂自由人回森林，解決自由人不受控制的問題。",
        "claim" : "格言：當我們成為少數時，應該遠離多數，因為我們永遠不知道何時成為零數。",
      },
      {
        "name" : "名稱：斯族族長",
        "image" : "img/urbase/23.gif",
        "height" : "身高：175cm",
        "nationality" : " 國籍：烏斯爾登國協",
        "content" : "簡介：東北四國首領之一。漢諾莎東征結束後，主張領導們宜開誠佈公、詳加講解政策目的，避免民粹問題。",
        "claim" : "格言：只要各抒己見、開誠佈公，匯聚共識，定能求同存異，減少紛爭。",
      },
      {
        "name" : "名稱：爾族族長",
        "image" : "img/urbase/14.gif",
        "height" : "身高：175cm",
        "nationality" : " 國籍：烏斯爾登國協",
        "content" : "簡介：東北四國首領之一。漢諾莎東征結束後，主張以階級社會，製造自由人的矛盾，令寡頭們可以有效管治，避免民粹問題。",
        "claim" : "格言：民粹沿於大家考慮同一利益，只要階級利益不一，自然談不上民粹。",
      },
      {
        "name" : "名稱：登族族長",
        "image" : "img/urbase/21.gif",
        "height" : "身高：175cm",
        "nationality" : " 國籍：烏斯爾登國協",
        "content" : "簡介：東北四國首領之一。認同民粹妨礙寡頭管治的利益，但恐懼民粹而無所作為。",
        "claim" : "格言：聽從民粹是很危險的事，但不想死只能聽從民粹。",
      },
    ]
  })

.controller("calculationInfo",function($scope){
    $scope.totalRestMilitary = 1000;
    $scope.empireBaseMilitary = "";
    $scope.republicBaseMilitary = "";
    $scope.commonwealthBaseMilitary = "";
    $scope.pointOneMilitary = "";
    $scope.pointTwoMilitary = "";
    $scope.pointThreeMilitary = "";
    $scope.pointFourMilitary = "";
    $scope.pointFiveMilitary = "";
})

.directive('copyright',function(){
    return { 
        restrict: "E",
        templateUrl:'include/copyright.php'
    }
})
.directive('navBar',function(){
    return { 
        restrict: "E",
        templateUrl:'include/navBar.php'
    }
})
.directive('sideBar',function(){
    return { 
        restrict: "E",
        templateUrl:'include/sideBar.php'
    }
})

.directive('basicMeta',function(){
    return { 
        restrict: "E",
        templateUrl:'include/basicMeta.php'
    }
})


.controller('bot',function($scope){
  $scope.showBot = false;

  $scope.showBotFunction = function(){
    $scope.showBot = !$scope.showBot;
  }
})