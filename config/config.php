<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

$conf['settings']['app.title'] = 'Booked Scheduler';
$conf['settings']['default.timezone'] = 'Europe/Madrid';
$conf['settings']['allow.self.registration'] = 'true';
$conf['settings']['admin.email.name'] = 'Booked Administrator';
$conf['settings']['default.page.size'] = '10';
$conf['settings']['enable.email'] = 'true';
$conf['settings']['admin.email'] = 'booked0@hotmail.com';
$conf['settings']['default.language'] = 'en_us';
$conf['settings']['script.url'] = 'http://localhost/booked/Web';
$conf['settings']['image.upload.directory'] = 'Web/uploads/images';
$conf['settings']['image.upload.url'] = 'uploads/images';
$conf['settings']['cache.templates'] = 'true';
$conf['settings']['use.local.jquery'] = 'false';
$conf['settings']['registration.captcha.enabled'] = 'false';
$conf['settings']['registration.require.email.activation'] = 'false';
$conf['settings']['registration.auto.subscribe.email'] = 'true';
$conf['settings']['registration.notify.admin'] = 'false';
$conf['settings']['inactivity.timeout'] = '';
$conf['settings']['name.format'] = '{first} {last}';
$conf['settings']['css.extension.file'] = '';
$conf['settings']['disable.password.reset'] = 'false';
$conf['settings']['home.url'] = 'http://localhost/booked/Web';
$conf['settings']['logout.url'] = '';
$conf['settings']['default.homepage'] = '3';
$conf['settings']['schedule']['use.per.user.colors'] = 'false';
$conf['settings']['schedule']['show.inaccessible.resources'] = 'true';
$conf['settings']['schedule']['reservation.label'] = '{name}';
$conf['settings']['schedule']['hide.blocked.periods'] = 'true';
$conf['settings']['ics']['require.login'] = 'true';
$conf['settings']['ics']['subscription.key'] = 'abc';
$conf['settings']['ics']['import'] = 'false';
$conf['settings']['ics']['import.key'] = '';
$conf['settings']['privacy']['view.schedules'] = 'false';
$conf['settings']['privacy']['view.reservations'] = 'false';
$conf['settings']['privacy']['hide.user.details'] = 'false';
$conf['settings']['privacy']['hide.reservation.details'] = 'false';
$conf['settings']['reservation']['start.time.constraint'] = 'future';
$conf['settings']['reservation']['updates.require.approval'] = 'false';
$conf['settings']['reservation']['prevent.participation'] = 'false';
$conf['settings']['reservation']['prevent.recurrence'] = 'false';
$conf['settings']['reservation']['enable.reminders'] = 'false';
$conf['settings']['reservation.notify']['resource.admin.add'] = 'false';
$conf['settings']['reservation.notify']['resource.admin.update'] = 'false';
$conf['settings']['reservation.notify']['resource.admin.delete'] = 'false';
$conf['settings']['reservation.notify']['resource.admin.approval'] = 'false';
$conf['settings']['reservation.notify']['application.admin.add'] = 'false';
$conf['settings']['reservation.notify']['application.admin.update'] = 'false';
$conf['settings']['reservation.notify']['application.admin.delete'] = 'false';
$conf['settings']['reservation.notify']['application.admin.approval'] = 'false';
$conf['settings']['reservation.notify']['group.admin.add'] = 'true';
$conf['settings']['reservation.notify']['group.admin.update'] = 'true';
$conf['settings']['reservation.notify']['group.admin.delete'] = 'true';
$conf['settings']['reservation.notify']['group.admin.approval'] = 'true';
$conf['settings']['uploads']['enable.reservation.attachments'] = 'false';
$conf['settings']['uploads']['reservation.attachment.path'] = 'uploads/reservation';
$conf['settings']['uploads']['reservation.attachment.extensions'] = 'txt,jpg,gif,png,doc,docx,pdf,xls,xlsx,ppt,pptx,csv';
$conf['settings']['database']['type'] = 'mysql';
$conf['settings']['database']['user'] = 'booked_user';
$conf['settings']['database']['password'] = 'mysql';
$conf['settings']['database']['hostspec'] = '127.0.0.1';
$conf['settings']['database']['name'] = 'bookedscheduler';
$conf['settings']['phpmailer']['mailer'] = 'smtp';
$conf['settings']['phpmailer']['smtp.host'] = 'smtp.live.com';
$conf['settings']['phpmailer']['smtp.port'] = '25';
$conf['settings']['phpmailer']['smtp.secure'] = 'tls';
$conf['settings']['phpmailer']['smtp.auth'] = 'true';
$conf['settings']['phpmailer']['smtp.username'] = 'booked0@hotmail.com';
$conf['settings']['phpmailer']['smtp.password'] = 'josetfg18';
$conf['settings']['phpmailer']['sendmail.path'] = '/usr/sbin/sendmail';
$conf['settings']['phpmailer']['smtp.debug'] = 'false';
$conf['settings']['plugins']['Authentication'] = 'LDAP';
$conf['settings']['plugins']['Authorization'] = '';
$conf['settings']['plugins']['Permission'] = '';
$conf['settings']['plugins']['PostRegistration'] = '';
$conf['settings']['plugins']['PreReservation'] = '';
$conf['settings']['plugins']['PostReservation'] = '';
$conf['settings']['install.password'] = 'password';
$conf['settings']['pages']['enable.configuration'] = 'true';
$conf['settings']['api']['enabled'] = 'true';
$conf['settings']['recaptcha']['enabled'] = 'false';
$conf['settings']['recaptcha']['public.key'] = '';
$conf['settings']['recaptcha']['private.key'] = '';
$conf['settings']['email']['default.from.address'] = '';
$conf['settings']['email']['default.from.name'] = '';
$conf['settings']['reports']['allow.all.users'] = 'false';
$conf['settings']['password']['minimum.letters'] = '6';
$conf['settings']['password']['minimum.numbers'] = '0';
$conf['settings']['password']['upper.and.lower'] = 'false';
$conf['settings']['reservation.labels']['ics.summary'] = '{title}';
$conf['settings']['reservation.labels']['ics.my.summary'] = '{title}';
$conf['settings']['reservation.labels']['rss.description'] = '<div><span>Start</span> {startdate}</div><div><span>End</span> {enddate}</div><div><span>Organizer</span> {name}</div><div><span>Description</span> {description}</div>';
$conf['settings']['reservation.labels']['my.calendar'] = '{resourcename} {title}';
$conf['settings']['reservation.labels']['resource.calendar'] = '{name}';
$conf['settings']['reservation.labels']['reservation.popup'] = '';
$conf['settings']['security']['security.headers'] = 'false';
$conf['settings']['security']['security.strict-transport'] = 'true';
$conf['settings']['security']['security.x-frame'] = 'deny';
$conf['settings']['security']['security.x-xss'] = '1; mode=block';
$conf['settings']['security']['security.x-content-type'] = 'nosniff';
$conf['settings']['security']['security.content-security-policy'] = 'default-src \'self\'';
$conf['settings']['google.analytics']['tracking.id'] = '';
$conf['settings']['FirstName_LastName#color#Conference Room 1'] = 'FF2E7F';
$conf['settings']['FirstName_LastName#minTime'] = '10:00';
$conf['settings']['FirstName_LastName#maxTime'] = '20:00';
$conf['settings']['FirstName_LastName#color#Conference Room 2'] = '7AEFE1';
$conf['settings']['FirstName_LastName#color#Conference Room 4'] = 'D3CAFF';
$conf['settings']['Jose_Szklarz de Quesada#minTime'] = '10:00';
$conf['settings']['Jose_Szklarz de Quesada#maxTime'] = '20:00';
$conf['settings']['user2_user2#minTime'] = '10:00';
$conf['settings']['user2_user2#maxTime'] = '20:00';
$conf['settings']['user3_user3#minTime'] = '10:00';
$conf['settings']['user3_user3#maxTime'] = '20:00';
$conf['settings']['Jose_Szklarz de Quesada#color#Conference Room 1'] = 'FFAC5E';
$conf['settings']['Jose_Szklarz de Quesada#color#Audiovisuales Departamental Oeste 2.1.15'] = 'FF5619';
?>