<?php

switch($_SESSION["user_country_name"]){
    case "漢諾莎皇國":
    $countryParticipation = ($row["battlefield_empireParticipation"]);
    break;
    case "波瑪倫民國":
    $countryParticipation = $row["battlefield_republicParticipation"];
    break;
    case "烏斯爾登國協":
    $countryParticipation = $row["battlefield_commonwealthParticipation"];
    break;
}

?>