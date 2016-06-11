<?php

ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);

putenv('LDAPTLS_REQCERT=allow');
putenv("LDAPCONF=C:\OpenLDAP\sysconf\ldap.conf");
putenv('LDAPTLS_REQCERT=never');

//uo67113@uniovi.es

//Uniovi
$username = 'uo204462';
$password = '825057';
$ldapconfig['host'] = "ldaps://DC2.uac.si.uniovi.es:636/";
//$ldapconfig['host'] = "ldaps://directorio.uniovi.es:636/";
//$ldapconfig['host'] = 'ldaps://directorio.uniovi.es';
$ldapconfig['port'] = 389;
$ldapconfig['basedn'] = 'dc=uniovi,dc=es';
$dn="uid=".$username.",ou=Alumnos,".$ldapconfig['basedn'];

//Jumpcloud
// $username = 'user1';
// $password = 'password';
// $ldapconfig['host'] = 'ldap://ldap.jumpcloud.com';
// $ldapconfig['port'] = 389;
// $ldapconfig['basedn'] = 'o=56d6fc6e62695b7f543ae469,dc=jumpcloud,dc=com';
// $dn="uid=".$username.",ou=Users,".$ldapconfig['basedn'];


//$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);
$ds=ldap_connect($ldapconfig['host']);
echo $ds ? 'true' : 'false';
//echo($ds);
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

if ($bind=ldap_bind($ds, $dn, $password)) {
    echo("Login correct");
} else {
    echo("Login incorrect");
}

?>