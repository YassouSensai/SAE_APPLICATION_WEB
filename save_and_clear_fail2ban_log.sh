#!/bin/bash

#Chemin vers le fichier de log et le répertoire de destination
LOGFILE="/var/log/fail2ban.log"
DEST_DIR="/home/pisae/Documents/SAE_APPLICATION_WEB/csv"

#Création du répertoire de destination s'il n'existe pas
mkdir -p "$DEST_DIR"

#Format de la date pour nommer le fichier
DATE=$(date +'%Y-%m-%d%H-%M-%S')

#Nom du fichier CSV de destination
CSVFILE="$DEST_DIR/fail2ban$DATE.csv"

#Convertir le log en CSV (ajustez cette commande selon le format souhaité)
awk '{print $1","$2","$3","$4","$5","$6","$7","$8}' "$LOG_FILE" > "$CSV_FILE"

#Vider le fichier de log
#cat /dev/null > "$LOG_FILE"