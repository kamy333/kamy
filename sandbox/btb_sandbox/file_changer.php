<?php
// If safe mode is on (in php.ini) then this PHP script 
// will only be able to modify files that have the same
// owner as this script has.


// rwx (read-write-execute)  rwe=7 read=4 write=2  execute =1  nothind 0  // 1st represent owner  2nd group 3rd other or public

//666


#               user    group   other
#  read(r)      yes     yes     yes
#  write(w)     yes     yes     no
#  execute(x)   yes     no      no
#               rwx     rw-     r--
# symbolic notation  rwsrw-r-- (like above)
#               7       6       4

# octo notation  read(r)=4 write(w)=2  execute(x)=1 nothing(-)=0
#  rwx= 0666 = all have read and write right

echo fileowner('file_permissions.php');
echo "<br />";

/*// if we have Posix installed
$owner_id = fileowner('file_permissions.php');
$owner_array = posix_getpwuid($owner_id);
echo $owner_array['name'];*/

echo "<br />";

chown('file_permissions.php', 'kevin');
// chown only works if PHP is superuser
// making webserver/PHP a superuser is a big security issue

// if we have Posix installed
/*$owner_id = fileowner('file_permissions.php');
$owner_array = posix_getpwuid($owner_id);
echo $owner_array['name'];

echo "<br />";*/

echo substr(decoct(fileperms('file_permissions.php')), 2);
chmod('file_permissions.php', 0666);
echo "<br />";
echo substr(decoct(fileperms('file_permissions.php')), 2);

echo "<br />";
echo is_readable('file_permissions.php') ? 'yes' : 'no';
echo "<br />";
echo is_writable('file_permissions.php') ? 'yes' : 'no';
echo "<br />";
?>