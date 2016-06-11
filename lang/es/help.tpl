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

<h1>Guía de usuario</h1>

<div id="help">
<h2>Autenticación</h2>

<p>
	La autenticación en el sistema se puede realizar introduciendo las credenciales en la pantalla inicial.
	También es posible visualizar las reservas en modo anónimo mediante el botón "Ver Reservas".
</p>

<h2>Calendario</h2>

<p>
	El calendario ofrece una vista de todas las reservas existentes, las cuales pueden ser filtradas por
	recurso, haciendo uso del selectro múltiple de la parte superior, o bien visualizar las reservas de
	todos los usuarios mediante el interruptor adyacente.
	Los anuncios se pueden visuliazar en formato marquesina en la parte inferior de la pantalla.
	El calendario ofrece las siguientes vistas: diaria, semanal, mensual y listado.
</p>

<h2>Reservas</h2>

<p>
	Es posible crear nuevas reservas desde el calendario haciendo click derecho sobre el mismo, o bien pinchando
	y arrastrando con el ratón. Se pueden comprobar los datos de una reserva existente haciendo doble click
	sobre la misma, o bien borrarla haciendo click derecho y seleccionando la opción de borrado. Las reservas
	pueden incluir un título, una descripción, y diversas opciones de recurrencia, tales como diaria, semanal
	o mensual.
</p>

<h2>Preferencias</h2>

<p>
	Las preferencias de usuario se pueden modificar haciendo click en la rueda del menú de navegación, entre
	las cuales es posible definir un color para las reservas de cada recurso, o bien seleccionar el horario
	de visualización del calendario. Estas preferencias pueden tomar tiempo en tomar efecto.
</p>

<h2>Exportar</h2>

<p>
	Las reservas del calendario se pueden exportar bien en formato .ics, o bien hacia una cuenta de Google
	mediante la opción correspondiente del menú preferencias. Es necesario estar autenticado en el servicio
	para poder utilizar dicha opción.
</p>

<h2>Aprobar reservas</h2>

<p>
	Si se disponen de los permisos necesarios, el usuario puede aprobar las reservas que estén marcadas como
	pendientes de aprobación, haciendo doble click sobre las mismas y seleccionando la opción de aprobación.
	El usuario que realizó la reserva recibirá una notificación por correo electrónico.
</p>

</div>

{include file='globalfooter.tpl'}