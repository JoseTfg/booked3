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
		$firstDayNew = $_POST["firstDay"];
		$firstDayNew = "0";
		$weekendsNew = $_POST["weekends"];
		$format = $_POST["format"];
		$changedSetting = '';		
	
		if ($minTimeNew != "" && $maxTimeNew != ""){		
			$newSettings = array();			
			$newSettings[$userSession->UserId.'#Time'] = $minTimeNew."#".$maxTimeNew."#".$firstDayNew."#".$format."#".$weekendsNew;
			$mergedSettings = array_merge($existingSettings, $newSettings);
			$presenter->configSettings->WriteSettings($presenter->configFilePath, $mergedSettings);
			$changedSetting = $minTimeNew."#".$maxTimeNew."#".$firstDayNew."#".$format."#".$weekendsNew;
			}
		return $changedSetting;
	}
	
	//Gets blackouts
	function blackoutsList($presenter){
		$filter = new BlackoutFilter('', '', '', '');		
		$session = ServiceLocator::GetServer()->GetUserSession();		
		$blackouts = $presenter->manageBlackoutsService->LoadFiltered(1,200,$filter,$session);	
		$presenter->page->Set('blackouts', $blackouts->Results());
	}
	
	//Exports reservations file
	function googleCalendar($presenter,$userSession,$calendar_export){		
		$filename = crypt($filename,$userSession->UserId);
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
							.$end->format('Ymd').'T'.$end->format('His').'#LOCATION:'.$exp->location.'#SUMMARY;LANGUAGE=en-us:'.$exp->ResourceName
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
	
	//Sets the colours of resources
	function colors($presenter, $userSession){
		//MyCode 4/5/2016
		//$colors = $_POST['colors'];
		$colors = "";
		foreach($_POST as $key => $value){ 
		   if (strpos($key, "color") !== false){
				$colors = $colors."%".$value;
		   }
		}
		$changedSetting = '';
		$existingSettings = $presenter->configSettings->GetSettings($presenter->configFilePath);
		//echo '<script type="text/javascript">alert("'.var_dump($existingSettings).'");</script>';
		if ($colors != ""){
			//echo '<script type="text/javascript">alert("'.$userSession->FirstName.''.$userSession->LastName.''.$userSession->UserId.'");</script>';
			$colors = explode("%",$colors);
			$newSettings = array();			
			foreach ($colors as $color){
				if ($color != ""){
					$color = explode("#",$color);				
					$newSettings[$userSession->UserId."#color#".$color[0]] = $color[1];
					$changedSetting = $changedSetting."%".$color[0]."#".$color[1];
				}
			}				
			$mergedSettings = array_merge($existingSettings, $newSettings);
			$presenter->configSettings->WriteSettings($presenter->configFilePath, $mergedSettings);			
		}
		return $changedSetting;
	}
	
	//Sends config file settings
	function sendSettings($presenter, $userSession, $settingType, $changedSetting){
		$existingSettings = $presenter->configSettings->GetSettings($presenter->configFilePath);
		$settingsKeys = array_keys($existingSettings);		
		foreach ($settingsKeys as $setKey){
			if (strpos($setKey, $userSession->UserId."#color#") !== false){
				$rColor = explode("#",$setKey);
				$colorsToSend[$rColor[2]] = $existingSettings[$setKey];
			}
			if (strpos($setKey, $userSession->UserId."#Time") !== false){
				$Time = $existingSettings[$setKey];
				$Time = explode("#",$Time);
				$minTime = $Time[0];
				$maxTime = $Time[1];
				$presenter->page->SetFirstDay($Time[2]);
				$format = $Time[3];
				$weekends = $Time[4];				
			}			
		}
		
		if ($settingType != ""){
			if ($settingType == "color"){
				$changedSetting = explode("%",$changedSetting);
				foreach ($changedSetting as $Setting){
					$Setting = explode("#",$Setting);
					$colorsToSend[$Setting[0]] = $Setting[1];
				}
			}
			elseif ($settingType == "time"){
				$changedSetting = explode("#",$changedSetting);
				$minTime = $changedSetting[0];
				$maxTime = $changedSetting[1];
				$presenter->page->SetFirstDay($changedSetting[2]);
				$format = $changedSetting[3];
				$weekends = $changedSetting[4];
			}
		}
		
		$presenter->page->Set('colorsToSend', $colorsToSend);
		$presenter->page->Set('minTime', $minTime);
		$presenter->page->Set('maxTime', $maxTime);
		$presenter->page->Set('weekends', $weekends);
		$presenter->page->Set('format', $format);
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
		$presenter->page->Set('isAdmin', $userSession->IsAdmin);
		return $calendar;
	}

?>