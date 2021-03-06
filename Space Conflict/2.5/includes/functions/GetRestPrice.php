<?php

/******************************************
**            Oasis Rage 2.0             **
**             by darkOasis              **
**                                       **
**  special thanks to the developers of  **
**    XNova, Ugamela and RageOnline      **
**                                       **
** GetRestPrice.php                      **
******************************************/

function GetRestPrice ($user, $planet, $Element, $userfactor = true) {
	global $pricelist, $resource, $lang;

	if ($userfactor) {
		$level = ($planet[$resource[$Element]]) ? $planet[$resource[$Element]] : $user[$resource[$Element]];
	}

	$array = array(
		'metal'      => $lang["Metal"],
		'crystal'    => $lang["Crystal"],
		'deuterium'  => $lang["Deuterium"],
		'tachyon'    => $lang["Tachyon"],
		'energy_max' => $lang["Energy"]
		);

	$text  = "<br><font color=\"#7f7f7f\">". $lang['Rest_ress'] .": ";
	foreach ($array as $ResType => $ResTitle) {
		if ($pricelist[$Element][$ResType] != 0) {
			$text .= $ResTitle . ": ";
			if ($userfactor) {
				$cost = floor($pricelist[$Element][$ResType] * pow($pricelist[$Element]['factor'], $level));
			} else {
				$cost = floor($pricelist[$Element][$ResType]);
			}
			if ($cost > $planet[$ResType]) {
				$text .= "<b style=\"color: rgb(127, 95, 96);\">". pretty_number($planet[$ResType] - $cost) ."</b> ";
			} else {
				$text .= "<b style=\"color: rgb(95, 127, 108);\">". pretty_number($planet[$ResType] - $cost) ."</b> ";
			}
		}
	}
	$text .= "</font>";

	return $text;
}

/******************************************************************************************
**                                    Revision Notes                                     **
**  @ Official OasisRage 2.0 release - May 2009 - darkOasis                              **
**  @ (please note any changes you make to the source code)                              **
**  @                                                                                    **
**                                                                                       **
******************************************************************************************/

?>