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

require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'Presenters/ActionPresenter.php');

//Actions
class ManageAttributesActions
{
    const AddAttribute = 'addAttribute';
    const DeleteAttribute = 'deleteAttribute';
    const UpdateAttribute = 'updateAttribute';
}

//Unused
class ManageAttributesPresenter extends ActionPresenter
{
	/**
	 * @var IManageAttributesPage
	 */
	private $page;

	/**
	 * @var IAttributeRepository
	 */
	private $attributeRepository;

	//Construct
	public function __construct(IManageAttributesPage $page, IAttributeRepository $attributeRepository)
	{
		parent::__construct($page);

		$this->page = $page;
		$this->attributeRepository = $attributeRepository;

        $this->AddAction(ManageAttributesActions::AddAttribute, 'AddAttribute');
        $this->AddAction(ManageAttributesActions::DeleteAttribute, 'DeleteAttribute');
        $this->AddAction(ManageAttributesActions::UpdateAttribute, 'UpdateAttribute');
	}

	//Unused
	public function PageLoad()
	{
		//No-op
	}

	//Adds new attribute
    public function AddAttribute()
    {
        $attributeName = $this->page->GetLabel();
		$type = $this->page->GetType();
		$scope = $this->page->GetCategory();
		$regex = $this->page->GetValidationExpression();
		$required = $this->page->GetIsRequired();
		$possibleValues = $this->page->GetPossibleValues();
		$sortOrder = $this->page->GetSortOrder();
		$entityId = $this->page->GetEntityId();

        Log::Debug('Adding new attribute named: %s', $attributeName);

        $attribute = CustomAttribute::Create($attributeName, $type, $scope, $regex, $required, $possibleValues, $sortOrder, $entityId);
		$attributeId = $this->attributeRepository->Add($attribute);

		return $attributeId;
    }

	//Unused
	public function DeleteAttribute()
	{
		//No-op
	}

	//Unused
	public function UpdateAttribute()
	{
		//No-op
	}

	//Handles data request
	public function HandleDataRequest($dataRequest)
	{
		$categoryId = $this->page->GetRequestedCategory();

		if (empty($categoryId))
		{
			$categoryId = CustomAttributeCategory::RESERVATION;
		}

		$this->page->BindAttributes($this->attributeRepository->GetByCategory($categoryId));
	}
}
?>