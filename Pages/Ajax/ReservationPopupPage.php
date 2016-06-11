<?php
/**
Copyright 2011-2015 Nick Korbel

This file is part of Booked Scheduler.

Booked Scheduler is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Booked Scheduler is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Booked Scheduler.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once(ROOT_DIR . 'Pages/SecurePage.php');
require_once(ROOT_DIR . 'Presenters/SchedulePresenter.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Reservation/namespace.php');


interface IReservationPopupPage
{
	/**
	 * @return string
	 */
	function GetReservationId();

	/**
	 * @param $first string
	 * @param $last string
	 */
	function SetName($first, $last);

	/**
	 * @param $resources ScheduleResource[]
	 */
	function SetResources($resources);

	/**
	 * @param $users ReservationUser[]
	 */
	function SetParticipants($users);

	/**
	 * @param $summary string
	 */
	function SetSummary($summary);

	/**
	 * @param $title string
	 */
	function SetTitle($title);

	/**
	 * @param $startDate Date
	 * @param $endDate Date
	 */
	function SetDates($startDate, $endDate);

	/**
	 * @abstract
	 * @param $accessories ReservationAccessory[]
	 * @return mixed
	 */
	public function SetAccessories($accessories);

	/**
	 * @abstract
	 * @param bool $hideReservationDetails
	 * @return void
	 */
	public function SetHideDetails($hideReservationDetails);

	/**
	 * @abstract
	 * @param bool $hideUserInfo
	 * @return void
	 */
	public function SetHideUser($hideUserInfo);

	/**
	 * @param Attribute[] $attributes
	 */
	public function BindAttributes($attributes);
}

//Class: Gives format to the popup
class PopupFormatter
{
	private $values = array();

	public function Add($name, $value)
	{
		$this->values[$name] = $value;
	}

	private function GetValue($name)
	{
		if (isset($this->values[$name]))
		{
			return $this->values[$name];
		}

		return '';
	}

	//Displays the popup
	public function Display()
	{
		$label = Configuration::Instance()->GetSectionKey(ConfigSection::RESERVATION_LABELS, ConfigKeys::RESERVATION_LABELS_RESERVATION_POPUP);

		if (empty($label))
		{
			//MyCode (8/5/2016)
			//$label = "{name} {dates} {title} {resources} {participants} {accessories} {description} {attributes}";
			$label = "{resources} {name} {dates} {title}";
		}
		$label = str_replace('{name}', $this->GetValue('name'), $label);
		$label = str_replace('{dates}', $this->GetValue('dates'), $label);
		$label = str_replace('{title}', $this->GetValue('title'), $label);
		$label = str_replace('{resources}', $this->GetValue('resources'), $label);
		$label = str_replace('{participants}', $this->GetValue('participants'), $label);
		$label = str_replace('{accessories}', $this->GetValue('accessories'), $label);
		$label = str_replace('{description}', $this->GetValue('description'), $label);

		if (strpos($label, '{attributes}') !== false)
		{
			$label = str_replace('{attributes}', $this->GetValue('attributes'), $label);
		}
		else
		{
			$matches = array();
			preg_match_all('/\{(att\d+?)\}/', $label, $matches);

			$matches = $matches[0];
			if (count($matches) > 0)
			{
				for ($m = 0; $m < count($matches); $m++)
				{
					$id = filter_var($matches[$m], FILTER_SANITIZE_NUMBER_INT);
					$value = $this->GetValue('att' . $id);
					$label = str_replace($matches[$m], $value, $label);
				}
			}
		}
		return $label;
	}
}

//Class: Supports the reservations popups
class ReservationPopupPage extends Page implements IReservationPopupPage
{
	/**
	 * @var ReservationPopupPresenter
	 */
	private $_presenter;

	//Construct
	public function __construct()
	{
		parent::__construct();

		$this->_presenter = new ReservationPopupPresenter($this,
														  new ReservationViewRepository(),
														  new ReservationAuthorization(PluginManager::Instance()->LoadAuthorization()),
														  new AttributeService(new AttributeRepository()));
	}

	//Checks authentication
	public function IsAuthenticated()
	{
		return Configuration::Instance()->GetSectionKey(ConfigSection::PRIVACY, ConfigKeys::PRIVACY_VIEW_RESERVATIONS,
														new BooleanConverter()) ||
				parent::IsAuthenticated();
	}

	//Process page load
	public function PageLoad()
	{
		$formatter = new PopupFormatter();
		$this->Set('formatter', $formatter);

		if (!$this->IsAuthenticated())
		{
			$this->Set('authorized', false);
		}
		else
		{
			$this->Set('authorized', true);
			$this->_presenter->PageLoad();
		}

		$this->Set('ReservationId', $this->GetReservationId());

		$this->Display('Ajax/respopup.tpl');
	}

