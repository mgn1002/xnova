<?php

/******************************************
**            Oasis Rage 2.0             **
**             by darkOasis              **
**                                       **
**  special thanks to the developers of  **
**    XNova, Ugamela and RageOnline      **
**                                       **
** SetNextQueueElementOnTop.php          **
******************************************/

function SetNextQueueElementOnTop ( &$CurrentPlanet, $CurrentUser ) {
	global $lang, $resource;

	if ($CurrentPlanet['b_building'] == 0) {
		$CurrentQueue  = $CurrentPlanet['b_building_id'];
		if ($CurrentQueue != 0) {
			$QueueArray = explode ( ";", $CurrentQueue );
			$Loop       = true;
			while ($Loop == true) {
				$ListIDArray         = explode ( ",", $QueueArray[0] );
				$Element             = $ListIDArray[0];
				$Level               = $ListIDArray[1];
				$BuildTime           = $ListIDArray[2];
				$BuildEndTime        = $ListIDArray[3];
				$BuildMode           = $ListIDArray[4]; 
				$HaveNoMoreLevel     = false;

				if ($BuildMode == 'destroy') {
					$ForDestroy = true;
				} else {
					$ForDestroy = false;
				}
				$HaveRessources = IsElementBuyable ($CurrentUser, $CurrentPlanet, $Element, true, $ForDestroy);
				if ($ForDestroy) {
					if ($CurrentPlanet[$resource[$Element]] == 0) {
						$HaveRessources  = false;
						$HaveNoMoreLevel = true;
					}
				}
				if ( $HaveRessources == true ) {
					$Needed                        = GetBuildingPrice ($CurrentUser, $CurrentPlanet, $Element, true, $ForDestroy);
					$CurrentPlanet['metal']       -= $Needed['metal'];
					$CurrentPlanet['crystal']     -= $Needed['crystal'];
					$CurrentPlanet['deuterium']   -= $Needed['deuterium'];
					$CurrentPlanet['tachyon']     -= $Needed['tachyon'];
					$CurrentTime                   = time();
					$BuildEndTime                  = $BuildEndTime;
					$NewQueue                      = implode ( ";", $QueueArray );
					if ($NewQueue == "") {
						$NewQueue                      = '0';
					}
					$Loop                          = false;
				} else {
					$ElementName = $lang['tech'][$Element];
					if ($HaveNoMoreLevel == true) {
						$Message     = sprintf ($lang['sys_nomore_level'], $ElementName );
					} else {
						$Needed      = GetBuildingPrice ($CurrentUser, $CurrentPlanet, $Element, true, $ForDestroy);
						$Message     = sprintf ($lang['sys_notenough_money'], $ElementName,
												pretty_number ($CurrentPlanet['metal']), $lang['Metal'],
												pretty_number ($CurrentPlanet['crystal']), $lang['Crystal'],
												pretty_number ($CurrentPlanet['deuterium']), $lang['Deuterium'],
												pretty_number ($CurrentPlanet['tachyon']), $lang['Tachyon'],
												pretty_number ($Needed['metal']), $lang['Metal'],
												pretty_number ($Needed['crystal']), $lang['Crystal'],
												pretty_number ($Needed['deuterium']), $lang['Deuterium'],
												pretty_number ($Needed['tachyon']), $lang['Tachyon']);
					}

					SendSimpleMessage ( $CurrentUser['id'], '', '', 99, $lang['sys_buildlist'], $lang['sys_buildlist_fail'], $Message);

					array_shift( $QueueArray );
					$ActualCount         = count ( $QueueArray );
					if ( $ActualCount == 0 ) {
						$BuildEndTime  = '0';
						$NewQueue      = '0';
						$Loop          = false;
					}
				}
			} 
		} else {
			$BuildEndTime  = '0';
			$NewQueue      = '0';
		}

		$CurrentPlanet['b_building']    = $BuildEndTime;
		$CurrentPlanet['b_building_id'] = $NewQueue;

		$QryUpdatePlanet  = "UPDATE {{table}} SET ";
		$QryUpdatePlanet .= "`metal` = '".         $CurrentPlanet['metal']         ."' , ";
		$QryUpdatePlanet .= "`crystal` = '".       $CurrentPlanet['crystal']       ."' , ";
		$QryUpdatePlanet .= "`deuterium` = '".     $CurrentPlanet['deuterium']     ."' , ";
		$QryUpdatePlanet .= "`tachyon` = '".       $CurrentPlanet['tachyon']       ."' , ";
		$QryUpdatePlanet .= "`b_building` = '".    $CurrentPlanet['b_building']    ."' , ";
		$QryUpdatePlanet .= "`b_building_id` = '". $CurrentPlanet['b_building_id'] ."' ";
		$QryUpdatePlanet .= "WHERE ";
		$QryUpdatePlanet .= "`id` = '" .           $CurrentPlanet['id']            . "';";
		doquery( $QryUpdatePlanet, 'planets');

	}

	return;
}

/******************************************************************************************
**                                    Revision Notes                                     **
**  @ Official OasisRage 2.0 release - May 2009 - darkOasis                              **
**  @ (please note any changes you make to the source code)                              **
**  @                                                                                    **
**                                                                                       **
******************************************************************************************/ 

?>