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
require_once(ROOT_DIR . 'Pages/Ajax/IReservationSaveResultsView.php');
require_once(ROOT_DIR . 'Presenters/Reservation/ReservationPresenterFactory.php');

interface IReservationSavePage extends IReservationSaveResultsView, IRepeatOptionsComposite
{
	/**
	 * @return int
	 */
	public function GetUserId();

	/**
	 * @return int
	 */
	public function GetResourceId();

	/**
	 * @return string
	 */
	public function GetTitle();

	/**
	 * @return string
	 */
	public function GetDescription();

	/**
	 * @return string
	 */
	public function GetStartDate();

	/**
	 * @return string
	 */
	public function GetEndDate();

	/**
	 * @return string
	 */
	public function GetStartTime();

	/**
	 * @return string
	 */
	public function GetEndTime();

	/**
	 * @return int[]
	 */
	public function GetResources();

	/**
	 * @return int[]
	 */
	public function GetParticipants();

	/**
	 * @return int[]
	 */
	public function GetInvitees();

	/**
	 * @param string $referenceNumber
	 */
	public function SetReferenceNumber($referenceNumber);

	/**
	 * @param bool $requiresApproval
	 */
	public function SetRequiresApproval($requiresApproval);

	/**
	 * @return AccessoryFormElement[]|array
	 */
	public function GetAccessories();

	/**
	 * @return AttributeFormElement[]|array
	 */
	public function GetAttributes();

	/**
	 * @return UploadedFile[]
	 */
	public function GetAttachments();

	/**
	 * @return bool
	 */
	public function HasStartReminder();

	/**
	 * @return string
	 */
	public function GetStartReminderValue();

	/**
	 * @return string
	 */
	public function GetStartReminderInterval();

	/**
	 * @return bool
	 */
	public function HasEndReminder();

	/**
	 * @return string
	 */
	public function GetEndReminderValue();

	/**
	 * @return string
	 */
	public function GetEndReminderInterval();

	/**
	 * @return bool
	 */
	public function GetAllowParticipation();
}

//Class: Supports reservation creation controller
class ReservationSavePage extends SecurePage implements IReservationSavePage
{
	/**
	 * @var ReservationSavePresenter
	 */
	private $_presenter;

	/**
	 * @var bool
	 */
	private $_reservationSavedSuccessfully = false;

	//Construct
	public function __construct()
	{
		parent::__construct();

		$factory = new ReservationPresenterFactory();
		$this->_presenter = $factory->Create($this, ServiceLocator::GetServer()->GetUserSession());
	}

	//Process page load
	public function PageLoad()
	{
		try
		{
			$this->EnforceCSRFCheck();
			$reservation = $this->_presenter->BuildReservation();
			$this->_presenter->HandleReservation($reservation);

			if ($this->_reservationSavedSuccessfully)
			{
				$this->Set('Resources', $reservation->AllResources());
				$this->Set('Instances', $reservation->Instances());
				$this->Set('Timezone', ServiceLocator::GetServer()->GetUserSession()->Timezone);
				
				//MyCode (29/3/2016)
				//Returns directly without sending any message.	
				echo "<script type=\"text/javascript\">sessionStorage.setItem('popup_status', 'update');</script>";
				$this->Display('Ajax/reservation/save_successful.tpl');
			}
			else
			{
				$this->Display('Ajax/reservation/save_failed.tpl');
			}
		} catch (Exception $ex)
		{
			Log::Error('ReservationSavePage - Critical error saving reservation: %s', $ex);
			$this->Display('Ajax/reservation/reservation_error.tpl');
		}
	}

	//Sends success message
	public function SetSaveSuccessfulMessage($succeeded)
	{
		$this->_reservationSavedSuccessfully = $succeeded;
	}

	//Sets reference number
	public function SetReferenceNumber($referenceNumber)
	{
		$this->Set('ReferenceNumber', $referenceNumber);
	}

