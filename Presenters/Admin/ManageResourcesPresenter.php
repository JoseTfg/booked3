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

require_once(ROOT_DIR . 'Domain/namespace.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Graphics/namespace.php');
require_once(ROOT_DIR . 'Presenters/ActionPresenter.php');

//Class: Actions related to this presenter
class ManageResourcesActions
{
	const ActionAdd = 'add';
	const ActionChangeAdmin = 'changeAdmin';
	const ActionChangeConfiguration = 'configuration';
	const ActionChangeDescription = 'description';
	const ActionChangeImage = 'image';
	const ActionChangeLocation = 'location';
	const ActionChangeNotes = 'notes';
	const ActionChangeSchedule = 'schedule';
	const ActionRemoveImage = 'removeImage';
	const ActionRename = 'rename';
	const ActionDelete = 'delete';
	const ActionChangeStatus = 'changeStatus';
	const ActionEnableSubscription = 'enableSubscription';
	const ActionDisableSubscription = 'disableSubscription';
	const ActionChangeAttributes = 'changeAttributes';
	const ActionChangeSort = 'changeSort';
	const ActionChangeResourceType = 'changeResourceType';
	const ActionBulkUpdate = 'bulkUpdate';
	const ActionAddUserPermission = 'addUserPermission';
	const ActionRemoveUserPermission = 'removeUserPermission';
	const ActionAddGroupPermission = 'addGroupPermission';
	const ActionRemoveGroupPermission = 'removeGroupPermission';
}

//Class: Supports the resource management controller
class ManageResourcesPresenter extends ActionPresenter
{
	/**
	 * @var IManageResourcesPage
	 */
	private $page;

	/**
	 * @var IResourceRepository
	 */
	private $resourceRepository;

	/**
	 * @var IScheduleRepository
	 */
	private $scheduleRepository;

	/**
	 * @var IImageFactory
	 */
	private $imageFactory;

	/**
	 * @var IGroupViewRepository
	 */
	private $groupRepository;

	/**
	 * @var IAttributeService
	 */
	private $attributeService;

	/**
	 * @var IUserPreferenceRepository
	 */
	private $userPreferenceRepository;

	//Construct
	public function __construct(
		IManageResourcesPage $page,
		IResourceRepository $resourceRepository,
		IScheduleRepository $scheduleRepository,
		IImageFactory $imageFactory,
		IGroupViewRepository $groupRepository,
		IAttributeService $attributeService,
		IUserPreferenceRepository $userPreferenceRepository)
	{
		parent::__construct($page);

		$this->page = $page;
		$this->resourceRepository = $resourceRepository;
		$this->scheduleRepository = $scheduleRepository;
		$this->imageFactory = $imageFactory;
		$this->groupRepository = $groupRepository;
		$this->attributeService = $attributeService;
		$this->userPreferenceRepository = $userPreferenceRepository;

		$this->AddAction(ManageResourcesActions::ActionAdd, 'Add');
		$this->AddAction(ManageResourcesActions::ActionChangeAdmin, 'ChangeAdmin');
		$this->AddAction(ManageResourcesActions::ActionChangeConfiguration, 'ChangeConfiguration');
		$this->AddAction(ManageResourcesActions::ActionChangeDescription, 'ChangeDescription');
		$this->AddAction(ManageResourcesActions::ActionChangeImage, 'ChangeImage');
		$this->AddAction(ManageResourcesActions::ActionChangeLocation, 'ChangeLocation');
		$this->AddAction(ManageResourcesActions::ActionChangeNotes, 'ChangeNotes');
		$this->AddAction(ManageResourcesActions::ActionChangeSchedule, 'ChangeSchedule');
		$this->AddAction(ManageResourcesActions::ActionRemoveImage, 'RemoveImage');
		$this->AddAction(ManageResourcesActions::ActionRename, 'Rename');
		$this->AddAction(ManageResourcesActions::ActionDelete, 'Delete');
		$this->AddAction(ManageResourcesActions::ActionChangeStatus, 'ChangeStatus');
		$this->AddAction(ManageResourcesActions::ActionEnableSubscription, 'EnableSubscription');
		$this->AddAction(ManageResourcesActions::ActionDisableSubscription, 'DisableSubscription');
		$this->AddAction(ManageResourcesActions::ActionChangeAttributes, 'ChangeAttributes');
		$this->AddAction(ManageResourcesActions::ActionChangeSort, 'ChangeSortOrder');
		$this->AddAction(ManageResourcesActions::ActionChangeResourceType, 'ChangeResourceType');
		$this->AddAction(ManageResourcesActions::ActionBulkUpdate, 'BulkUpdate');
		$this->AddAction(ManageResourcesActions::ActionAddUserPermission, 'AddUserPermission');
		$this->AddAction(ManageResourcesActions::ActionRemoveUserPermission, 'RemoveUserPermission');
		$this->AddAction(ManageResourcesActions::ActionAddGroupPermission, 'AddGroupPermission');
		$this->AddAction(ManageResourcesActions::ActionRemoveGroupPermission, 'RemoveGroupPermission');
	}

