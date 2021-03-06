<?php

/******************************************
**            Oasis Rage 2.0             **
**             by darkOasis              **
**                                       **
**  special thanks to the developers of  **
**    XNova, Ugamela and RageOnline      **
**                                       **
** ElementQueueFixer.php                 **
******************************************/

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xnova_root_path = '../';
include($xnova_root_path . 'extension.inc');
include($xnova_root_path . 'common.' . $phpEx);

if ($user['authlevel'] >= 1) {
	includeLang('admin');

	$QrySelectPlanet  = "SELECT `id`, `id_owner`, `b_hangar`, `b_hangar_id` ";
	$QrySelectPlanet .= "FROM {{table}} ";
	$QrySelectPlanet .= "WHERE ";
	$QrySelectPlanet .= "`b_hangar_id` != '0';";
	$AffectedPlanets  = doquery ($QrySelectPlanet, 'planets');
	$DeletedQueues    = 0;
	while ( $ActualPlanet = mysql_fetch_assoc($AffectedPlanets) ) {
		$HangarQueue = explode (";", $ActualPlanet['b_hangar_id']);
		$bDelQueue   = false;
		if (count($HangarQueue)) {
			for ( $Queue = 0; $Queue < count($HangarQueue); $Queue++) {
				$InQueue = explode (",", $HangarQueue[$Queue]);
				if ($InQueue[1] > MAX_FLEET_OR_DEFS_PER_ROW) {
					$bDelQueue = true;
				}
			}
		}
		if ($bDelQueue) {
			$QryUpdatePlanet  = "UPDATE {{table}} ";
			$QryUpdatePlanet .= "SET ";
			$QryUpdatePlanet .= "`b_hangar` = '0', ";
			$QryUpdatePlanet .= "`b_hangar_id` = '0' ";
			$QryUpdatePlanet .= "WHERE ";
			$QryUpdatePlanet .= "`id` = '".$ActualPlanet['id']."';";
			doquery ($QryUpdatePlanet, 'planets');
			$DeletedQueues += 1;
		}
	}
	if ($DeletedQueues > 0) {
		$QuitMessage = $lang['adm_cleaned']." ". $DeletedQueues;
	} else {
		$QuitMessage = $lang['adm_done'];
	}

	AdminMessage ($QuitMessage, $lang['adm_cleaner_title']);
} else {
		message( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
}

/******************************************************************************************
**                                    Revision Notes                                     **
**  @ Official OasisRage 2.0 release - May 2009 - darkOasis                              **
**  @ (please note any changes you make to the source code)                              **
**  @                                                                                    **
**                                                                                       **
******************************************************************************************/

?>