	//Sets approval requirement
	public function SetRequiresApproval($requiresApproval)
	{
		$this->Set('RequiresApproval', $requiresApproval);
	}

	//Sends error messages
	public function SetErrors($errors)
	{
		$this->Set('Errors', $errors);
	}

	public function SetWarnings($warnings)
	{
		// set warnings variable
	}

	//Gets action
	public function GetReservationAction()
	{
		return $this->GetForm(FormKeys::RESERVATION_ACTION);
	}

	//Gets reference number
	public function GetReferenceNumber()
	{
		return $this->GetForm(FormKeys::REFERENCE_NUMBER);
	}

	//Gets user identifier
	public function GetUserId()
	{
		return $this->GetForm(FormKeys::USER_ID);
	}

	//Gets resource identifier
	public function GetResourceId()
	{
		return $this->GetForm(FormKeys::RESOURCE_ID);
	}

	//Gets title
	public function GetTitle()
	{
		return $this->GetForm(FormKeys::RESERVATION_TITLE);
	}

	//Gets description
	public function GetDescription()
	{
		return $this->GetForm(FormKeys::DESCRIPTION);
	}

	//Gets start date
	public function GetStartDate()
	{
		return $this->GetForm(FormKeys::BEGIN_DATE);
	}

	//Gets end date
	public function GetEndDate()
	{
		return $this->GetForm(FormKeys::END_DATE);
	}

	//Gets the start time
	public function GetStartTime()
	{
		return $this->GetForm(FormKeys::BEGIN_PERIOD);
	}

	//Gets the end time
	public function GetEndTime()
	{
		return $this->GetForm(FormKeys::END_PERIOD);
	}

	//Gets the resource
	public function GetResources()
	{
		$resources = $this->GetForm(FormKeys::ADDITIONAL_RESOURCES);
		if (is_null($resources))
		{
			return array();
		}

		if (!is_array($resources))
		{
			return array($resources);
		}

		return $resources;
	}

	//Gets recurrence
	public function GetRepeatOptions()
	{
		return $this->_presenter->GetRepeatOptions();
	}

	//Gets recurrence type
	public function GetRepeatType()
	{
		return $this->GetForm(FormKeys::REPEAT_OPTIONS);
	}

	//Gets recurrence interval
	public function GetRepeatInterval()
	{
		return $this->GetForm(FormKeys::REPEAT_EVERY);
	}

	//Gets recurrence days
	public function GetRepeatWeekdays()
	{
		$days = array();

		$sun = $this->GetForm(FormKeys::REPEAT_SUNDAY);
		if (!empty($sun))
		{
			$days[] = 0;
		}

		$mon = $this->GetForm(FormKeys::REPEAT_MONDAY);
		if (!empty($mon))
		{
			$days[] = 1;
		}

		$tue = $this->GetForm(FormKeys::REPEAT_TUESDAY);
		if (!empty($tue))
		{
			$days[] = 2;
		}

		$wed = $this->GetForm(FormKeys::REPEAT_WEDNESDAY);
		if (!empty($wed))
		{
			$days[] = 3;
		}

		$thu = $this->GetForm(FormKeys::REPEAT_THURSDAY);
		if (!empty($thu))
		{
			$days[] = 4;
		}

		$fri = $this->GetForm(FormKeys::REPEAT_FRIDAY);
		if (!empty($fri))
		{
			$days[] = 5;
		}

		$sat = $this->GetForm(FormKeys::REPEAT_SATURDAY);
		if (!empty($sat))
		{
			$days[] = 6;
		}

		return $days;
	}

	//Gets monthly recurrence
	public function GetRepeatMonthlyType()
	{
		return $this->GetForm(FormKeys::REPEAT_MONTHLY_TYPE);
	}

	//Gets end of the recurrence
	public function GetRepeatTerminationDate()
	{
		return $this->GetForm(FormKeys::END_REPEAT_DATE);
	}

