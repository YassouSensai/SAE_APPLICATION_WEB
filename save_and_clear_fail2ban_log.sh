#!/bin/bash

#Chemin vers le répertoire de destination
DEST_DIR="/home/pisae/Documents/SAE_APPLICATION_WEB/csv"

#Création du répertoire de destination s'il n'existe pas
mkdir -p "$DEST_DIR"

#Format de la date pour nommer le fichier
DATE=$(date +'%Y-%m-%d%H-%M-%S')

#Nom du fichier ZIP de destination
ZIPFILE="$DESTDIR/csv_backup$DATE.zip"

#Compresser tous les fichiers CSV existants dans le répertoire csv
zip -j "$ZIPFILE" "$DESTDIR"/.csv

#Supprimer les fichiers CSV après compression
rm "$DEST_DIR"/.csv

#Nom du nouveau fichier CSV
CSVFILE="$DEST_DIR/ip_banned$DATE.csv"

#Exécuter la commande et sauvegarder le résultat dans le nouveau fichier CSV
sudo fail2ban-client status sshd > "$CSVFILE"