	//Sends the data to the page
	public function PageLoad()
	{
		$resourceAttributes = $this->attributeService->GetByCategory(CustomAttributeCategory::RESOURCE);

		$filterValues = $this->page->GetFilterValues();

		$results = $this->resourceRepository->GetList($this->page->GetPageNumber(), $this->page->GetPageSize(), null, null, $filterValues->AsFilter($resourceAttributes));
		$resources = $results->Results();
		$this->page->BindResources($resources);
		$this->page->BindPageInfo($results->PageInfo());

		$schedules = $this->scheduleRepository->GetAll();
		$scheduleList = array();

		/* @var $schedule Schedule */
		foreach ($schedules as $schedule)
		{
			$scheduleList[$schedule->GetId()] = $schedule->GetName();
		}
		$this->page->BindSchedules($scheduleList);
		$this->page->AllSchedules($schedules);

		$resourceTypes = $this->resourceRepository->GetResourceTypes();
		$resourceTypeList = array();

		/* @var $resourceType ResourceType */
		foreach ($resourceTypes as $resourceType)
		{
			$resourceTypeList[$resourceType->Id()] = $resourceType;
		}
		$this->page->BindResourceTypes($resourceTypeList);

		$statusReasons = $this->resourceRepository->GetStatusReasons();
		$statusReasonList = array();

		foreach ($statusReasons as $reason)
		{
			$statusReasonList[$reason->Id()] = $reason;
		}
		$this->page->BindResourceStatusReasons($statusReasonList);

		$groups = $this->groupRepository->GetGroupsByRole(RoleLevel::RESOURCE_ADMIN);
		$this->page->BindAdminGroups($groups);

		$resourceIds = array();
		foreach ($resources as $resource)
		{
			$resourceIds[] = $resource->GetId();
		}

		$attributeList = $this->attributeService->GetAttributes(CustomAttributeCategory::RESOURCE, $resourceIds);
		$this->page->BindAttributeList($attributeList);


		$this->InitializeFilter($filterValues, $resourceAttributes);
	}

	//Adds new resource
	public function Add()
	{
		$name = $this->page->GetResourceName();
		$scheduleId = $this->page->GetScheduleId();
		$autoAssign = $this->page->GetAutoAssign();
		$resourceAdminGroupId = $this->page->GetAdminGroupId();

		Log::Debug("Adding new resource with name: %s, scheduleId: %s, autoAssign: %s, resourceAdminGroupId %s", $name, $scheduleId, $autoAssign, $resourceAdminGroupId);
		$resource = BookableResource::CreateNew($name, $scheduleId, $autoAssign);
		$resource->SetAdminGroupId($resourceAdminGroupId);
		$this->resourceRepository->Add($resource);
	}

	//Change resource configuration
	public function ChangeConfiguration()
	{
		$resourceId = $this->page->GetResourceId();
		$minDuration = $this->page->GetMinimumDuration();
		$maxDuration = $this->page->GetMaximumDuration();
		$allowMultiDay = $this->page->GetAllowMultiday();
		$requiresApproval = $this->page->GetRequiresApproval();
		$autoAssign = $this->page->GetAutoAssign();
		$minNotice = $this->page->GetStartNoticeMinutes();
		$maxNotice = $this->page->GetEndNoticeMinutes();
		$maxParticipants = $this->page->GetMaxParticipants();
		$bufferTime = $this->page->GetBufferTime();
		$clearAllPermissions = $this->page->GetAutoAssignClear();

		Log::Debug('Updating resource id %s', $resourceId);

		$resource = $this->resourceRepository->LoadById($resourceId);

		$resource->SetMinLength($minDuration);
		$resource->SetMaxLength($maxDuration);
		$resource->SetAllowMultiday($allowMultiDay);
		$resource->SetRequiresApproval($requiresApproval);
		$resource->SetAutoAssign($autoAssign);
		$resource->SetClearAllPermissions($clearAllPermissions);
		$resource->SetMinNotice($minNotice);
		$resource->SetMaxNotice($maxNotice);
		$resource->SetMaxParticipants($maxParticipants);
		$resource->SetBufferTime($bufferTime);

		$this->resourceRepository->Update($resource);
	}

	//Delete an existing resource
	public function Delete()
	{
		$resource = $this->resourceRepository->LoadById($this->page->GetResourceId());
		$this->resourceRepository->Delete($resource);
	}

