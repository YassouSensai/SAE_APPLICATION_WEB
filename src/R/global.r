# global.r
library(shiny)

# Chargement des données des fichiers csv pour l'étude de marché (données fictives)
utilisateurs <- read.csv("donnees/etude_utilisateurs.csv")
tickets <- read.csv("donnees/etude_tickets.csv")
