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

<h1>Guía de administración</h1>

<div id="help">
	<h2>Gestión de Recursos</h2>

	<p>
		En la gestión de recursos, es posible dar de alta un nuevo recurso, o bien modificar su nombre, localización, permisos
		o configuración de uso. También es posible marcar el recurso con aprobación necesaria o no. Para dar de baja un recurso
		se puede pinchar en la cruz de la parte derecha de la pantalla.
	</p>

	<h2>Gestión de Usuarios</h2>

	<p>
		En la gestión de usuarios, es posible modificar el acceso a recursos de los mismo, asi como asignar un grupo a cada uno de
		los usuarios. También es posible visualizar sus datos personales en la tabla correspondiente.
	</p>

	<h2>Gestión de Grupos</h2>

	<p>
		En la gestión de grupos, es posible dar de alta un grupo, o bien modificar su nombre, composición de miembros o acceso a
		recursos de los mismos. También es posible asignarle roles a un grupo. Para dar de baja al grupo se puede pinchar en la cruz
		de la parte derecha de la pantalla.
	</p>	

	<h2>Gestión de Anuncios</h2>

	<p>
		En la gestión de anuncios, es posible crear un nuevo anuncio pulsando sobre el botón de crear y seleccionando las opciones
		correspondientes. Es posible modificar un anuncio existente pinchando sobre el mismo, o bien borrarlo seleccionando la cruz
		de la parte derecha de la pantalla. La prioridad del anuncio es más alta cuanto menor valor de prioridad se le asigne.
		Si las fechas son correctas el anuncio se mostrará inmediatamente.
	</p>	

	<h2>Gestión de Cuotas</h2>

	<p>
		En la gestión de cuotas es posible definir limites al numero de horas o reservas que un grupo de usuarios es susceptible de
		realizar en un periodo de tiempo determinado, el cual puede ser un dia, una semana o un mes. Se puede añadir una nueva cuota
		pulsando en el botón correspondiente, y se puede borrar una existente de manera habitual.
	</p>

	<h2>Informes</h2>

	<p>
		El administrador puede generar un informe de la utilización de las salas mediante diferentes criterios. Es posible crear una lista
		una cuenta o bien el numero de horas de utilizacion. Estos criterios se pueden agrupar a su vez por usuario,
		grupo o recurso. El informe se puede visualizar como texto o gráfico, y se puede imprimir si es necesario.
	</p>	

</div>

{include file='globalfooter.tpl'}