	//Change resource description
	public function ChangeDescription()
	{
		$resource = $this->resourceRepository->LoadById($this->page->GetResourceId());

		$resource->SetDescription($this->page->GetDescription());

		$this->resourceRepository->Update($resource);
	}

	//Unused
	public function ChangeNotes()
	{
		//No-op
	}

	//Renames an existing resource
	public function Rename()
	{
		$resource = $this->resourceRepository->LoadById($this->page->GetResourceId());
		$resource->SetName($this->page->GetResourceName());
		$this->resourceRepository->Update($resource);
	}

	//Changes the location of a resource
	public function ChangeLocation()
	{
		$resource = $this->resourceRepository->LoadById($this->page->GetResourceId());
		$resource->SetLocation($this->page->GetLocation());
		$resource->SetContact($this->page->GetContact());

		$this->resourceRepository->Update($resource);
	}

	//changes the image of a resource
	public function ChangeImage()
	{
		Log::Debug("Changing resource image for resource id %s", $this->page->GetResourceId());

		$uploadedImage = $this->page->GetUploadedImage();

		if ($uploadedImage->IsError())
		{
			die("Image error: " . $uploadedImage->Error());
		}

		$fileType = strtolower($uploadedImage->Extension());

		$supportedTypes = array('jpeg', 'gif', 'png', 'jpg');

		if (!in_array($fileType, $supportedTypes))
		{
			die("Invalid image type: $fileType");
		}

		$image = $this->imageFactory->Load($uploadedImage->TemporaryName());
		$image->ResizeToWidth(300);

		$fileName = "resource{$this->page->GetResourceId()}.$fileType";
		$imageUploadDirectory = Configuration::Instance()->GetKey(ConfigKeys::IMAGE_UPLOAD_DIRECTORY);

		$path = '';

		if (is_dir($imageUploadDirectory))
		{
			$path = $imageUploadDirectory;
		}
		else if (is_dir(ROOT_DIR . $imageUploadDirectory))
		{
			$path = ROOT_DIR . $imageUploadDirectory ;
		}

		$path = "$path/$fileName";
		Log::Debug("Saving resource image $path");

		$image->Save($path);

		$this->SaveResourceImage($fileName);
	}

	//Remove the image of a resource
	public function RemoveImage()
	{
		$this->SaveResourceImage(null);
	}

	//Change the status of a resource
	public function ChangeStatus()
	{
		$resourceId = $this->page->GetResourceId();
		$statusId = $this->page->GetStatusId();
		$statusReasonId = $this->page->GetStatusReasonId();
		$statusReason = $this->page->GetNewStatusReason();

		Log::Debug('Changing resource status. ResourceId: %s', $resourceId);

		$resource = $this->resourceRepository->LoadById($resourceId);

		if (empty($statusReasonId) && !empty($statusReason))
		{
			$statusReasonId = $this->resourceRepository->AddStatusReason($statusId, $statusReason);
		}

		$resource->ChangeStatus($statusId, $statusReasonId);
		$this->resourceRepository->Update($resource);
	}

	//Unused
	public function ChangeSchedule()
	{
		//No-op
	}

	//Change the resource administrator
	public function ChangeAdmin()
	{
		$resourceId = $this->page->GetResourceId();
		Log::Debug('Changing resource admin for resource %s', $resourceId);

		$resource = $this->resourceRepository->LoadById($resourceId);
		$adminGroupId = $this->page->GetAdminGroupId();
		$resource->SetAdminGroupId($adminGroupId);
		$this->resourceRepository->Update($resource);
	}

	//Unused
	public function EnableSubscription()
	{
		//No-op
	}

	//Unused
	public function DisableSubscription()
	{
		//No-op
	}

	//Unused
	public function ChangeAttributes()
	{
		///No-op
	}

	//Unused
	public function ChangeSortOrder()
	{
		//No-op
	}

	//Unused
	public function ChangeResourceType()
	{
		//No-op
	}

	//Unused
	private function GetAttributeValues()
	{
		$attributes = array();
		foreach ($this->page->GetAttributes() as $attribute)
		{
			$attributes[] = new AttributeValue($attribute->Id, $attribute->Value);
		}
		return $attributes;
	}

	//Unused
	private function SaveResourceImage($fileName)
	{
		$resource = $this->resourceRepository->LoadById($this->page->GetResourceId());

		$resource->SetImage($fileName);

		$this->resourceRepository->Update($resource);
	}

