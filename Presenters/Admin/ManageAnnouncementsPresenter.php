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

require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'Presenters/ActionPresenter.php');

//Actions
class ManageAnnouncementsActions
{
	const Add = 'addAnnouncement';
	const Change = 'changeAnnouncement';
	const Delete = 'deleteAnnouncement';
}

//Class: Supports the announce management controller
class ManageAnnouncementsPresenter extends ActionPresenter
{
	/**
	 * @var IManageAnnouncementsPage
	 */
	private $page;

	/**
	 * @var IAnnouncementRepository
	 */
	private $announcementRepository;

	/**
	 * @param IManageAnnouncementsPage $page
	 * @param IAnnouncementRepository $announcementRepository
	 */
	//Construct
	public function __construct(IManageAnnouncementsPage $page, IAnnouncementRepository $announcementRepository)
	{
		parent::__construct($page);

		$this->page = $page;
		$this->announcementRepository = $announcementRepository;

		$this->AddAction(ManageAnnouncementsActions::Add, 'AddAnnouncement');
		$this->AddAction(ManageAnnouncementsActions::Change, 'ChangeAnnouncement');
		$this->AddAction(ManageAnnouncementsActions::Delete, 'DeleteAnnouncement');
	}

	//Sends the announcements information
	public function PageLoad()
	{
		//MyCode (22/5/2016)
		//Allows pagination in announcements page		
		$page_information = $this->announcementRepository->GetList($this->page->GetPageNumber(), $this->page->GetPageSize(), null, null, null);
		$this->page->BindAnnouncements($page_information->Results());
		$this->page->BindPageInfo($page_information->PageInfo());
	}

	//Adds new announcement
	public function AddAnnouncement()
	{
        $user = ServiceLocator::GetServer()->GetUserSession();
		$text = $this->page->GetText();
		$start = Date::Parse($this->page->GetStart(), $user->Timezone);
		$end = Date::Parse($this->page->GetEnd(), $user->Timezone);
		$priority = $this->page->GetPriority();
		
		Log::Debug('Adding new Announcement');

		$this->announcementRepository->Add(Announcement::Create($text, $start, $end, $priority));
	}

	//Changes existing announcement
	public function ChangeAnnouncement()
	{
        $user = ServiceLocator::GetServer()->GetUserSession();

        $id = $this->page->GetAnnouncementId();
        $text = $this->page->GetText();
        $start = Date::Parse($this->page->GetStart(), $user->Timezone);
        $end = Date::Parse($this->page->GetEnd(), $user->Timezone);
        $priority = $this->page->GetPriority();

		Log::Debug('Changing Announcement with id %s', $id);

		$announcement = $this->announcementRepository->LoadById($id);
        $announcement->SetText($text);
        $announcement->SetDates($start, $end);
        $announcement->SetPriority($priority);

		$this->announcementRepository->Update($announcement);
	}

	//Deletes existing announcement
	public function DeleteAnnouncement()
	{
		$id = $this->page->GetAnnouncementId();

		Log::Debug('Deleting Announcement with id %s', $id);

		$this->announcementRepository->Delete($id);
	}
}
?>