	/**
	 * @return string
	 */
	//Gets reservation identifier
	function GetReservationId()
	{
		return $this->GetQuerystring('id');
	}

	//Sets name
	function SetName($first, $last)
	{
		$this->Set('fullName', new FullName($first, $last));
	}

	//Gets resources
	function SetResources($resources)
	{
		$this->Set('resources', $resources);
	}

	//Unused
	function SetParticipants($users)
	{
		$this->Set('participants', $users);
	}

	//Sets description
	function SetSummary($summary)
	{
		$this->Set('summary', $summary);
	}

	//Sets title
	function SetTitle($title)
	{
		$this->Set('title', $title);
	}

	//Sets start and end dates
	function SetDates($startDate, $endDate)
	{
		$this->Set('startDate', $startDate);
		$this->Set('endDate', $endDate);
	}

	/**
	 * @param $accessories ReservationAccessory[]
	 * @return mixed
	 */
	//Sets accesories
	public function SetAccessories($accessories)
	{
		$this->Set('accessories', $accessories);
	}

	/**
	 * @param bool $hideReservationDetails
	 * @return void
	 */
	//Unused
	public function SetHideDetails($hideReservationDetails)
	{
		$this->Set('hideDetails', $hideReservationDetails);
	}

	/**
	 * @param bool $hideUserInfo
	 * @return void
	 */
	//Unused
	public function SetHideUser($hideUserInfo)
	{
		$this->Set('hideUserInfo', $hideUserInfo);
	}

	/**
	 * @param Attribute[] $attributes
	 */
	//Set attributes
	public function BindAttributes($attributes)
	{
		$this->Set('attributes', $attributes);
	}
}

//Class: Presenter of reservation popup page
class ReservationPopupPresenter
{
	/**
	 * @var IReservationPopupPage
	 */
	private $_page;

	/*
	 * @var IReservationViewRepository
	 */
	private $_reservationRepository;

	/**
	 * @var IReservationAuthorization
	 */
	private $_reservationAuthorization;

	/**
	 * @var IAttributeService
	 */
	private $attributeService;

	//Construct
	public function __construct(IReservationPopupPage $page,
								IReservationViewRepository $reservationRepository,
								IReservationAuthorization $reservationAuthorization,
								IAttributeService $attributeService)
	{
		$this->_page = $page;
		$this->_reservationRepository = $reservationRepository;
		$this->_reservationAuthorization = $reservationAuthorization;
		$this->attributeService = $attributeService;
	}

	//Process page load
	public function PageLoad()
	{
		$hideUserInfo = Configuration::Instance()->GetSectionKey(ConfigSection::PRIVACY,
																 ConfigKeys::PRIVACY_HIDE_USER_DETAILS,
																 new BooleanConverter());

		$userSession = ServiceLocator::GetServer()->GetUserSession();
		$tz = $userSession->Timezone;

		$reservation = $this->_reservationRepository->GetReservationForEditing($this->_page->GetReservationId());

		if (!$reservation->IsDisplayable())
		{
			return;
		}

		$hideReservationDetails = ReservationDetailsFilter::HideReservationDetails($reservation->StartDate, $reservation->EndDate);

		if ($hideReservationDetails || $hideUserInfo)
		{
			$canViewDetails = $this->_reservationAuthorization->CanViewDetails($reservation, ServiceLocator::GetServer()->GetUserSession());

			$hideReservationDetails = !$canViewDetails && $hideReservationDetails;
			$hideUserInfo = !$canViewDetails && $hideUserInfo;
		}
		$this->_page->SetHideDetails($hideReservationDetails);
		$this->_page->SetHideUser($hideUserInfo);

		$startDate = $reservation->StartDate->ToTimezone($tz);
		$endDate = $reservation->EndDate->ToTimezone($tz);

		$this->_page->SetName($reservation->OwnerFirstName, $reservation->OwnerLastName);
		$this->_page->SetResources($reservation->Resources);
		$this->_page->SetParticipants($reservation->Participants);
		$this->_page->SetSummary($reservation->Description);
		$this->_page->SetTitle($reservation->Title);
		$this->_page->SetAccessories($reservation->Accessories);

		$this->_page->SetDates($startDate, $endDate);

		$attributeValues = $this->attributeService->GetReservationAttributes($userSession, $reservation);

		$this->_page->BindAttributes($attributeValues);
	}
}