	/**
	 * @param ResourceFilterValues $filterValues
	 * @param CustomAttribute[] $resourceAttributes
	 */
	//Initialize the filter
	public function InitializeFilter($filterValues, $resourceAttributes)
	{
		$filters = $filterValues->Attributes;
		$attributeFilters = array();
		foreach ($resourceAttributes as $attribute)
		{
			$attributeValue = null;
			if (array_key_exists($attribute->Id(), $filters))
			{
				$attributeValue = $filters[$attribute->Id()];
			}
			$attributeFilters[] = new Attribute($attribute, $attributeValue);
		}

		$this->page->BindAttributeFilters($attributeFilters);
		$this->page->SetFilterValues($filterValues);
	}

	//Unused
	public function BulkUpdate()
	{
		//No-op
	}

	//Adds permission to user
	public function AddUserPermission()
	{
		$userId = $this->page->GetPermissionUserId();
		$resourceId = $this->page->GetResourceId();

		$this->resourceRepository->AddResourceUserPermission($resourceId, $userId);
	}

	//Removes the permission of an user
	public function RemoveUserPermission()
	{
		$userId = $this->page->GetPermissionUserId();
		$resourceId = $this->page->GetResourceId();

		$this->resourceRepository->RemoveResourceUserPermission($resourceId, $userId);
	}

	//Adds the permission of a group
	public function AddGroupPermission()
	{
		$groupId = $this->page->GetPermissionGroupId();
		$resourceId = $this->page->GetResourceId();

		$this->resourceRepository->AddResourceGroupPermission($resourceId, $groupId);
	}

	//Removes the permission of a group
	public function RemoveGroupPermission()
	{
		$groupId = $this->page->GetPermissionGroupId();
		$resourceId = $this->page->GetResourceId();

		$this->resourceRepository->RemoveResourceGroupPermission($resourceId, $groupId);
	}

	//Loads validations
	protected function LoadValidators($action)
	{
		if ($action == ManageResourcesActions::ActionChangeAttributes)
		{
			$attributes = $this->GetAttributeValues();
			$this->page->RegisterValidator('attributeValidator', new AttributeValidator($this->attributeService, CustomAttributeCategory::RESOURCE, $attributes, $this->page->GetResourceId()));
		}
		if ($action == ManageResourcesActions::ActionBulkUpdate)
		{
			$attributes = $this->GetAttributeValues();
			$this->page->RegisterValidator('bulkAttributeValidator', new AttributeValidator($this->attributeService, CustomAttributeCategory::RESOURCE, $attributes, null, true));
		}
	}

	//Process a request
	public function ProcessDataRequest($dataRequest)
	{
		if ($dataRequest == 'all')
		{
			$this->page->SetResourcesJson(array_map(array('AdminResourceJson', 'FromBookable'), $this->resourceRepository->GetResourceList()));
		}
		else if ($dataRequest == 'users')
		{
			$groups = $this->resourceRepository->GetUsersWithPermission($this->page->GetResourceId());
			$response = new UserResults($groups->Results(), $groups->PageInfo()->Total);
			$this->page->SetJsonResponse($response);
		}
		else if ($dataRequest == 'groups')
		{
			$groups = $this->resourceRepository->GetGroupsWithPermission($this->page->GetResourceId());
			$response = new GroupResults($groups->Results(), $groups->PageInfo()->Total);
			$this->page->SetJsonResponse($response);
		}
	}

	//Changing drop down option
	private function ChangingDropDown($value)
	{
		return $value != "-1";
	}

	//Changing general option
	private function ChangingValue($value)
	{
		return !empty($value);
	}
}

//Class: Supports the JSON
class AdminResourceJson
{
	public $Id;
	public $Name;

	//Construct
	public function __construct($id, $name)
	{
		$this->Id = $id;
		$this->Name = $name;
	}

	//Gets resource
	public static function FromBookable(BookableResource $resource)
	{
		return new AdminResourceJson($resource->GetId(), $resource->GetName());
	}
}

//Filter
class UserResults
{
	/**
	 * @param UserItemView[] $users
	 * @param int $totalUsers
	 */
	//Construct
	public function __construct($users, $totalUsers)
	{
		foreach ($users as $user)
		{
			$this->Users[] = new AutocompleteUser($user->Id, $user->First, $user->Last, $user->Email, $user->Username);
		}
		$this->Total = $totalUsers;
	}

	/**
	 * @var int
	 */
	public $Total;

	/**
	 * @var AutocompleteUser[]
	 */
	public $Users;
}

//Filter
class GroupResults
{
	/**
	 * @param GroupItemView[] $groups
	 * @param int $totalGroups
	 */
	//Construct
	public function __construct($groups, $totalGroups)
	{
		$this->Groups = $groups;
		$this->Total = $totalGroups;
	}

	/**
	 * @var int
	 */
	public $Total;

	/**
	 * @var GroupItemView[]
	 */
	public $Groups;
}