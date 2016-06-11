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

interface IReservationDeletePage extends IReservationSaveResultsView
{
	/**
	 * @return string
	 */
	public function GetReferenceNumber();

	/**
	 * @return SeriesUpdateScope|string
	 */
	public function GetSeriesUpdateScope();
}

//Class: Supports the delete reservation controller
class ReservationDeletePage extends SecurePage implements IReservationDeletePage
{
	/**
	 * @var ReservationDeletePresenter
	 */
	protected $presenter;

	/**
	 * @var bool
	 */
	protected $reservationSavedSuccessfully = false;

	public function __construct()
	{
		parent::__construct();

		$factory = new ReservationPresenterFactory();
		$this->presenter = $factory->Delete($this, ServiceLocator::GetServer()->GetUserSession());
	}

	//Process page load
	public function PageLoad()
	{
		try
		{
			$this->EnforceCSRFCheck();
			$reservation = $this->presenter->BuildReservation();
			$this->presenter->HandleReservation($reservation);

			if ($this->reservationSavedSuccessfully)
			{
				//MyCode  (29/3/2016)
				//Returns directly without sending any message.				
				//$this->Display('Ajax/reservation/delete_successful.tpl');				
				//$returnPage = $_SESSION['returnPage'];
				echo "<script type=\"text/javascript\">sessionStorage.setItem('popup_status', 'update');</script>";  
			}
			else
			{
				$this->Display('Ajax/reservation/delete_failed.tpl');
			}
		} catch (Exception $ex)
		{
			Log::Error('ReservationDeletePage - Critical error saving reservation: %s', $ex);
			$this->Display('Ajax/reservation/reservation_error.tpl');
		}
	}

	//Sends success message
	public function SetSaveSuccessfulMessage($succeeded)
	{
		$this->reservationSavedSuccessfully = $succeeded;
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

	//Gets reference number
	public function GetReferenceNumber()
	{
		return $this->GetForm(FormKeys::REFERENCE_NUMBER);
	}

	public function GetSeriesUpdateScope()
	{
		return $this->GetForm(FormKeys::SERIES_UPDATE_SCOPE);
	}
}

//Class: Supports tje JSON requests and responses
class ReservationDeleteJsonPage extends ReservationDeletePage implements IReservationDeletePage
{
	public function __construct()
	{
		parent::__construct();
	}

	//Process page load
	public function PageLoad()
	{
		$reservation = $this->presenter->BuildReservation();
		$this->presenter->HandleReservation($reservation);
	}

	/**
	 * @param bool $succeeded
	 */
	//Sends success message
	public function SetSaveSuccessfulMessage($succeeded)
	{
		if ($succeeded)
		{
			$this->SetJson(array('deleted' => (string)$succeeded));
		}
	}

	//Sends error messages
	public function SetErrors($errors)
	{
		if (!empty($errors))
		{
			$this->SetJson(array('deleted' => (string)false), $errors);
		}
	}

	public function SetWarnings($warnings)
	{
		// nothing to do
	}
}