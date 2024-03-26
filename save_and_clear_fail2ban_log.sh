#!/bin/bash

# Chemin vers le répertoire de destination en effet
DEST_DIR="/home/pisae/Documents/SAE_APPLICATION_WEB/csv"

# Création du répertoire de destination s'il n'existe pas
mkdir -p "$DEST_DIR"

# Format de la date pour nommer le fichier
DATE=$(date +'%Y-%m-%d_%H-%M-%S')

# Nom du fichier ZIP de destination
ZIPFILE="$DEST_DIR/csv_backup_$DATE.zip" # Correction: Utilisation de la variable $DEST_DIR correctement

# Compresser tous les fichiers CSV existants dans le répertoire csv
zip -j "$ZIPFILE" "$DEST_DIR"/*.csv # Correction: Chemin correct pour matcher les fichiers CSV

# Supprimer les fichiers CSV après compression
rm "$DEST_DIR"/*.csv # Correction: Chemin correct pour matcher et supprimer les fichiers CSV

# Nom du nouveau fichier CSV
CSVFILE="$DEST_DIR/ip_banned_$DATE.csv" # Ajouté underscore pour la cohérence

# Exécuter la commande et sauvegarder le résultat dans le nouveau fichier CSV
sudo fail2ban-client status sshd > "$CSVFILE"
