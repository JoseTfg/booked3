<?php

	//Gets selected resource array
	function getResourceArrayId(){
		$selectedResourceArrayId = null;
		if (isset($_GET['rid']))
			{
				$selectedResourceArrayId = explode(",", $_GET['rid']);
				
		}	
		return $selectedResourceArrayId;
	}
	
	//Sets the data for API
	function APIconnection($presenter){
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		if ($username == ""){
			$username = 'blank';
			$password = 'blank';
		}
		else{
			//no-op
		}
		$presenter->page->Set('username', $username);
		$presenter->page->Set('password', $password);
		return;
	}
	
	//Set calendar boundaries
	function calendarBoundaries($presenter, $userSession){		
		$existingSettings = $presenter->configSettings->GetSettings($presenter->configFilePath);		
		$minTimeNew = $_POST["minTime"];
		$maxTimeNew = $_POST["maxTime"];
		$changedSetting = '';		
	
		if ($minTimeNew != "" && $maxTimeNew != ""){		
			$newSettings = array();
			$newSettings[$userSession->FirstName."_".$userSession->LastName.'#minTime'] = $minTimeNew;
			$newSettings[$userSession->FirstName."_".$userSession->LastName.'#maxTime'] = $maxTimeNew;			
			$mergedSettings = array_merge($existingSettings, $newSettings);
			$presenter->configSettings->WriteSettings($presenter->configFilePath, $mergedSettings);
			$changedSetting = $minTimeNew."#".$maxTimeNew;
			}
		return $changedSetting;
	}
	
	//Gets blackouts
	function blackoutsList($presenter){
		$filter = new BlackoutFilter('', '', '', '');
		
		$session = ServiceLocator::GetServer()->GetUserSession();
		
		$blackouts = $presenter->manageBlackoutsService->LoadFiltered(1,50,$filter,$session);
		$presenter->page->Set('blackouts', $blackouts->Results());
	}
	
	//Exports reservations file
	function googleCalendar($presenter,$userSession,$calendar_export){
		$filename = $userSession->FirstName.''.$userSession->LastName.''.$userSession->UserId;
		$presenter->page->Set('filename', $filename);
		$myfile = fopen("uploads/calendars/".$filename.".ics", "w") or die("Unable to open file!");
		$HeaderGC = 'BEGIN:VCALENDAR'.'#VERSION:2.0'.'#PRODID:Booked Scheduler';
		$toWrite = explode("#",$HeaderGC);
		for ($i = 0; $i <= count($toWrite); $i++) {
				fwrite($myfile, $toWrite[$i].PHP_EOL);
			}	
		$k = 0;
		$blank = '';
		foreach ($calendar_export->Reservations() as $exp){
			$start = new DateTime($exp->StartDate);
			$end = new DateTime($exp->EndDate);
			
			$BodyGC[$k] = 	'BEGIN:VEVENT'.'#CLASS:PUBLIC'.'#DESCRIPTION:'.$exp->Title.'#DTSTART;TZID=Europe/Copenhagen:'
							.$start->format('Ymd').'T'.$start->format('His').'#DTEND;TZID=Europe/Copenhagen:'
							.$end->format('Ymd').'T'.$end->format('His').'#LOCATION:'.$blank.'#SUMMARY;LANGUAGE=en-us:'.$exp->ResourceName
							.'#TRANSP:TRANSPARENT'.'#END:VEVENT';
			$toWrite = explode("#",$BodyGC[$k]);
			for ($i = 0; $i <= count($toWrite); $i++) {
				fwrite($myfile, $toWrite[$i].PHP_EOL);
			}
		}
		$FooterGC = 'END:VCALENDAR';
		fwrite($myfile, $FooterGC.PHP_EOL);			
		fclose($myfile);
		return;
	}
	
	//Sets the colros of resources
	function colors($presenter, $userSession){
		//MyCode 4/5/2016
		$colors = $_POST['colors'];
		$changedSetting = '';
		$existingSettings = $presenter->configSettings->GetSettings($presenter->configFilePath);
		//echo '<script type="text/javascript">alert("'.var_dump($existingSettings).'");</script>';
		if ($colors != ""){
			//echo '<script type="text/javascript">alert("'.$userSession->FirstName.''.$userSession->LastName.''.$userSession->UserId.'");</script>';
			$colors = explode("#",$colors);			
			$newSettings = array();
			$newSettings[$userSession->FirstName."_".$userSession->LastName."#color#".$colors[0]] = $colors[1];		
			$mergedSettings = array_merge($existingSettings, $newSettings);
			$presenter->configSettings->WriteSettings($presenter->configFilePath, $mergedSettings);
			$changedSetting = $colors[0]."#".$colors[1];
		}
		return $changedSetting;
	}
	
	//Sends config file settings
	function sendSettings($presenter, $userSession, $settingType, $changedSetting){
		$existingSettings = $presenter->configSettings->GetSettings($presenter->configFilePath);
		$settingsKeys = array_keys($existingSettings);		
		foreach ($settingsKeys as $setKey){
			if (strpos($setKey, $userSession->FirstName."_".$userSession->LastName."#color#") !== false){
				$rColor = explode("#",$setKey);
				$colorsToSend[$rColor[2]] = $existingSettings[$setKey];
			}
			if (strpos($setKey, $userSession->FirstName."_".$userSession->LastName."#minTime") !== false){
				$minTime = $existingSettings[$setKey];
			}
			if (strpos($setKey, $userSession->FirstName."_".$userSession->LastName."#maxTime") !== false){
				$maxTime = $existingSettings[$setKey];
			}				
		}
		
		if ($settingType != ""){
			if ($settingType == "color"){
				$changedSetting = explode("#",$changedSetting);
				$colorsToSend[$changedSetting[0]] = $changedSetting[1];
			}
			elseif ($settingType == "time"){
				$changedSetting = explode("#",$changedSetting);
				$minTime = $changedSetting[0];
				$maxTime = $changedSetting[1];
			}
		}
		
		$presenter->page->Set('colorsToSend', $colorsToSend);
		$presenter->page->Set('minTime', $minTime);
		$presenter->page->Set('maxTime', $maxTime);
		return;
	}
	
	//Builds calendars and binds reservations
	function buildCalendar($presenter, $calendar, $selectedScheduleId, $selectedResourceId, $selectedResourceArrayId, $reservations, $resources, $userSession, $timezone)	{
		//Reservations array
		$reservations_array = array();
		
		//Gets the calendar scope
		$isPersonal = $_GET["mycal"];
		
		if ($userSession->UserId == "1"){
			$isPersonal = "1";
		}
		
		//This code allows to build the calendar for either personal or global scope.
		if ($isPersonal != null){
			//Global Calendar
			$myCal = false;		
			
			//Building the calendar.
			if (is_array($selectedResourceArrayId) || is_object($selectedResourceArrayId)){
		foreach ($selectedResourceArrayId as $selectedResourceId){
		$reservations = $presenter->reservationRepository->GetReservationList($calendar->FirstDay(), $calendar->LastDay()->AddDays(1), null, null,
		$selectedScheduleId, $selectedResourceId);
		$calendar->AddReservations(CalendarReservation::FromScheduleReservationList(
									   $reservations,
									   $resources,
									   $userSession,
									   true));
									   
		//MyCode (28/3/2016)
		 //This allows multiple resource selection in the list view.
		 array_push($reservations_array,$reservations);
		}
		}
		else{
		$reservations = $presenter->reservationRepository->GetReservationList($calendar->FirstDay(), $calendar->LastDay()->AddDays(1),
		null, null,	$selectedScheduleId, 0);
		 $calendar->AddReservations(CalendarReservation::FromScheduleReservationList(
									   $reservations,
									   $resources,
									   $userSession,
									   true));
		}
		}
		else{
			//PersonalCalendar
			$myCal = true;
			
			//Building the calendar.
			if (is_array($selectedResourceArrayId) || is_object($selectedResourceArrayId)){
		foreach ($selectedResourceArrayId as $selectedResourceId){
		$reservations = $presenter->reservationRepository->GetReservationList($calendar->FirstDay(), $calendar->LastDay()->AddDays(1), $userSession->UserId,
		ReservationUserLevel::ALL, $selectedScheduleId, $selectedResourceId);
		$calendar->AddReservations(CalendarReservation::FromViewList($reservations, $timezone, $userSession, true));
		 
		 //MyCode (28/3/2016)
		 //This allows multiple resource selection in the list view.
		 array_push($reservations_array,$reservations);
		}
		}
		else{
		$reservations = $presenter->reservationRepository->GetReservationList($calendar->FirstDay(), $calendar->LastDay()->AddDays(1), $userSession->UserId,
		 ReservationUserLevel::ALL, $selectedScheduleId, 0);
		 $calendar->AddReservations(CalendarReservation::FromViewList($reservations, $timezone, $userSession, true));
		}		
		}

		//MyCode (28/3/2016)
		//This code sends the values to the page.
		$presenter->page->Set('reservations', $reservations);
		$presenter->page->Set('reservations2', $reservations_array);
		$presenter->page->Set('myCal', $myCal);	
		$presenter->page->Set('UserId', $userSession->UserId);

		return $calendar;
	}

?>