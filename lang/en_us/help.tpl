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

<h1>User guide</h1>

<div id="help">
<h2>Authentication</h2>

<p>
	You can log in the system by inserting correct credentials in the login screen.
	You could also sign as anonymous user by clicking the "View reservations" button.
</p>

<h2>Calendar</h2>

<p>
	Calendar offers a view of all existing reservations, which can be filtered by resource,
	using the multiselect above the calendar. You can view all users reservations by using
	the switch next to the multiselect.
	Announcements can be viewed under the calendar in a marquee format.
	The following views are available: diary, weekly, monthly and list.
</p>

<h2>Reservations</h2>

<p>
	You can create new reservations by right clicking in the calendar, also you can create them by dragging
	the mouse on it. You can check an existing reservation via right click, or deleting it by right click and
	selecting the delete option. Reservations can include a title, a description and recurrence options such
	as diary, weekly, or monthly.
</p>

<h2>Preferences</h2>

<p>
	Preferences can be modified selecting the option in the navigation menu. It is possible to define a colour
	for reservations, grouped by resource, or selecting the timetable boundaries. 
	This preferences can take some time to take effect.
</p>

<h2>Export</h2>

<p>
	Reservations can be downloaded as a .ics file, or can be exported to the Google Calendar service.
	It is required to be authenticated in this service to be able to use it.
</p>

<h2>Approving</h2>

<p>
	If user has the correct permissions, reservation approving can be be possible by double click and selecting
	the approving reservation option. Reservation owner will be notified via email.
</p>

</div>

{include file='globalfooter.tpl'}