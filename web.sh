#!/bin/bash
if [ $# -ne 2 ]; then
    echo "Erreur, il doit y avoir 2 paramètres"
    exit 1
fi

if cat /etc/passwd | cut -d: -f1 | grep -q $1 > /dev/null;then
    echo "Utilisateur déjà présent dans le système"
    exit 1
fi

# Création de l'utilisateur
useradd -m "$1"

# Génération d'un mot de passe et affectation à l'utilisateur
echo "$1:$1" | sudo chpasswd

# Génération du fichier de configuration Nginx
sed -e "s/MYUSERNAME/$1/" -e "s/MYDOMAIN/$2/" /etc/nginx/templateSite > /etc/nginx/sites-enabled/$2

# Partie MySQL
# Création de la base de données
mysql -e "CREATE DATABASE $1;"
# Création de l'utilisateur MySQL
mysql -e "CREATE USER '$1'@'localhost' IDENTIFIED BY '$1';"

# Attribution des droits d'accès à la base de données pour l'utilisateur MySQL
mysql -e "GRANT ALL PRIVILEGES ON $1.* TO '$1'@'localhost';"
#!/bin/bash
adduser -m "$1"
sed -e 's/MYUSERNAME/$1/' -e 's/MYDOMAIN/$2/' template > /etc/nginx/sites-enabled/$2