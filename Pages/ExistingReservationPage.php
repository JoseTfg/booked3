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

require_once(ROOT_DIR . 'Pages/ReservationPage.php');

interface IExistingReservationPage extends IReservationPage
{
	function GetReferenceNumber();

	/**
	 * @param $additionalResourceIds int[]
	 */
	function SetAdditionalResources($additionalResourceIds);

	/**
	 * @param $title string
	 */
	function SetTitle($title);

	/**
	 * @param $description string
	 */
	function SetDescription($description);

	/**
	 * @param $repeatType string
	 */
	function SetRepeatType($repeatType);

	/**
	 * @param $repeatInterval string
	 */
	function SetRepeatInterval($repeatInterval);

	/**
	 * @param $repeatMonthlyType string
	 */
	function SetRepeatMonthlyType($repeatMonthlyType);

	/**
	 * @param $repeatWeekdays int[]
	 */
	function SetRepeatWeekdays($repeatWeekdays);

	/**
	 * @param $referenceNumber string
	 */
	function SetReferenceNumber($referenceNumber);

	/**
	 * @param $reservationId int
	 */
	function SetReservationId($reservationId);

	/**
	 * @param $isRecurring bool
	 */
	function SetIsRecurring($isRecurring);

	/**
	 * @param $canBeEdited bool
	 */
	function SetIsEditable($canBeEdited);

	/**
	 * @abstract
	 * @param $canBeApproved bool
	 * @return void
	 */
	function SetIsApprovable($canBeApproved);

	/**
	 * @param $amIParticipating
	 */
	function SetCurrentUserParticipating($amIParticipating);

	/**
	 * @param $amIInvited
	 */
	function SetCurrentUserInvited($amIInvited);

	/**
	 * @param int $reminderValue
	 * @param ReservationReminderInterval $reminderInterval
	 */
	public function SetStartReminder($reminderValue, $reminderInterval);

	/**
	 * @param int $reminderValue
	 * @param ReservationReminderInterval $reminderInterval
	 */
	public function SetEndReminder($reminderValue, $reminderInterval);
}

//Class: Supports the existing reservation controller
class ExistingReservationPage extends ReservationPage implements IExistingReservationPage
{
	protected $IsEditable = false;
	protected $IsApprovable = false;

	//Construct
	public function __construct()
	{
		parent::__construct();
	}

	//Process page load
	public function PageLoad()
	{
		parent::PageLoad();
	}

	//Creates the presenter
	protected function GetPresenter()
	{
		$preconditionService = new EditReservationPreconditionService($this->permissionServiceFactory);
		$reservationViewRepository = new ReservationViewRepository();

		return new EditReservationPresenter($this,
											$this->initializationFactory,
											$preconditionService,
											$reservationViewRepository);
	}

	//Gets the page to show
	protected function GetTemplateName()
	{
		if ($this->IsApprovable)
		{
			return 'Reservation/approve.tpl';
		}
		if ($this->IsEditable)
		{
			return 'Reservation/edit.tpl';
		}
		return 'Reservation/view.tpl';
	}

	//Gets the action
	protected function GetReservationAction()
	{
		return ReservationAction::Update;
	}

	//Gets reference number
	public function GetReferenceNumber()
	{
		return $this->server->GetQuerystring(QueryStringKeys::REFERENCE_NUMBER);
	}

	//Sets additional resources
	public function SetAdditionalResources($additionalResourceIds)
	{
		$this->Set('AdditionalResourceIds', $additionalResourceIds);
	}

	//Sets title
	public function SetTitle($title)
	{
		$this->Set('ReservationTitle', $title);
	}

	//Sets description
	public function SetDescription($description)
	{
		$this->Set('Description', $description);
	}

	//Sets recurrence type
	public function SetRepeatType($repeatType)
	{
		$this->Set('RepeatType', $repeatType);
	}

	//Sets recurrence interval
	public function SetRepeatInterval($repeatInterval)
	{
		$this->Set('RepeatInterval', $repeatInterval);
	}

	//Sets monthly recurrence type
	public function SetRepeatMonthlyType($repeatMonthlyType)
	{
		$this->Set('RepeatMonthlyType', $repeatMonthlyType);
	}

	//Sets week recurrence
	public function SetRepeatWeekdays($repeatWeekdays)
	{
		$this->Set('RepeatWeekdays', $repeatWeekdays);
	}

	//Sets reference number
	public function SetReferenceNumber($referenceNumber)
	{
		$this->Set('ReferenceNumber', $referenceNumber);
	}

	//Sets reservation identifier
	public function SetReservationId($reservationId)
	{
		$this->Set('ReservationId', $reservationId);
	}

	//Marks reservation as recurrent
	public function SetIsRecurring($isRecurring)
	{
		$this->Set('IsRecurring', $isRecurring);
	}

	//Marks reservation as editable
	public function SetIsEditable($canBeEdited)
	{
		$this->IsEditable = $canBeEdited;
	}

	/**
	 * @param $amIParticipating
	 */
	//Unused
	public function SetCurrentUserParticipating($amIParticipating)
	{
		$this->Set('IAmParticipating', $amIParticipating);
	}

	/**
	 * @param $amIInvited
	 */
	//Unused
	public function SetCurrentUserInvited($amIInvited)
	{
		$this->Set('IAmInvited', $amIInvited);
	}

	/**
	 * @param $canBeApproved bool
	 * @return void
	 */
	//Marks the reservation as approvable
	public function SetIsApprovable($canBeApproved)
	{
		$this->IsApprovable = $canBeApproved;
	}

	/**
	 * @param int $reminderValue
	 * @param ReservationReminderInterval $reminderInterval
	 */
	//Sets start reminder
	public function SetStartReminder($reminderValue, $reminderInterval)
	{
		$this->Set('ReminderTimeStart', $reminderValue);
		$this->Set('ReminderIntervalStart', $reminderInterval);
	}

	/**
	 * @param int $reminderValue
	 * @param ReservationReminderInterval $reminderInterval
	 */
	//Sets end reminder
	public function SetEndReminder($reminderValue, $reminderInterval)
	{
		$this->Set('ReminderTimeEnd', $reminderValue);
		$this->Set('ReminderIntervalEnd', $reminderInterval);
	}
}

?>