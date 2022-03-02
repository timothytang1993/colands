<?php

$battleCalculator_battleField_id = $_POST["battleCalculator_battleField_id"];
try {
	require_once("config.php");
	$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$allthree = $conn->prepare("SELECT * FROM battleCalculator WHERE battleCalculator_battleField_id = $battleCalculator_battleField_id");
	$allthree->execute();

	$battleFieldData = $conn->prepare("SELECT battleField_battleInfo_name , battleField_status FROM battleField WHERE battleField_id = $battleCalculator_battleField_id");
	$battleFieldData->execute();
	$battleFieldData = $battleFieldData->fetch();

	$empireDataInCalculator = "";
	$republicDataInCalculator = "";
	$commonwealthDataInCalculator = "";

	$empireTotalMilitaries = "";
	$republicTotalMilitaries = "";
	$commonwealthTotalMilitaries = "";

	$empireName = "漢諾莎皇國";
	$republicName = "波瑪倫民國";
	$commonwealthName ="烏斯爾登國協";

	$empireGloryBattle = 0;
	$republicGloryBattle = 0;
	$commonwealthGloryBattle = 0;

	$empireLossPointOne = 0;
	$empireLossPointTwo = 0;
	$empireLossPointThree = 0;
	$empireLossPointFour = 0;
	$empireLossPointFive = 0;
	$empireTotalLossPoint = $empireLossPointOne + $empireLossPointTwo + $empireLossPointThree + $empireLossPointFour + $empireLossPointFive;

	$republicLossPointOne = 0;
	$republicLossPointTwo = 0;
	$republicLossPointThree = 0;
	$republicLossPointFour = 0;
	$republicLossPointFive = 0;
	$republicTotalLossPoint = $republicLossPointOne + $republicLossPointTwo + $republicLossPointThree + $republicLossPointFour + $republicLossPointFive;

	$commonwealthLossPointOne = 0;
	$commonwealthLossPointTwo = 0;
	$commonwealthLossPointThree = 0;
	$commonwealthLossPointFour = 0;
	$commonwealthLossPointFive = 0;
	$commonwealthTotalLossPoint = $commonwealthLossPointOne + $commonwealthLossPointTwo + $commonwealthLossPointThree + $commonwealthLossPointFour + $commonwealthLossPointFive;

	$winPointOne = 1;
	$winPointTwo = 1;
	$winPointThree = 1;
	$winPointFour = 1;
	$winPointFive = 1;

	$empireLoose = false;
	$republicLoose = false;
	$commonwealthLoose = false;

	$empireMarks = 0;
	$republicMarks = 0;
	$commonwealthMarks = 0;

	$empireResult ='';
	$republicResult ='';
	$commonwealthResult ='';

	$changeEmpirePrivilege = 0;
	$changeRepublicPrivilege = 0;
	$changeCommonwealthPrivilege = 0;
	

	$winner = "和局";


	if ($allthree->rowCount() == 3 && $battleFieldData['battleField_status'] == "未分高下") {



		$empireDataInCalculator = $conn->prepare("SELECT * FROM battleCalculator WHERE battleCalculator_battleField_id = $battleCalculator_battleField_id and battleCalculator_country_name = '$empireName'");
		$empireDataInCalculator->execute();
		$empireDataInCalculator = $empireDataInCalculator->fetch();

		$republicDataInCalculator = $conn->prepare("SELECT * FROM battleCalculator WHERE battleCalculator_battleField_id = $battleCalculator_battleField_id and battleCalculator_country_name = '$republicName'");
		$republicDataInCalculator->execute();
		$republicDataInCalculator = $republicDataInCalculator->fetch();


		$commonwealthDataInCalculator = $conn->prepare("SELECT * FROM battleCalculator WHERE battleCalculator_battleField_id = $battleCalculator_battleField_id and battleCalculator_country_name = '$commonwealthName'");
		$commonwealthDataInCalculator->execute();
		$commonwealthDataInCalculator = $commonwealthDataInCalculator->fetch();

		define("empireOperatingTactic", $empireDataInCalculator["battleCalculator_operatingTactic"]);
		define("empireEmpireBase", $empireDataInCalculator["battleCalculator_empireBase"]);
		define("empireRepbulicBase", $empireDataInCalculator["battleCalculator_republicBase"]);
		define("empireCommonwealthBase", $empireDataInCalculator["battleCalculator_commonwealthBase"]);
		define("empirePointOne", $empireDataInCalculator["battleCalculator_pointOne"]);
		define("empirePointTwo", $empireDataInCalculator["battleCalculator_pointTwo"]);
		define("empirePointThree", $empireDataInCalculator["battleCalculator_pointThree"]);
		define("empirePointFour", $empireDataInCalculator["battleCalculator_pointFour"]);
		define("empirePointFive", $empireDataInCalculator["battleCalculator_pointFive"]);

		define("republicOperatingTactic", $republicDataInCalculator["battleCalculator_operatingTactic"]);
		define("republicEmpireBase", $republicDataInCalculator["battleCalculator_empireBase"]);
		define("republicRepublicBase", $republicDataInCalculator["battleCalculator_republicBase"]);
		define("republicCommonwealthBase", $republicDataInCalculator["battleCalculator_commonwealthBase"]);
		define("republicPointOne", $republicDataInCalculator["battleCalculator_pointOne"]);
		define("republicPointTwo", $republicDataInCalculator["battleCalculator_pointTwo"]);
		define("republicPointThree", $republicDataInCalculator["battleCalculator_pointThree"]);
		define("republicPointFour", $republicDataInCalculator["battleCalculator_pointFour"]);
		define("republicPointFive", $republicDataInCalculator["battleCalculator_pointFive"]);

		define("commonwealthOperatingTactic", $commonwealthDataInCalculator["battleCalculator_operatingTactic"]);
		define("commonwealthEmpireBase", $commonwealthDataInCalculator["battleCalculator_empireBase"]);
		define("commonwealthRepbulicBase", $commonwealthDataInCalculator["battleCalculator_republicBase"]);
		define("commonwealthCommonwealthBase", $commonwealthDataInCalculator["battleCalculator_commonwealthBase"]);
		define("commonwealthPointOne", $commonwealthDataInCalculator["battleCalculator_pointOne"]);
		define("commonwealthPointTwo", $commonwealthDataInCalculator["battleCalculator_pointTwo"]);
		define("commonwealthPointThree", $commonwealthDataInCalculator["battleCalculator_pointThree"]);
		define("commonwealthPointFour", $commonwealthDataInCalculator["battleCalculator_pointFour"]);
		define("commonwealthPointFive", $commonwealthDataInCalculator["battleCalculator_pointFive"]);

		//各國總兵力
		$empireTotalMilitaries = $empireDataInCalculator["battleCalculator_empireBase"]+$empireDataInCalculator["battleCalculator_republicBase"]+$empireDataInCalculator["battleCalculator_commonwealthBase"]
		+$empireDataInCalculator["battleCalculator_pointOne"]+$empireDataInCalculator["battleCalculator_pointTwo"]+$empireDataInCalculator["battleCalculator_pointThree"]
		+$empireDataInCalculator["battleCalculator_pointFour"]+$empireDataInCalculator["battleCalculator_pointFive"];
		
		$republicTotalMilitaries = $republicDataInCalculator["battleCalculator_empireBase"]+$republicDataInCalculator["battleCalculator_republicBase"]+$republicDataInCalculator["battleCalculator_commonwealthBase"]
		+$republicDataInCalculator["battleCalculator_pointOne"]+$republicDataInCalculator["battleCalculator_pointTwo"]+$republicDataInCalculator["battleCalculator_pointThree"]
		+$republicDataInCalculator["battleCalculator_pointFour"]+$republicDataInCalculator["battleCalculator_pointFive"];
		
		$commonwealthTotalMilitaries = $commonwealthDataInCalculator["battleCalculator_empireBase"]+$commonwealthDataInCalculator["battleCalculator_republicBase"]+$commonwealthDataInCalculator["battleCalculator_commonwealthBase"]
		+$commonwealthDataInCalculator["battleCalculator_pointOne"]+$commonwealthDataInCalculator["battleCalculator_pointTwo"]+$commonwealthDataInCalculator["battleCalculator_pointThree"]
		+$commonwealthDataInCalculator["battleCalculator_pointFour"]+$commonwealthDataInCalculator["battleCalculator_pointFive"];

		//戰術管理-閃電戰術
		if (empireOperatingTactic=="閃電戰術"){
			$republicDataInCalculator["battleCalculator_operatingTactic"] = "";
			$commonwealthDataInCalculator["battleCalculator_operatingTactic"] = "";
			$empireDataInCalculator["battleCalculator_republicBase"] = $empireDataInCalculator['battleCalculator_republicBase'] / 2;
			$empireDataInCalculator["battleCalculator_commonwealthBase"] = $empireDataInCalculator['battleCalculator_commonwealthBase'] / 2;
		}

		if (empireOperatingTactic=="閃電戰術" && $republicTotalMilitaries > 1000 ){
			$republicLoose = true;
		}
		if (empireOperatingTactic=="閃電戰術" && $commonwealthTotalMilitaries > 1000){
			$commonwealthLoose = true;
		};

		if (republicOperatingTactic=="閃電戰術"){
			$empireDataInCalculator["battleCalculator_operatingTactic"] = "";
			$commonwealthDataInCalculator["battleCalculator_operatingTactic"] = "";
			$republicDataInCalculator["battleCalculator_empireBase"] = $republicDataInCalculator["battleCalculator_empireBase"] / 2;
			$republicDataInCalculator["battleCalculator_commonwealthBase"] = $republicDataInCalculator["battleCalculator_commonwealthBase"] / 2;
		};	

		if (republicOperatingTactic=="閃電戰術" && $empireTotalMilitaries > 1000 ){
			$empireLoose = true;
		}
		if (republicOperatingTactic=="閃電戰術" && $commonwealthTotalMilitaries > 1000){
			$commonwealthLoose = true;
		};
			
		if (commonwealthOperatingTactic=="閃電戰術"){
			$empireDataInCalculator["battleCalculator_operatingTactic"] = "";
			$republicDataInCalculator["battleCalculator_operatingTactic"] = "";
			$commonwealthDataInCalculator["battleCalculator_empireBase"] = $commonwealthDataInCalculator["battleCalculator_empireBase"] / 2;
			$commonwealthDataInCalculator["battleCalculator_republicBase"] = $commonwealthDataInCalculator["battleCalculator_republicBase"] / 2;
		}

		if (commonwealthOperatingTactic=="閃電戰術" && $empireTotalMilitaries > 1000 ){
			$empireLoose = true;
		}
		if (commonwealthOperatingTactic=="閃電戰術" && $republicTotalMilitaries > 1000){
			$republicLoose = true;
		};	

		// 戰術管理-緊急動員
		if($empireDataInCalculator["battleCalculator_operatingTactic"] == "緊急動員" && $empireTotalMilitaries == 600){
			$empireDataInCalculator["battleCalculator_empireBase"] = $empireDataInCalculator["battleCalculator_empireBase"] + 800 ;
			
		};

		if($republicDataInCalculator["battleCalculator_operatingTactic"] == "緊急動員" && $republicTotalMilitaries == 600){
			$republicDataInCalculator["battleCalculator_republicBase"] = $republicDataInCalculator["battleCalculator_republicBase"] + 800 ;
		};

		if($commonwealthDataInCalculator["battleCalculator_operatingTactic"] == "緊急動員" && $commonwealthTotalMilitaries == 600){
			$commonwealthDataInCalculator["battleCalculator_commonwealthBase"] = $commonwealthDataInCalculator["battleCalculator_commonwealthBase"] + 800 ;
		};

		// 戰術管理-防御行動
		if($empireDataInCalculator["battleCalculator_operatingTactic"] == "防御行動" && $empireDataInCalculator['battleCalculator_republicBase'] == 0 && $empireDataInCalculator["battleCalculator_commonwealthBase"] == 0){
			if($empireDataInCalculator["battleCalculator_pointOne"]>0){
			$empireDataInCalculator["battleCalculator_pointOne"] = $empireDataInCalculator["battleCalculator_pointOne"] + 100;
			}

			if($empireDataInCalculator["battleCalculator_pointTwo"]>0){
			$empireDataInCalculator["battleCalculator_pointTwo"] = $empireDataInCalculator["battleCalculator_pointTwo"] + 100;
			}
			
			if($empireDataInCalculator["battleCalculator_pointThree"]>0){
			$empireDataInCalculator["battleCalculator_pointThree"] = $empireDataInCalculator["battleCalculator_pointThree"] + 100;
			}

			if($empireDataInCalculator["battleCalculator_pointFour"]>0){
				$empireDataInCalculator["battleCalculator_pointFour"] = $empireDataInCalculator["battleCalculator_pointFour"] + 100;
			}
			if($empireDataInCalculator["battleCalculator_pointFive"]>0){
			$empireDataInCalculator["battleCalculator_pointFive"] = $empireDataInCalculator["battleCalculator_pointFive"] + 100;
			}
		};

		if($republicDataInCalculator["battleCalculator_operatingTactic"] == "防御行動" && $republicDataInCalculator['battleCalculator_empireBase'] == 0 && $republicDataInCalculator["battleCalculator_commonwealthBase"] == 0){
			if($republicDataInCalculator["battleCalculator_pointOne"]>0){
			$republicDataInCalculator["battleCalculator_pointOne"] = $republicDataInCalculator["battleCalculator_pointOne"] + 100;
			}

			if($republicDataInCalculator["battleCalculator_pointTwo"]>0){
				$republicDataInCalculator["battleCalculator_pointTwo"] = $republicDataInCalculator["battleCalculator_pointTwo"] + 100;
			}
			
			if($republicDataInCalculator["battleCalculator_pointThree"]>0){
			$republicDataInCalculator["battleCalculator_pointThree"] = $republicDataInCalculator["battleCalculator_pointThree"] + 100;
			}

			if($republicDataInCalculator["battleCalculator_pointFour"]>0){
				$republicDataInCalculator["battleCalculator_pointFour"] = $republicDataInCalculator["battleCalculator_pointFour"] + 100;
			}
			if($republicDataInCalculator["battleCalculator_pointFive"]>0){
			$republicDataInCalculator["battleCalculator_pointFive"] = $republicDataInCalculator["battleCalculator_pointFive"] + 100;
			}
		};

		if($commonwealthDataInCalculator["battleCalculator_operatingTactic"] == "防御行動" && $commonwealthDataInCalculator['battleCalculator_republicBase'] == 0 && $commonwealthDataInCalculator["battleCalculator_empireBase"] == 0){
			if($commonwealthDataInCalculator["battleCalculator_pointOne"]>0){
			$commonwealthDataInCalculator["battleCalculator_pointOne"] = $commonwealthDataInCalculator["battleCalculator_pointOne"] + 100;
			}

			if($commonwealthDataInCalculator["battleCalculator_pointTwo"]>0){
			$commonwealthDataInCalculator["battleCalculator_pointTwo"] = $commonwealthDataInCalculator["battleCalculator_pointTwo"] + 100;
			}
			
			if($commonwealthDataInCalculator["battleCalculator_pointThree"]>0){
			$commonwealthDataInCalculator["battleCalculator_pointThree"] = $commonwealthDataInCalculator["battleCalculator_pointThree"] + 100;
			}

			if($commonwealthDataInCalculator["battleCalculator_pointFour"]>0){
				$commonwealthDataInCalculator["battleCalculator_pointFour"] = $commonwealthDataInCalculator["battleCalculator_pointFour"] + 100;
			}
			if($commonwealthDataInCalculator["battleCalculator_pointFive"]>0){
			$commonwealthDataInCalculator["battleCalculator_pointFive"] = $commonwealthDataInCalculator["battleCalculator_pointFive"] + 100;
			}
		};
		// 戰術管理-焦土作戰
		if($empireDataInCalculator["battleCalculator_operatingTactic"] == "焦土作戰"){
			if ($empireDataInCalculator['battleCalculator_pointOne'] >= 200){
				if($empireDataInCalculator['battleCalculator_pointOne'] < $republicDataInCalculator["battleCalculator_pointOne"] || $empireDataInCalculator['battleCalculator_pointOne'] < $commonwealthDataInCalculator["battleCalculator_pointOne"]){
					$winPointOne = 0;
				}
			}
			if ($empireDataInCalculator['battleCalculator_pointTwo'] >= 200){
				if($empireDataInCalculator['battleCalculator_pointTwo'] < $republicDataInCalculator["battleCalculator_pointTwo"] || $empireDataInCalculator['battleCalculator_pointTwo'] < $commonwealthDataInCalculator["battleCalculator_pointTwo"]){
					$winPointTwo = 0;
				}
			}
			if ($empireDataInCalculator['battleCalculator_pointThree'] >= 200){
				if($empireDataInCalculator['battleCalculator_pointThree'] < $republicDataInCalculator["battleCalculator_pointThree"] || $empireDataInCalculator['battleCalculator_pointThree'] < $commonwealthDataInCalculator["battleCalculator_pointThree"]){
					$winPointThree = 0;
				}
			}
			if ($empireDataInCalculator['battleCalculator_pointFour'] >= 200){
				if($empireDataInCalculator['battleCalculator_pointFour'] < $republicDataInCalculator["battleCalculator_pointFour"] || $empireDataInCalculator['battleCalculator_pointFour'] < $commonwealthDataInCalculator["battleCalculator_pointFour"]){
					$winPointFour = 0;
				}
			}
			if ($empireDataInCalculator['battleCalculator_pointFive'] >= 200){
				if($empireDataInCalculator['battleCalculator_pointFive'] < $republicDataInCalculator["battleCalculator_pointFive"] || $empireDataInCalculator['battleCalculator_pointFive'] < $commonwealthDataInCalculator["battleCalculator_pointFive"]){
					$winPointFive = 0;
				}
			}
			
		};	
		
		if($republicDataInCalculator["battleCalculator_operatingTactic"] == "焦土作戰"){
			if ($republicDataInCalculator['battleCalculator_pointOne'] >= 200){
				if($republicDataInCalculator['battleCalculator_pointOne'] < $empireDataInCalculator["battleCalculator_pointOne"] || $republicDataInCalculator['battleCalculator_pointOne'] < $commonwealthDataInCalculator["battleCalculator_pointOne"]){
					$winPointOne = 0;
				}
			}
			if ($republicDataInCalculator['battleCalculator_pointTwo'] >= 200){
				if($republicDataInCalculator['battleCalculator_pointTwo'] < $empireDataInCalculator["battleCalculator_pointTwo"] || $republicDataInCalculator['battleCalculator_pointTwo'] < $commonwealthDataInCalculator["battleCalculator_pointTwo"]){
					$winPointTwo = 0;
				}
			}
			if ($republicDataInCalculator['battleCalculator_pointThree'] >= 200){
				if($republicDataInCalculator['battleCalculator_pointThree'] < $empireDataInCalculator["battleCalculator_pointThree"] || $republicDataInCalculator['battleCalculator_pointThree'] < $commonwealthDataInCalculator["battleCalculator_pointThree"]){
					$winPointThree = 0;
				}
			}
			if ($republicDataInCalculator['battleCalculator_pointFour'] >= 200){
				if($republicDataInCalculator['battleCalculator_pointFour'] < $empireDataInCalculator["battleCalculator_pointFour"] || $republicDataInCalculator['battleCalculator_pointFour'] < $commonwealthDataInCalculator["battleCalculator_pointFour"]){
					$winPointFour = 0;
				}
			}
			if ($republicDataInCalculator['battleCalculator_pointFive'] >= 200){
				if($republicDataInCalculator['battleCalculator_pointFive'] < $empireDataInCalculator["battleCalculator_pointFive"] || $republicDataInCalculator['battleCalculator_pointFive'] < $commonwealthDataInCalculator["battleCalculator_pointFive"]){
					$winPointFive = 0;
				}
			}
		};	
		
		if($commonwealthDataInCalculator["battleCalculator_operatingTactic"] == "焦土作戰"){
			if ($commonwealthDataInCalculator['battleCalculator_pointOne'] >= 200){
				if($commonwealthDataInCalculator['battleCalculator_pointOne'] < $republicDataInCalculator["battleCalculator_pointOne"] || $commonwealthDataInCalculator['battleCalculator_pointOne'] < $empireDataInCalculator["battleCalculator_pointOne"]){
					$winPointOne = 0;
				}
			}
			if ($commonwealthDataInCalculator['battleCalculator_pointTwo'] >= 200){
				if($commonwealthDataInCalculator['battleCalculator_pointTwo'] < $republicDataInCalculator["battleCalculator_pointTwo"] || $commonwealthDataInCalculator['battleCalculator_pointTwo'] < $empireDataInCalculator["battleCalculator_pointTwo"]){
					$winPointTwo = 0;
				}
			}
			if ($commonwealthDataInCalculator['battleCalculator_pointThree'] >= 200){
				if($commonwealthDataInCalculator['battleCalculator_pointThree'] < $republicDataInCalculator["battleCalculator_pointThree"] || $commonwealthDataInCalculator['battleCalculator_pointThree'] < $empireDataInCalculator["battleCalculator_pointThree"]){
					$winPointThree = 0;
				}
			}
			if ($commonwealthDataInCalculator['battleCalculator_pointFour'] >= 200){
				if($commonwealthDataInCalculator['battleCalculator_pointFour'] < $republicDataInCalculator["battleCalculator_pointFour"] || $commonwealthDataInCalculator['battleCalculator_pointFour'] < $empireDataInCalculator["battleCalculator_pointFour"]){
					$winPointFour = 0;
				}
			}
			if ($commonwealthDataInCalculator['battleCalculator_pointFive'] >= 200){
				if($commonwealthDataInCalculator['battleCalculator_pointFive'] < $republicDataInCalculator["battleCalculator_pointFive"] || $commonwealthDataInCalculator['battleCalculator_pointFive'] < $empireDataInCalculator["battleCalculator_pointFive"]){
					$winPointFive = 0;
				}
			}

		};			
		// 戰術管理-虛假情報
		// 虛假情報-皇國vs民國篇
		if($empireDataInCalculator["battleCalculator_operatingTactic"] == "虛假情報"){
			if (empireEmpireBase > republicPointOne && empirePointOne > 0){
				if($republicDataInCalculator['battleCalculator_pointOne'] > 100){
				$republicDataInCalculator['battleCalculator_pointOne'] = $republicDataInCalculator['battleCalculator_pointOne'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointOne'] = 0;
				};
			};
			if (empireEmpireBase > republicPointTwo && empirePointTwo > 0){
				if($republicDataInCalculator['battleCalculator_pointTwo'] > 100){
				$republicDataInCalculator['battleCalculator_pointTwo'] = $republicDataInCalculator['battleCalculator_pointTwo'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointTwo'] = 0;
				};
			};
			if (empireEmpireBase > republicPointThree && empirePointThree > 0){
				if($republicDataInCalculator['battleCalculator_pointThree'] > 100){
				$republicDataInCalculator['battleCalculator_pointThree'] = $republicDataInCalculator['battleCalculator_pointThree'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointThree'] = 0;
				};
			};
			if (empireEmpireBase > republicPointFour && empirePointFour > 0){
				if($republicDataInCalculator['battleCalculator_pointFour'] > 100){
				$republicDataInCalculator['battleCalculator_pointFour'] = $republicDataInCalculator['battleCalculator_pointFour'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointFour'] = 0;
				};
			};
			if (empireEmpireBase > republicPointFive && empirePointFive > 0){
				if($republicDataInCalculator['battleCalculator_pointFive'] > 100){
				$republicDataInCalculator['battleCalculator_pointFive'] = $republicDataInCalculator['battleCalculator_pointFive'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointFive'] = 0;
				};
			};
			
			// 虛假情報-皇國vs國協篇
			if (empireEmpireBase > commonwealthPointOne && empirePointOne > 0){
				if($commonwealthDataInCalculator['battleCalculator_pointOne'] > 100){
				$commonwealthDataInCalculator['battleCalculator_pointOne'] = $commonwealthDataInCalculator['battleCalculator_pointOne'] - 100;
				}
				else{
					$commonwealthDataInCalculator['battleCalculator_pointOne'] = 0;
				};
			};
			if (empireEmpireBase > commonwealthPointTwo && empirePointTwo > 0){
				if($commonwealthDataInCalculator['battleCalculator_pointTwo'] > 100){
				$commonwealthDataInCalculator['battleCalculator_pointTwo'] = $commonwealthDataInCalculator['battleCalculator_pointTwo'] - 100;
				}
				else{
					$commonwealthDataInCalculator['battleCalculator_pointTwo'] = 0;
				};
			};
			if (empireEmpireBase > commonwealthPointThree && empirePointThree > 0){
				if($commonwealthDataInCalculator['battleCalculator_pointThree'] > 100){
				$commonwealthDataInCalculator['battleCalculator_pointThree'] = $commonwealthDataInCalculator['battleCalculator_pointThree'] - 100;
				}
				else{
					$commonwealthDataInCalculator['battleCalculator_pointThree'] = 0;
				};
			};
			if (empireEmpireBase > commonwealthPointFour && empirePointFour > 0){
				if($commonwealthDataInCalculator['battleCalculator_pointFour'] > 100){
				$commonwealthDataInCalculator['battleCalculator_pointFour'] = $commonwealthDataInCalculator['battleCalculator_pointFour'] - 100;
				}
				else{
					$commonwealthDataInCalculator['battleCalculator_pointFour'] = 0;
				};
			};
			if (empireEmpireBase > commonwealthPointFive && empirePointFive > 0){
				if($commonwealthDataInCalculator['battleCalculator_pointFive'] > 100){
				$commonwealthDataInCalculator['battleCalculator_pointFive'] = $commonwealthDataInCalculator['battleCalculator_pointFive'] - 100;
				}
				else{
					$commonwealthDataInCalculator['battleCalculator_pointFive'] = 0;
				};
			};
		};
			// 虛假情報-民國vs皇國篇
		if($republicDataInCalculator["battleCalculator_operatingTactic"] == "虛假情報"){
			if (republicRepublicBase > empirePointOne && republicPointOne > 0){
				if($empireDataInCalculator['battleCalculator_pointOne'] > 100){
				$empireDataInCalculator['battleCalculator_pointOne'] = $empireDataInCalculator['battleCalculator_pointOne'] - 100;
				}
				else{
					$empireDataInCalculator['battleCalculator_pointOne'] = 0;
				};
			};
			if (republicRepublicBase > empirePointTwo && republicPointTwo > 0){
				if($empireDataInCalculator['battleCalculator_pointTwo'] > 100){
				$empireDataInCalculator['battleCalculator_pointTwo'] = $empireDataInCalculator['battleCalculator_pointTwo'] - 100;
				}
				else{
					$empireDataInCalculator['battleCalculator_pointTwo'] = 0;
				};
			};
			if (republicRepublicBase > empirePointThree && republicPointThree > 0){
				if($empireDataInCalculator['battleCalculator_pointThree'] > 100){
				$empireDataInCalculator['battleCalculator_pointThree'] = $empireDataInCalculator['battleCalculator_pointThree'] - 100;
				}
				else{
					$empireDataInCalculator['battleCalculator_pointThree'] = 0;
				};
			};
			if (republicRepublicBase > empirePointFour && republicPointFour > 0){
				if($empireDataInCalculator['battleCalculator_pointFour'] > 100){
				$empireDataInCalculator['battleCalculator_pointFour'] = $empireDataInCalculator['battleCalculator_pointFour'] - 100;
				}
				else{
					$empireDataInCalculator['battleCalculator_pointFour'] = 0;
				};
			};
			if (republicRepublicBase > empirePointFive && republicPointFive > 0){
				if($empireDataInCalculator['battleCalculator_pointFive'] > 100){
				$empireDataInCalculator['battleCalculator_pointFive'] = $empireDataInCalculator['battleCalculator_pointFive'] - 100;
				}
				else{
					$empireDataInCalculator['battleCalculator_pointFive'] = 0;
				};
			};
			// 虛假情報-民國vs國協篇
			if (republicRepublicBase > commonwealthPointOne && republicPointOne > 0){
				if($commonwealthDataInCalculator['battleCalculator_pointOne'] > 100){
				$commonwealthDataInCalculator['battleCalculator_pointOne'] = $commonwealthDataInCalculator['battleCalculator_pointOne'] - 100;
				}
				else{
					$commonwealthDataInCalculator['battleCalculator_pointOne'] = 0;
				};
			};
			if (republicRepublicBase > commonwealthPointTwo && republicPointTwo > 0){
				if($commonwealthDataInCalculator['battleCalculator_pointTwo'] > 100){
				$commonwealthDataInCalculator['battleCalculator_pointTwo'] = $commonwealthDataInCalculator['battleCalculator_pointTwo'] - 100;
				}
				else{
					$commonwealthDataInCalculator['battleCalculator_pointTwo'] = 0;
				};
			};
			if (republicRepublicBase > commonwealthPointThree && republicPointThree > 0){
				if($commonwealthDataInCalculator['battleCalculator_pointThree'] > 100){
				$commonwealthDataInCalculator['battleCalculator_pointThree'] = $commonwealthDataInCalculator['battleCalculator_pointThree'] - 100;
				}
				else{
					$commonwealthDataInCalculator['battleCalculator_pointThree'] = 0;
				};
			};
			if (republicRepublicBase > commonwealthPointFour && republicPointFour > 0){
				if($commonwealthDataInCalculator['battleCalculator_pointFour'] > 100){
				$commonwealthDataInCalculator['battleCalculator_pointFour'] = $commonwealthDataInCalculator['battleCalculator_pointFour'] - 100;
				}
				else{
					$commonwealthDataInCalculator['battleCalculator_pointFour'] = 0;
				};
			};
			if (republicRepublicBase > commonwealthPointFive && republicPointFive > 0){
				if($commonwealthDataInCalculator['battleCalculator_pointFive'] > 100){
				$commonwealthDataInCalculator['battleCalculator_pointFive'] = $commonwealthDataInCalculator['battleCalculator_pointFive'] - 100;
				}
				else{
					$commonwealthDataInCalculator['battleCalculator_pointFive'] = 0;
				};
			};

			

		};
		// 虛假情報-國協vs皇國篇
		if($commonwealthDataInCalculator["battleCalculator_operatingTactic"] == "虛假情報"){
			if (commonwealthCommonwealthBase > empirePointOne && commonwealthPointOne > 0){
				if($republicDataInCalculator['battleCalculator_pointOne'] > 100){
				$republicDataInCalculator['battleCalculator_pointOne'] = $republicDataInCalculator['battleCalculator_pointOne'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointOne'] = 0;
				};
			};
			if (commonwealthCommonwealthBase > empirePointTwo && commonwealthPointTwo > 0){
				if($republicDataInCalculator['battleCalculator_pointTwo'] > 100){
				$republicDataInCalculator['battleCalculator_pointTwo'] = $republicDataInCalculator['battleCalculator_pointTwo'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointTwo'] = 0;
				};
			};
			if (commonwealthCommonwealthBase > empirePointThree && commonwealthPointThree > 0){
				if($republicDataInCalculator['battleCalculator_pointThree'] > 100){
				$republicDataInCalculator['battleCalculator_pointThree'] = $republicDataInCalculator['battleCalculator_pointThree'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointThree'] = 0;
				};
			};
			if (commonwealthCommonwealthBase > empirePointFour && commonwealthPointFour > 0){
				if($republicDataInCalculator['battleCalculator_pointFour'] > 100){
				$republicDataInCalculator['battleCalculator_pointFour'] = $republicDataInCalculator['battleCalculator_pointFour'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointFour'] = 0;
				};
			};
			if (commonwealthCommonwealthBase > empirePointFive && commonwealthPointFive > 0){
				if($republicDataInCalculator['battleCalculator_pointFive'] > 100){
				$republicDataInCalculator['battleCalculator_pointFive'] = $republicDataInCalculator['battleCalculator_pointFive'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointFive'] = 0;
				};
			};
			// 虛假情報-國協vs民國篇
			if (commonwealthCommonwealthBase > republicPointOne && commonwealthPointOne > 0){
				if($republicDataInCalculator['battleCalculator_pointOne'] > 100){
				$republicDataInCalculator['battleCalculator_pointOne'] = $republicDataInCalculator['battleCalculator_pointOne'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointOne'] = 0;
				};
			};
			if (commonwealthCommonwealthBase > republicPointTwo && commonwealthPointTwo > 0){
				if($republicDataInCalculator['battleCalculator_pointTwo'] > 100){
				$republicDataInCalculator['battleCalculator_pointTwo'] = $republicDataInCalculator['battleCalculator_pointTwo'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointTwo'] = 0;
				};
			};
			if (commonwealthCommonwealthBase > republicPointThree && commonwealthPointThree > 0){
				if($republicDataInCalculator['battleCalculator_pointThree'] > 100){
				$republicDataInCalculator['battleCalculator_pointThree'] = $republicDataInCalculator['battleCalculator_pointThree'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointThree'] = 0;
				};
			};
			if (commonwealthCommonwealthBase > republicPointFour && commonwealthPointFour > 0){
				if($republicDataInCalculator['battleCalculator_pointFour'] > 100){
				$republicDataInCalculator['battleCalculator_pointFour'] = $republicDataInCalculator['battleCalculator_pointFour'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointFour'] = 0;
				};
			};
			if (commonwealthCommonwealthBase > republicPointFive && commonwealthPointFive > 0){
				if($republicDataInCalculator['battleCalculator_pointFive'] > 100){
				$republicDataInCalculator['battleCalculator_pointFive'] = $republicDataInCalculator['battleCalculator_pointFive'] - 100;
				}
				else{
					$republicDataInCalculator['battleCalculator_pointFive'] = 0;
				};
			};
		}
		
		// 戰術管理-背水一戰
		if($empireDataInCalculator["battleCalculator_operatingTactic"] == "背水一戰" && $empireTotalMilitaries == 300){
			$empireGloryBattle = 4;
			
		};

		if($republicDataInCalculator["battleCalculator_operatingTactic"] == "背水一戰" && $republicTotalMilitaries == 300){
			$republicGloryBattle = 4;
		};

		if($commonwealthDataInCalculator["battleCalculator_operatingTactic"] == "背水一戰" && $commonwealthTotalMilitaries == 300){
			$commonwealthGloryBattle = 4;
		};
		
		//戰術管理-跳島作戰
		if($empireDataInCalculator["battleCalculator_operatingTactic"] == "跳島作戰" && 
		$empireDataInCalculator['battleCalculator_republicBase'] > $republicDataInCalculator['battleCalculator_republicBase'] &&
		$empireDataInCalculator['battleCalculator_republicBase'] > $commonwealthDataInCalculator['battleCalculator_republicBase']){
			$empireMarks = $empireMarks +2;
		};

		if($empireDataInCalculator["battleCalculator_operatingTactic"] == "跳島作戰" && 
		$empireDataInCalculator['battleCalculator_commonwealthBase'] > $republicDataInCalculator['battleCalculator_commonwealthBase'] &&
		$empireDataInCalculator['battleCalculator_commonwealthBase'] > $commonwealthDataInCalculator['battleCalculator_commonwealthBase']){
			$empireMarks = $empireMarks +2;
		};

		if($republicDataInCalculator["battleCalculator_operatingTactic"] == "跳島作戰" && 
		$republicDataInCalculator['battleCalculator_empireBase'] > $empireDataInCalculator['battleCalculator_empireBase'] &&
		$republicDataInCalculator['battleCalculator_empireBase'] > $commonwealthDataInCalculator['battleCalculator_empireBase']){
			$republicMarks = $republicMarks +2;
		};

		if($republicDataInCalculator["battleCalculator_operatingTactic"] == "跳島作戰" && 
		$republicDataInCalculator['battleCalculator_commonwealthBase'] > $empireDataInCalculator['battleCalculator_commonwealthBase'] &&
		$republicDataInCalculator['battleCalculator_commonwealthBase'] > $commonwealthDataInCalculator['battleCalculator_commonwealthBase']){
			$republicMarks = $republicMarks +2;
		};

		if($commonwealthDataInCalculator["battleCalculator_operatingTactic"] == "跳島作戰" && 
		$commonwealthDataInCalculator['battleCalculator_empireBase'] > $empireDataInCalculator['battleCalculator_empireBase'] &&
		$commonwealthDataInCalculator['battleCalculator_empireBase'] > $republicDataInCalculator['battleCalculator_empireBase']){
			$commonwealthMarks = $commonwealthMarks +2;
		};
		
		if($commonwealthDataInCalculator["battleCalculator_operatingTactic"] == "跳島作戰" && 
		$commonwealthDataInCalculator['battleCalculator_republicBase'] > $empireDataInCalculator['battleCalculator_republicBase'] &&
		$commonwealthDataInCalculator['battleCalculator_republicBase'] > $republicDataInCalculator['battleCalculator_republicBase']){
			$commonwealthMarks = $commonwealthMarks +2;
		};
		
		//基地淪陷計算
		if (($empireDataInCalculator['battleCalculator_empireBase'] < $republicDataInCalculator['battleCalculator_empireBase']) or ($empireDataInCalculator['battleCalculator_empireBase'] < $commonwealthDataInCalculator['battleCalculator_empireBase'])) {
			$empireLoose = true;
			$empireMarks = -9999;
			$changeEmpirePrivilege=$changeEmpirePrivilege-2;
		}


		if (($republicDataInCalculator['battleCalculator_republicBase'] < $empireDataInCalculator['battleCalculator_republicBase']) or ($republicDataInCalculator['battleCalculator_republicBase'] < $commonwealthDataInCalculator['battleCalculator_republicBase'])) {
			$republicLoose = true;
			$republicMarks = -9999;
			$changeRepublicPrivilege=$changeRepublicPrivilege-2;
		}


		if (($commonwealthDataInCalculator['battleCalculator_commonwealthBase'] < $empireDataInCalculator['battleCalculator_commonwealthBase']) or ($commonwealthDataInCalculator['battleCalculator_commonwealthBase'] < $republicDataInCalculator['battleCalculator_commonwealthBase'])) {
			$commonwealthLoose = true;
			$commonwealthMarks = -9999;
			$changeCommonwealthPrivilege=$changeCommonwealthPrivilege-2;
		}

		//勝利點計算
		//勝利點計算-皇國篇
		if (($empireDataInCalculator['battleCalculator_pointOne'] > $republicDataInCalculator['battleCalculator_pointOne']) and ($empireDataInCalculator['battleCalculator_pointOne'] > $commonwealthDataInCalculator['battleCalculator_pointOne'])){
			$republicLossPointOne = 1;
			$commonwealthLossPointOne = 1;
			$empireMarks=$empireMarks+$winPointOne;
		}else if (($republicDataInCalculator['battleCalculator_pointOne'] > $empireDataInCalculator['battleCalculator_pointOne']) and ($republicDataInCalculator['battleCalculator_pointOne'] > $commonwealthDataInCalculator['battleCalculator_pointOne'])){
			$empireLossPointOne = 1;
			$commonwealthLossPointOne = 1;
			$republicMarks=$republicMarks+$winPointOne;
		}else if (($commonwealthDataInCalculator['battleCalculator_pointOne'] > $empireDataInCalculator['battleCalculator_pointOne']) and ($commonwealthDataInCalculator['battleCalculator_pointOne'] > $republicDataInCalculator['battleCalculator_pointOne'])){
			$empireLossPointOne = 1;
			$republicLossPointOne = 1;
			$commonwealthMarks=$commonwealthMarks+$winPointOne;
		}

		if (($empireDataInCalculator['battleCalculator_pointTwo'] > $republicDataInCalculator['battleCalculator_pointTwo']) and ($empireDataInCalculator['battleCalculator_pointTwo'] > $commonwealthDataInCalculator['battleCalculator_pointTwo'])){
			$republicLossPointTwo = 1;
			$commonwealthLossPointTwo = 1;
			$empireMarks=$empireMarks+$winPointTwo;
		}else if (($republicDataInCalculator['battleCalculator_pointTwo'] > $empireDataInCalculator['battleCalculator_pointTwo']) and ($republicDataInCalculator['battleCalculator_pointTwo'] > $commonwealthDataInCalculator['battleCalculator_pointTwo'])){
			$empireLossPointTwo = 1;
			$commonwealthLossPointTwo = 1;
			$republicMarks=$republicMarks+$winPointTwo;
		}else if (($commonwealthDataInCalculator['battleCalculator_pointTwo'] > $empireDataInCalculator['battleCalculator_pointTwo']) and ($commonwealthDataInCalculator['battleCalculator_pointTwo'] > $republicDataInCalculator['battleCalculator_pointTwo'])){
			$empireLossPointTwo = 1;
			$republicLossPointTwo = 1;
			$commonwealthMarks=$commonwealthMarks+$winPointTwo;
		}

		if (($empireDataInCalculator['battleCalculator_pointThree'] > $republicDataInCalculator['battleCalculator_pointThree']) and ($empireDataInCalculator['battleCalculator_pointThree'] > $commonwealthDataInCalculator['battleCalculator_pointThree'])){
			$republicLossPointThree = 1;
			$commonwealthLossPointThree = 1;
			$empireMarks=$empireMarks+$winPointThree;
		}else if (($republicDataInCalculator['battleCalculator_pointThree'] > $empireDataInCalculator['battleCalculator_pointThree']) and ($republicDataInCalculator['battleCalculator_pointThree'] > $commonwealthDataInCalculator['battleCalculator_pointThree'])){
			$empireLossPointThree = 1;
			$commonwealthLossPointThree = 1;
			$republicMarks=$republicMarks+$winPointThree;
		}else if (($commonwealthDataInCalculator['battleCalculator_pointThree'] > $empireDataInCalculator['battleCalculator_pointThree']) and ($commonwealthDataInCalculator['battleCalculator_pointThree'] > $republicDataInCalculator['battleCalculator_pointThree'])){
			$empireLossPointThree = 1;
			$republicLossPointThree = 1;
			$commonwealthMarks=$commonwealthMarks+$winPointThree;
		}

		if (($empireDataInCalculator['battleCalculator_pointFour'] > $republicDataInCalculator['battleCalculator_pointFour']) and ($empireDataInCalculator['battleCalculator_pointFour'] > $commonwealthDataInCalculator['battleCalculator_pointFour'])){
			$republicLossPointFour = 1;
			$commonwealthLossPointFour = 1;
			$empireMarks=$empireMarks+$winPointFour;
		}else if (($republicDataInCalculator['battleCalculator_pointFour'] > $empireDataInCalculator['battleCalculator_pointFour']) and ($republicDataInCalculator['battleCalculator_pointFour'] > $commonwealthDataInCalculator['battleCalculator_pointFour'])){
			$empireLossPointFour = 1;
			$commonwealthLossPointFour = 1;
			$republicMarks=$republicMarks+$winPointFour;
		}else if (($commonwealthDataInCalculator['battleCalculator_pointFour'] > $empireDataInCalculator['battleCalculator_pointFour']) and ($commonwealthDataInCalculator['battleCalculator_pointFour'] > $republicDataInCalculator['battleCalculator_pointFour'])){
			$empireLossPointFour = 1;
			$republicLossPointFour = 1;
			$commonwealthMarks=$commonwealthMarks+$winPointFour;
		}

		if (($empireDataInCalculator['battleCalculator_pointFive'] > $republicDataInCalculator['battleCalculator_pointFive']) and ($empireDataInCalculator['battleCalculator_pointFive'] > $commonwealthDataInCalculator['battleCalculator_pointFive'])){
			$republicLossPointFive = 1;
			$commonwealthLossPointFive = 1;
			$empireMarks=$empireMarks+$winPointFive;
		}else if (($republicDataInCalculator['battleCalculator_pointFive'] > $empireDataInCalculator['battleCalculator_pointFive']) and ($republicDataInCalculator['battleCalculator_pointFive'] > $commonwealthDataInCalculator['battleCalculator_pointFive'])){
			$empireLossPointFive = 1;
			$commonwealthLossPointFive = 1;
			$republicMarks=$republicMarks+$winPointFive;
		}else if (($commonwealthDataInCalculator['battleCalculator_pointFive'] > $empireDataInCalculator['battleCalculator_pointFive']) and ($commonwealthDataInCalculator['battleCalculator_pointFive'] > $republicDataInCalculator['battleCalculator_pointFive'])){
			$empireLossPointFive = 1;
			$republicLossPointFive = 1;
			$commonwealthMarks=$commonwealthMarks+$winPointFive;
		}

		// 戰術管理-軍國主義
		$empireTotalLossPoint = $empireLossPointOne + $empireLossPointTwo + $empireLossPointThree + $empireLossPointFour + $empireLossPointFive;
		$republicTotalLossPoint = $republicLossPointOne + $republicLossPointTwo + $republicLossPointThree + $republicLossPointFour + $republicLossPointFive;
		$commonwealthTotalLossPoint = $commonwealthLossPointOne + $commonwealthLossPointTwo + $commonwealthLossPointThree + $commonwealthLossPointFour + $commonwealthLossPointFive;

		if($empireDataInCalculator["battleCalculator_operatingTactic"] == "軍國主義" && $empireTotalLossPoint >= 2){
			$empireLoose = true;
		};

		if($republicDataInCalculator["battleCalculator_operatingTactic"] == "軍國主義" && $republicTotalLossPoint >= 2){
			$republicLoose = true;
			
		};

		if($commonwealthDataInCalculator["battleCalculator_operatingTactic"] == "軍國主義" && $commonwealthTotalLossPoint >= 2){
			$commonwealthLoose = true;
			
		};

		//基地淪陷
		if ($empireLoose == true){
			$empireMarks = -9999;
			$empireResult = "基地淪陷";	
			// echo "基地淪陷，皇國戰敗。";
		}
		else{
			$empireResult = "皇國勝利點: ".$empireMarks;	
			// echo $empireMarks;
		}
		

		
		if ($republicLoose == true){
			$republicMarks = -9999;
			$republicResult = "基地淪陷";	
		}
			// echo "基地淪陷，民國戰敗。";
		else{
			$republicResult = "民國勝利點: ".$republicMarks;	
		}
			// echo $republicMarks;
		


		if ($commonwealthLoose == true){
			$commonwealthMarks = -9999;
			$commonwealthResult = "基地淪陷";	
		}
			// echo "基地淪陷，國協戰敗。";
		else{
			$commonwealthResult = "國協勝利點: ".$commonwealthMarks;	
		}
			// echo $commonwealthMarks;


		// 戰役結果
		if ($empireLoose == 0) {
			if (($empireMarks > $republicMarks) and ($empireMarks > $commonwealthMarks)) {
				$changeEmpirePrivilege = 1 + $empireGloryBattle;
				$winner = "皇國戰利";
			}
		}

		if ($republicLoose == 0) {
			if (($republicMarks > $empireMarks) and ($republicMarks > $commonwealthMarks)) {
				$changeRepublicPrivilege = 1 + $republicGloryBattle;
				$winner = "民國勝利";
			}
		}

		if ($commonwealthLoose == 0) {
			if (($commonwealthMarks > $empireMarks) and ($commonwealthMarks > $republicMarks)) {
				$changeCommonwealthPrivilege = 1 + $commonwealthGloryBattle;
				$winner = "國協勝利";
			}
		}
		
		
		//更新新部署兵力變數
		$newEmpireDeployEmpireBase = $empireDataInCalculator["battleCalculator_empireBase"];
		$newEmpireDeployRepbulicBase = $empireDataInCalculator["battleCalculator_republicBase"];
		$newEmpireDeployCommonwealthBase = $empireDataInCalculator["battleCalculator_commonwealthBase"];
		$newEmpireDeployPointOne = $empireDataInCalculator["battleCalculator_pointOne"];
		$newEmpireDeployPointTwo = $empireDataInCalculator["battleCalculator_pointTwo"];
		$newEmpireDeployPointThree = $empireDataInCalculator["battleCalculator_pointThree"];
		$newEmpireDeployPointFour = $empireDataInCalculator["battleCalculator_pointFour"];
		$newEmpireDeployPointFive = $empireDataInCalculator["battleCalculator_pointFive"];
		
		$newRepbulicDeployEmpireBase = $republicDataInCalculator["battleCalculator_empireBase"];
		$newRepbulicDeployRepbulicBase = $republicDataInCalculator["battleCalculator_republicBase"];
		$newRepbulicDeployCommonwealthBase = $republicDataInCalculator["battleCalculator_commonwealthBase"];
		$newRepbulicDeployPointOne = $republicDataInCalculator["battleCalculator_pointOne"];
		$newRepbulicDeployPointTwo = $republicDataInCalculator["battleCalculator_pointTwo"];
		$newRepbulicDeployPointThree = $republicDataInCalculator["battleCalculator_pointThree"];
		$newRepbulicDeployPointFour = $republicDataInCalculator["battleCalculator_pointFour"];
		$newRepbulicDeployPointFive = $republicDataInCalculator["battleCalculator_pointFive"];

		$newCommonwealthDeployEmpireBase = $commonwealthDataInCalculator["battleCalculator_empireBase"];
		$newCommonwealthDeployRepbulicBase = $commonwealthDataInCalculator["battleCalculator_republicBase"];
		$newCommonwealthDeployCommonwealthBase = $commonwealthDataInCalculator["battleCalculator_commonwealthBase"];
		$newCommonwealthDeployPointOne = $commonwealthDataInCalculator["battleCalculator_pointOne"];
		$newCommonwealthDeployPointTwo = $commonwealthDataInCalculator["battleCalculator_pointTwo"];
		$newCommonwealthDeployPointThree = $commonwealthDataInCalculator["battleCalculator_pointThree"];
		$newCommonwealthDeployPointFour = $commonwealthDataInCalculator["battleCalculator_pointFour"];
		$newCommonwealthDeployPointFive = $commonwealthDataInCalculator["battleCalculator_pointFive"];

		//更新戰役勢力新部署兵力與分數
		$updateEmpireResult = $conn->prepare("UPDATE battleCalculator SET battleCalculator_empireBase = '$newEmpireDeployEmpireBase', battleCalculator_republicBase = '$newEmpireDeployRepbulicBase', battleCalculator_commonwealthBase = '$newEmpireDeployCommonwealthBase', 
		battleCalculator_pointOne = '$newEmpireDeployPointOne', battleCalculator_pointTwo = '$newEmpireDeployPointTwo', battleCalculator_pointThree = '$newEmpireDeployPointThree', 
		battleCalculator_pointFour = '$newEmpireDeployPointFour', battleCalculator_pointFive = '$newEmpireDeployPointFive',
		battleCalculator_result = '$empireResult' WHERE battleCalculator_battleField_id = '$battleCalculator_battleField_id' AND battleCalculator_country_name='$empireName'");
		$updateEmpireResult->execute();

		$updateRepublicResult = $conn->prepare("UPDATE battleCalculator SET battleCalculator_empireBase = '$newRepbulicDeployEmpireBase', battleCalculator_republicBase = '$newRepbulicDeployRepbulicBase', battleCalculator_commonwealthBase = '$newRepbulicDeployCommonwealthBase', 
		battleCalculator_pointOne = '$newRepbulicDeployPointOne', battleCalculator_pointTwo = '$newRepbulicDeployPointTwo', battleCalculator_pointThree = '$newRepbulicDeployPointThree', 
		battleCalculator_pointFour = '$newRepbulicDeployPointFour', battleCalculator_pointFive = '$newRepbulicDeployPointFive',
		battleCalculator_result = '$republicResult' WHERE battleCalculator_battleField_id = '$battleCalculator_battleField_id' AND battleCalculator_country_name='$republicName'");
		$updateRepublicResult->execute();

		$updateCommonwealthResult = $conn->prepare("UPDATE battleCalculator SET battleCalculator_empireBase = '$newCommonwealthDeployEmpireBase', battleCalculator_republicBase = '$newCommonwealthDeployRepbulicBase', battleCalculator_commonwealthBase = '$newCommonwealthDeployCommonwealthBase', 
		battleCalculator_pointOne = '$newCommonwealthDeployPointOne', battleCalculator_pointTwo = '$newCommonwealthDeployPointTwo', battleCalculator_pointThree = '$newCommonwealthDeployPointThree', 
		battleCalculator_pointFour = '$newCommonwealthDeployPointFour', battleCalculator_pointFive = '$newCommonwealthDeployPointFive', 
		battleCalculator_result = '$commonwealthResult' WHERE battleCalculator_battleField_id = '$battleCalculator_battleField_id' AND battleCalculator_country_name='$commonwealthName'");
		$updateCommonwealthResult->execute();

		//更新戰鬥狀態
		$updateBattleField_status = $conn->prepare("UPDATE battleField SET battleField_status = '$winner' WHERE battleField_id = '$battleCalculator_battleField_id'");
		$updateBattleField_status->execute();

		//更新國家聲望
		$updateEmpirePrivilege = $conn->prepare("UPDATE country SET country_privilege = country_privilege+$changeEmpirePrivilege WHERE country_name = '漢諾莎皇國'");
		$updateEmpirePrivilege->execute();
		$updateRepublicPrivilege = $conn->prepare("UPDATE country SET country_privilege = country_privilege+$changeRepublicPrivilege WHERE country_name = '波瑪倫民國'");
		$updateRepublicPrivilege->execute();
		$updateCommonwealthPrivilege = $conn->prepare("UPDATE country SET country_privilege = country_privilege+$changeCommonwealthPrivilege WHERE country_name = '烏斯爾登國協'");
		$updateCommonwealthPrivilege->execute();
		echo "<script>console.log('calculation success' );</script>";

		//創建新戰場
		$newBattle = $conn->prepare("INSERT INTO battleField (battleField_battleInfo_name, 	battleField_status) VALUES (:battleField_battleInfo_name, :battleField_status)");
		$newBattle->bindparam(":battleField_battleInfo_name", $battleFieldData['battleField_battleInfo_name']);
		$newBattle->bindparam(":battleField_status", $newValueBattleField_status);
		$newValueBattleField_status = '未分高下';
		$newBattle->execute();
		echo "<script>console.log('create new battilefield success' );</script>";
	}

		
} 
catch (PDOException $e) { {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
}
?>