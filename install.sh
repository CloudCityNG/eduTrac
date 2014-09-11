#!/bin/bash

clear

stty erase '^?'

echo -n "Database Host (usually is localhost): "
read DBHOST
    
echo -n "Database Name: "
read DBNAME

echo -n "Database User: "
read DBUSER

echo -n "Database Password: "
read DBPASS

echo -n "eduTrac System Name: "
read SYS_NAME

echo -n "eduTrac System Email: "
read SYS_EMAIL

echo -n "eduTrac Admin First Name: "
read ADMIN_FNAME

echo -n "eduTrac Admin Last Name: "
read ADMIN_LNAME

echo -n "eduTrac Admin Email: "
read ADMIN_EMAIL

echo -n "eduTrac Admin Username: "
read ADMIN_USER

echo -n "eduTrac URL (with trailing slash): "
read URL

echo
echo "Copying files..."
echo

cp eduTrac/Application/Views/install/data/install-extend.sql .
cp eduTrac/Config/constants.sample.php eduTrac/Config/constants.php

echo
echo "Writing to files..."
echo

TODAY=$(date +%Y-%m-%d)
HOUR=$(date +%T)

sed -i "s|{uname}|$ADMIN_USER|g" install-extend.sql

sed -i "s|{pass}|\$2a\$08\$nG7Ba8WwACoM1zdb/RX.RuhfG8LBtesBCmO58TzJqPmxngknlKgtS|g" install-extend.sql

sed -i "s|{aemail}|$ADMIN_EMAIL|g" install-extend.sql

sed -i "s|{fname}|$ADMIN_FNAME|g" install-extend.sql

sed -i "s|{lname}|$ADMIN_LNAME|g" install-extend.sql

sed -i "s|{now}|$TODAY $HOUR|g" install-extend.sql

sed -i "s|{email}|$SYS_EMAIL|g" install-extend.sql

sed -i "s|{title}|$SYS_NAME|g" install-extend.sql

sed -i "s|{url}|$URL|g" install-extend.sql

sed -i "s|{addDate}|$TODAY|g" install-extend.sql

sed -i "s|{product}|eduTrac Community System|g" eduTrac/Config/constants.php

sed -i "s|{company}|7 Media Web Solutions, LLC|g" eduTrac/Config/constants.php

sed -i "s|{version}|4.3|g" eduTrac/Config/constants.php

sed -i "s|{datenow}|$TODAY $HOUR|g" eduTrac/Config/constants.php

sed -i "s|{hostname}|$DBHOST|g" eduTrac/Config/constants.php

sed -i "s|{database}|$DBNAME|g" eduTrac/Config/constants.php

sed -i "s|{username}|$DBUSER|g" eduTrac/Config/constants.php

sed -i "s|{password}|$DBPASS|g" eduTrac/Config/constants.php

sed -i "s|{siteurl}|$URL|g" eduTrac/Config/constants.php

sed -i "s|{sitetitle}|$SYS_NAME|g" eduTrac/Config/constants.php

echo
echo "Installing Database Tables..."
echo

mysql -h $DBHOST -u $DBUSER -p$DBPASS $DBNAME < install-extend.sql

echo
echo "Deleting Files..."
echo

rm -rf install-extend.sql

echo
echo "Locking the installer..."
echo

touch eduTrac/Config/.installer.lock

echo
echo "Finished installing eduTrac"
echo

echo "+=================================================+"
echo "| eduTrac LINKS"
echo "+=================================================+"
echo "|"
echo "| Install URL: $URL"
echo "|"
echo "+=================================================+"
echo "| ADMIN ACCOUNT"
echo "+=================================================+"
echo "|"
echo "| Username: $ADMIN_USER"
echo "| Password: edutrac"
echo "|"
echo "+=================================================+"
echo "| DATABASE INFO"
echo "+=================================================+"
echo "|"
echo "| Database: $DBNAME"
echo "| Username: $DBUSER"
echo "| Password: $DBPASS"
echo "|"
echo "+=================================================+"
    
    exit
fi