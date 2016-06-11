{*
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
*}
<!DOCTYPE HTML>
<html lang="{$HtmlLang}" dir="{$HtmlTextDirection}">
<head>
	<title>{if $TitleKey neq ''}{translate key=$TitleKey args=$TitleArgs}{else}{$Title}{/if}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$Charset}"/>
</head>
<body>
{translate key=Created}: {format_date date=Date::Now() key=general_datetime}
<table width="100%" border="1">
	<tr>
		{foreach from=$Definition->GetColumnHeaders() item=column}			
				{if $column->HasTitle()}
					{if $column->Title() eq "Resource"}
						<th>{translate key=Resource}</th>
					{elseif $column->Title() eq "Title"}
						<th>{translate key=Title}</th>
					{elseif $column->Title() eq "Description"}
						<th>{translate key=Description}</th>
					{elseif $column->Title() eq "User"}
						<th>{translate key=User}</th>
					{/if}
				{else}
					{if $column->TitleKey() eq "Created"}
					{elseif $column->TitleKey() eq "LastModified"}
					{else}
						<th>{translate key=$column->TitleKey()}</th>
					{/if}
				{/if}				
		{/foreach}
	</tr>
	{foreach from=$Report->GetData()->Rows() item=row}
		{assign var=val value=0}
		<tr>
			{foreach from=$Definition->GetRow($row) item=data}				
				{if $val != 5 && $val < 7}	
					<td>{$data->Value()|escape}&nbsp;</td>
				{/if}
				{assign var=val value=$val+1}
			{/foreach}
		</tr>
	{/foreach}
</table>
{$Report->ResultCount()} {translate key=Rows}
{if $Definition->GetTotal() != ''}
	| {$Definition->GetTotal()} {translate key=Total}
{/if}

{jsfile src="reports/common.js"}

<script type="text/javascript">
	var common = new ReportsCommon(
			{
				scriptUrl: '{$ScriptUrl}'
			}
	);
	common.init();
	window.print();
</script>

</body>
</html>