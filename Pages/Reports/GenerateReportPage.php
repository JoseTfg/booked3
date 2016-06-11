<?php
/**
Copyright 2012-2015 Nick Korbel

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
require_once(ROOT_DIR . 'Pages/Reports/IDisplayableReportPage.php');
require_once(ROOT_DIR . 'Pages/Ajax/AutoCompletePage.php');
require_once(ROOT_DIR . 'Presenters/Reports/GenerateReportPresenter.php');

interface IGenerateReportPage extends IDisplayableReportPage, IActionPage
{
	/**
	 * @abstract
	 * @return string|Report_Usage
	 */
	public function GetUsage();

	/**
	 * @abstract
	 * @return string|Report_ResultSelection
	 */
	public function GetResultSelection();

	/**
	 * @abstract
	 * @return string|Report_GroupBy
	 */
	public function GetGroupBy();

	/**
	 * @abstract
	 * @return string|Report_Range
	 */
	public function GetRange();

	/**
	 * @abstract
	 * @return string
	 */
	public function GetStart();

	/**
	 * @abstract
	 * @return string
	 */
	public function GetEnd();

	/**
	 * @abstract
	 * @return int
	 */
	public function GetResourceId();

	/**
	 * @abstract
	 * @return int
	 */
	public function GetAccessoryId();

	/**
	 * @abstract
	 * @return int
	 */
	public function GetScheduleId();

	/**
	 * @abstract
	 * @return int
	 */
	public function GetUserId();

	/**
	 * @return int
	 */
	public function GetParticipantId();

	/**
	 * @abstract
	 * @return int
	 */
	public function GetGroupId();

	/**
	 * @abstract
	 * @return string
	 */
	public function GetReportName();

	/**
	 * @abstract
	 * @param array|BookableResource[] $resources
	 */
	public function BindResources($resources);

	/**
	 * @abstract
	 * @param array|AccessoryDto[] $accessories
	 */
	public function BindAccessories($accessories);

	/**
	 * @abstract
	 * @param array|Schedule[] $schedules
	 */
	public function BindSchedules($schedules);

	/**
	 * @abstract
	 * @param array|GroupItemView[] $groups
	 */
	public function BindGroups($groups);
}

//Class: Allows reports generaton
class GenerateReportPage extends ActionPage implements IGenerateReportPage
{
	/**
	 * @var GenerateReportPresenter
	 */
	private $presenter;

	//Construct
	public function __construct()
	{
		parent::__construct('Reports', 1);
		$this->presenter = new GenerateReportPresenter(
			$this,
			ServiceLocator::GetServer()->GetUserSession(),
			new ReportingService(new ReportingRepository()),
			new ResourceRepository(),
			new ScheduleRepository(),
			new GroupRepository());
	}

	/**
	 * @return void
	 */
	//Process an action
	public function ProcessAction()
	{
		$this->presenter->ProcessAction();
	}

	/**
	 * @param $dataRequest string
	 * @return void
	 */
	public function ProcessDataRequest($dataRequest)
	{
		// no-op
	}

	/**
	 * @return void
	 */
	//Loads Smarty template
	public function ProcessPageLoad()
	{
		$this->presenter->PageLoad();
		$this->Display('Reports/generate-report.tpl');
	}

	/**
	 * @return string|Report_Usage
	 */
	//Gets the usage
	public function GetUsage()
	{
		return $this->GetValue(FormKeys::REPORT_USAGE);
	}

	/**
	 * @return string|Report_ResultSelection
	 */
	//Gets the results
	public function GetResultSelection()
	{
		return $this->GetValue(FormKeys::REPORT_RESULTS);
	}

	/**
	 * @return string|Report_GroupBy
	 */
	//Gets agrupation
	public function GetGroupBy()
	{
		return $this->GetValue(FormKeys::REPORT_GROUPBY);
	}

	/**
	 * @return string|Report_Range
	 */
	//Gets range
	public function GetRange()
	{
		return $this->GetValue(FormKeys::REPORT_RANGE);
	}

	/**
	 * @return string
	 */
	//Gets start date
	public function GetStart()
	{
		return $this->GetValue(FormKeys::REPORT_START);
	}

	/**
	 * @return string
	 */
	//Gets end date
	public function GetEnd()
	{
		return $this->GetValue(FormKeys::REPORT_END);
	}

	/**
	 * @return int
	 */
	//Gets resource identifier
	public function GetResourceId()
	{
		return $this->GetValue(FormKeys::RESOURCE_ID);
	}

	/**
	 * @return int
	 */
	//Unused
	public function GetScheduleId()
	{
		return $this->GetValue(FormKeys::SCHEDULE_ID);
	}

	/**
	 * @return int
	 */
	//Gets user identifier
	public function GetUserId()
	{
		return $this->GetValue(FormKeys::USER_ID);
	}

	/**
	 * @return int
	 */
	//Unused
	public function GetParticipantId()
	{
		return $this->GetValue(FormKeys::PARTICIPANT_ID);
	}

	/**
	 * @return int
	 */
	//Gets group identifier
	public function GetGroupId()
	{
		return $this->GetValue(FormKeys::GROUP_ID);
	}

	//Sends report data to the Smarty page
	public function BindReport(IReport $report, IReportDefinition $definition)
	{
		$this->Set('Definition', $definition);
		$this->Set('Report', $report);
	}

	/**
	 * @param array|BookableResource[] $resources
	 */
	//Sends resources data to the Smarty page
	public function BindResources($resources)
	{
		$this->Set('Resources', $resources);
	}

	/**
	 * @param array|AccessoryDto[] $accessories
	 */
	//Unused
	public function BindAccessories($accessories)
	{
		$this->Set('Accessories', $accessories);
	}

	/**
	 * @param array|Schedule[] $schedules
	 */
	//Unused
	public function BindSchedules($schedules)
	{
		$this->Set('Schedules', $schedules);
	}

	/**
	 * @return int
	 */
	//Unused
	public function GetAccessoryId()
	{
		return $this->GetValue(FormKeys::ACCESSORY_ID);
	}


	//Unused
	public function GetReportName()
	{
		return $this->GetForm(FormKeys::REPORT_NAME);
	}

	//Unused
	private function GetValue($key)
	{
		$postValue = $this->GetForm($key);

		if (empty($postValue))
		{
			return $this->GetQuerystring($key);
		}

		return $postValue;
	}

	//Unused
	public function ShowCsv()
	{
		$this->DisplayCsv('Reports/custom-csv.tpl', 'report.csv');
	}

	//Unused
	public function DisplayError()
	{
		$this->Display('Reports/error.tpl');
	}

	//Shows results
	public function ShowResults()
	{
		$this->Display('Reports/results-custom.tpl');
	}

	//Shows printable report
	public function PrintReport()
	{
		$this->Display('Reports/print-custom-report.tpl');
	}

	/**
	 * @param array|GroupItemView[] $groups
	 */
	//Sends groups information to Smarty page
	public function BindGroups($groups)
	{
		$this->Set('Groups', $groups);
	}
}

?>