	//Gets the serie
	public function GetSeriesUpdateScope()
	{
		return $this->GetForm(FormKeys::SERIES_UPDATE_SCOPE);
	}

	/**
	 * @return int[]
	 */
	//Unused
	public function GetParticipants()
	{
		$participants = $this->GetForm(FormKeys::PARTICIPANT_LIST);
		if (is_array($participants))
		{
			return $participants;
		}

		return array();
	}

	/**
	 * @return int[]
	 */
	//Unused
	public function GetInvitees()
	{
		$invitees = $this->GetForm(FormKeys::INVITATION_LIST);
		if (is_array($invitees))
		{
			return $invitees;
		}

		return array();
	}

	/**
	 * @return AccessoryFormElement[]
	 */
	//Unused
	public function GetAccessories()
	{
		$accessories = $this->GetForm(FormKeys::ACCESSORY_LIST);
		if (is_array($accessories))
		{
			$af = array();

			foreach ($accessories as $a)
			{
				$af[] = new AccessoryFormElement($a);
			}
			return $af;
		}

		return array();
	}

	/**
	 * @return AttributeFormElement[]|array
	 */
	//Unused
	public function GetAttributes()
	{
		return AttributeFormParser::GetAttributes($this->GetForm(FormKeys::ATTRIBUTE_PREFIX));
	}

	/**
	 * @return UploadedFile[]
	 */
	//Unused
	public function GetAttachments()
	{
		if ($this->AttachmentsEnabled())
		{
			return $this->server->GetFiles(FormKeys::RESERVATION_FILE);
		}
		return array();
	}

	//Unused
	private function AttachmentsEnabled()
	{
		return Configuration::Instance()->GetSectionKey(ConfigSection::UPLOADS,
														ConfigKeys::UPLOAD_ENABLE_RESERVATION_ATTACHMENTS,
														new BooleanConverter());
	}

	/**
	 * @return bool
	 */
	//Unused
	public function HasStartReminder()
	{
		$val = $this->server->GetForm(FormKeys::START_REMINDER_ENABLED);
		return !empty($val);
	}

	/**
	 * @return string
	 */
	//Unused
	public function GetStartReminderValue()
	{
		return $this->server->GetForm(FormKeys::START_REMINDER_TIME);
	}

	/**
	 * @return string
	 */
	//Unused
	public function GetStartReminderInterval()
	{
		return $this->server->GetForm(FormKeys::START_REMINDER_INTERVAL);
	}

	/**
	 * @return bool
	 */
	//Unused
	public function HasEndReminder()
	{
		$val = $this->server->GetForm(FormKeys::END_REMINDER_ENABLED);
		return !empty($val);
	}

	/**
	 * @return string
	 */
	//Unused
	public function GetEndReminderValue()
	{
		return $this->server->GetForm(FormKeys::END_REMINDER_TIME);
	}

	/**
	 * @return string
	 */
	//Unused
	public function GetEndReminderInterval()
	{
		return $this->server->GetForm(FormKeys::END_REMINDER_INTERVAL);
	}

	/**
	 * @return bool
	 */
	//Unused
	public function GetAllowParticipation()
	{
		$val = $this->server->GetForm(FormKeys::ALLOW_PARTICIPATION);
		return !empty($val);
	}
}

//Unused
class AccessoryFormElement
{
	public $Id;
	public $Quantity;

	//Construct
	public function __construct($formValue)
	{
		$idAndQuantity = $formValue;
		$y = explode('-', $idAndQuantity);
		$params = explode(',', $y[1]);
		$id = explode('=', $params[0]);
		$quantity = explode('=', $params[1]);
		$name = explode('=', $params[2]);

		$this->Id = $id[1];
		$this->Quantity = $quantity[1];
		$this->Name = urldecode($name[1]);
	}

	//Creates
	public static function Create($id, $quantity)
	{
		$element = new AccessoryFormElement("accessory-id=$id,quantity=$quantity,name=");
		return $element;
	}
}