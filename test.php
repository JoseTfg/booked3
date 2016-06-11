<?php
  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(-1);
            
  // Username used to connect to the server
  $username = "uo35487";
                      
  // Password of the user.
  $password = "Pg7X679E";
                                
  // Either an IP or a domain.
  $ldap_server = "ldaps://156.35.11.178:636";
                                          
  // Get a connection
  $ldap_conn = ldap_connect($ldap_server);
                                                    
  // Set LDAP_OPT_PROTOCOL_VERSION to 3
  ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("Could not set LDAP Protocol version");
                                                              
  // Authenticate the user and link the resource_id with
  // the authentication.
  if($ldapbind = ldap_bind($ldap_conn, $username, $password) == true)
  {
    echo "Login correct.<br />";
  }
  else
  {
    echo "Could not bind to the server. Check the username/password.<br />";
    echo "Server Response:"
    // Error number.
    . "<br />Error Number: " . ldap_errno($ldap_conn)
    // Error description.
    . "<br />Description: " . ldap_error($ldap_conn);
  }
  
  // Always make sure you close the server after
  // your script is finished.
  ldap_close($ldap_conn);
?>
 