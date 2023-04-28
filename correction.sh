#!/bin/bash
mysql -e "CREATE DATABASE $1;"
# Créer l'utilisateur
mysql -e "CREATE USER '$1'@'localhost' IDENTIFIED BY '$1';"
# Affecter les droits :
mysql -e "GRANT ALL PRIVILEGES ON $1.* TO '$1'@'localhost';"