{*
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
*}

{include file='globalheader.tpl'}

<h1>Administration guide</h1>

<div id="help">
	<h2>Resource management</h2>

	<p>
		In resource management screen, it is possible to create a new resource. It it also possible to modify name, location and
		access, as well as configuration usage. It is also possible to select if a resource requires approving. In order to delete
		a resource, you must select the red cross at the right part of the screen.
	</p>

	<h2>Users management</h2>

	<p>
		In user management screen, it is possible to modify resource access per user, as well as the group which the user belongs
		It is also possible to check the personal data at the table.
	</p>

	<h2>Group management</h2>

	<p>
		In group management screen, it is possible to create new groups, as well as modifying the name, composition or resources access
		from them.It is also possible to assign or remove roles from the group. In order to delete
		a group, you must select the red cross at the right part of the screen.
	</p>	

	<h2>Announcements management</h2>

	<p>
		In announcements management screen, it is possible to create a new announcement, as well as editing an existing one by clicking on it. 
		It is also possible to delete an existing announcement by selecting the red cross in the right part of the screen.
		Announcement priority is higher the lesser number its selected for it.
		If dates are correct, the announcement will be displayed inmediatly.
	</p>	

	<h2>Quota management</h2>

	<p>
		In quota management screen, it is possible to define al imit of hours or reservations that an user from a certain group can make
		in a certain period of time, which can be daily, weekly or monthly. It is possible to add a new quota by clicking the add button,
		and it is possible to delete an existing one by selecting the red cross in the right part of the screen.
	</p>

	<h2>Reports</h2>

	<p>
		Administrator can generate a new report attending to different criteria. The report can be a list, a count, or a amount of hours of
		usage. It is possible to group by user, group or resource. It is also possible to bind it in a range of dates. Reports can be displayed
		as a list or as graphic, and they can be printed afterwards.
	</p>
</div>

{include file='globalfooter.tpl'}