![page_de_garde_PROBA.png](IMAGES%2Fpage_de_garde_PROBA.png)

1. [Introduction](#Introduction)
2. [Shiny](#Shiny)
3. [Choix du jeu de données](#Choix-du-jeu-de-données)
4. [Développement de l'application shiny](#Développement-de-l'application-shiny)
5. [Déploiement dans l'application web](#Deploiement-dans-l'application-web)
6. [Conclusion](#Conclusion)


# Introduction

Dans le cadre de la SAE du troisième semestre de BUT informatique qui a pour but de concevoir et de développer une plateforme de ticketing,
les questions que nous pouvons nous poser en tant qu'équipe de projet ou encore (éventuellement), en tant qu'organisation, sont multiples.
Ainsi, il est primordial de mener une étude de marché approfondie, s'appuyant sur des données ancrées dans la réalité. Cette étude vise à 
établir des statistiques et des probabilités, offrant ainsi une évaluation solide quant à la conformité de notre application avec les attentes prédéfinies.

# Shiny

Shiny est un framework du langage R intégré à l'IDE RStudio. Shiny constitue un cadre de développement qui facilite la création d'application web avec le langage de
programmation R. Son fonctionnement est simple et se base sur une structure modulaire qui divise les applications en deux composants ; L'interface utilisateur (UI) et le serveur (server).
Premièrement, l'UI définit l'interface utilisateur de l'application, c'est-à-dire, ce que les utilisateurs vont voir. Ensuite, le serveur gère ce qui se passe "derrière" l'application, en faisant
des calculs en réponse aux interactions de l'utilisateur.

Ces deux composants sont définie dans R à l'aide d'une syntaxe déclarative. L'UI inclut des éléments tels que les graphiques, les boutons, les panneaux et elle est structurée
à l'aide de la fonction ```fluidpage``` (dans notre cas, l'application comporte des panneaux latéraux). Le serveur gère les événements déclenchés par le biais de l'UI et exécute le code R. Dans notre cas,
le serveur spécifie les entrées (inputs) et les sorties (outputs) en définissant la fonction ```server```.

Les données qui sont traitées pour l'affichage des graphiques peuvent être multiples, notamment, on peut utiliser des bases de données MySQL et générer des fichiers au format csv directement à partir du code.
Dans notre cas, nous avons fait le choix d'utiliser directement des fichiers au format csv que nous avons généré par nous même.
Nous pouvons importer les fichiers de manière classique à l'aide de l'instruction ```read.csv``` pour ensuite alimenter les différentes visualisations et analyses statistiques de notre application.

Afin de visualiser ces différentes analyses à partir de l'interface utilisateur, nous pouvons utiliser la bibliothèque Plotly qui offre une dynamique visuelle à l'application. En effet, les diagrammes réalisés avec
la bibliothèque plotly permettent d'explorer les données de manière intuitive.
En réalité, plotly permet juste d'avoir de "meilleurs" graphiques qu'en utilisant plot qui fait partie du package de base de R. Effectivement, les diagrammes 
réalisés avec plotly offrent un très bon niveau d'interactivité, ce qui est idéal dans le cadre d'une application web, tandis que par défaut, plot ne supporte pas l'interactivité

### Installation de Shiny

Avant de commencer le développement de l'application avec shiny, il est essentiel d'installer les packages nécessaires. Ainsi, en utilisant la console R dans RStudio
ou encore, la ligne de commande R sur les raspberry, il faut utiliser les commandes suivantes :

```R
# Installer le package Shiny
install.packages("shiny")

# Installer le package Plotly
install.packages("plotly")

# Installer shinydashboard*
install.packages("shinydashboard
```

***(shinydashboard): Il s'agit d'une bibliothèque R qui facilite la création d'application web interactive avec un design de tableau de bord.***

Ensuite, il ne faut pas oublier de charger les packages au début du script de l'application Shiny en utilisant la fonction ```library()``` tel que ci-dessous :

```R
library(shiny)
library(plotly)
library(shinydashboard)
```

### Références aux sources de documentation

Cette phase d'étude de Shiny a jeté les bases nécessaires pour le développement réussi de l'application Shiny intégrée à notre plateforme de ticketing, offrant ainsi une interface 
interactive et une analyse statistique des données de manière transparente. Cette découverte de Shiny a été possible en consultant ces liens de documentation.

* [Shiny Basics - Posit](https://shiny.posit.co/r/getstarted/shiny-basics/lesson1/index.html)
* [Tutoriel Shiny - ESIEE](https://perso.esiee.fr/~courivad/R/fr-16-shiny.html)
* [Tutoriel Shiny - L. Rouviere](https://lrouviere.github.io/TUTO_VISU/shiny.html)




# Choix du jeu de données

Afin d'illustrer au mieux notre étude de marché, il est important de bien choisir les données qui seront traitées et analysées.
Ainsi, nous avons fait le choix de générer des données fictives au format csv car ce format se prête parfaitement à l'utilisation du langage R.

### Premier jeu de données : utilisateurs
Le premier jeu de données concerne les données utilisateurs. Le fichier csv regroupe des données importantes qui sont manipulées pour la création de compte 
et de tickets, mais aussi des données plus personnelles qui ne sont pas encore récupérée réellement dans l'application. Chaque ligne du fichier csv des utilisateurs correspond donc à un utilisateur 
avec comme données :
* L'identifiant
* Le nom
* Le prénom
* l'adresse mail
* l'âge
* La ville
* Le type d'utilisateur (professeur ou élève)

Le choix d'utiliser ces données est particulièrement pertinent, car il permet de réaliser des analyses statistiques pertinentes telles que la repartition 
entre professeurs et élève, la distribution des âges ou encore la répartition géographique des utilisateurs. Ce jeu de données permet également d'étudier certaines habitudes 
des utilisateurs comme leur boîte mail par exemple.

Voici un extrait du fichier csv : 

```csv
identifiant,nom_util,prenom_util,email_util,age,ville,type_util
utilisateur1,Doe,John,john.doe@example.com,28,Paris,Utilisateur
utilisateur2,Smith,Alice,alice.smith@example.com,35,Lyon,Professeur
utilisateur3,Johnson,Bob,bob.johnson@example.com,42,Marseille,Utilisateur
utilisateur4,Harris,Eva,eva.harris@example.com,30,Toulouse,Professeur
```

### Deuxième jeu de données : tickets
Le deuxième jeu de données concerne les tickets. Plus précisément, il s'agit d'un échantillon de "faux" tickets généré par les utilisateurs présent dans le premier
jeu de données. Ici, il s'agit des données telles qu'elles sont présentes dans la base de données lors de leur création à partir du tableau de bord des utilisateurs. 
Ce jeu de données regroupe donc : 
* L'identifiant
* L'objet
* La description
* La date de création
* L'adresse ip à partir de laquelle le ticket est créé
* La salle machine qui concerne le problème
* L'identifiant du créateur du ticket
* Le technicien en charge du ticket (s'il y en a un)
* Le status du ticket
* Le niveau d'urgence du ticket

Le choix d'utiliser ces données est là aussi pertinent et même logique. En effet, l'un de nos objectifs en tant qu'organisation qui va potentiellement régler les problèmes rencontrés
est de connaître la probabilité qu'un ticket de haute urgence soit créé, les postes qui sont souvent défaillants, mais aussi les utilisateurs qui rencontrent le plus de problèmes. Ce jeu de données 
nous permettra donc d'établir des probabilités afin de mieux anticiper les éventuels problèmes et de proposer un service optimal.

Voici un extrait du fichier csv :

```csv 
id_tic,objet,desc_pb_tic,date_crea_tic,adresse_ip,salle,createur_tic,tech_charge_tic,status_tic,nv_urgence_tic
1,Problème urgent,Problème technique urgent,2023-01-01,127.0.0.1,I21,utilisateur1,tech1,1,3
2,Problème sérieux,Problème sérieux à résoudre dans les plus brefs délais,2023-01-02,127.0.92.1,G25,utilisateur1,tech1,2,3
3,Petit problème,Problème pas très important,2023-01-03,127.92.0.1,G23,utilisateur1,tech2,3,3
4,Problème majeur,Problème majeur nécessitant une attention immédiate,2023-01-04,127.0.0.1,I21,utilisateur4,tech2,1,4
5,Problème mineur,Problème mineur à résoudre,2023-01-05,127.0.92.1,G25,utilisateur5,tech2,2,2
```

# Développement de l'application shiny

Contrairement au tutoriel shiny de L. Rouviere, nous avons fait le choix de tout coder dans le même fichier au lieu d'avoir un fichier ui.r et un fichier server.r.

Premièrement, notre interface utilisateur est définir d'une manière à ce que l'on puisse choisir ce que l'on veut visionner sur la colonne de gauche :

```R
ui <- fluidPage(
  titlePanel("Études de marché"),
  sidebarLayout(
    sidebarPanel(
      selectInput("vue", "Choisir une vue", choices = c("Données brutes", "Statistiques", "Probabilités")),
      conditionalPanel(
        condition = "input.vue == 'Données brutes'",
        selectInput("etude", "Choisir une étude", choices = c("Utilisateurs", "Tickets"))
      ),
      # Ajouter la section "Probabilités"
      conditionalPanel(
        condition = "input.vue == 'Probabilités'",
        selectInput("probabilites_etude", "Choisir une étude", choices = c("Utilisateurs", "Tickets"))
      )
    ),
    mainPanel(
      uiOutput("contenu"),
      # Ajouter l'espace pour afficher les probabilités dans le compartiment de droite
      uiOutput("probabilites_output")
    )
  )
)
```

On peut donc visionner soit les données brutes dans un tableau, soit l'analyse statistique sur les utilisateurs, ou encore les probabilités réalisées sur 
les tickets.

Lorsque l'on choisit l'une des options, le server prend le relais et fait les calculs nécessaires. Voici un extrait du code du serveur :

```R
server <- function(input, output) {

  # Définir le contenu de la section "Probabilités"
  output$probabilites_output <- renderUI({
    if (input$vue == "Probabilités") {
      return(textOutput("probabilite_text"))
    } else {
      return(NULL)
    }
  })

  output$probabilite_text <- renderText({
    if (input$probabilites_etude == "Utilisateurs") {
      # Calculer et afficher les probabilités liées aux utilisateurs
      prob_utilisateurs <- calculate_probabilites_utilisateurs()
      return(paste("Probabilités pour Utilisateurs : ", prob_utilisateurs))
    } else if (input$probabilites_etude == "Tickets") {
      # Calculer et afficher les probabilités liées aux tickets
      prob_tickets <- calculate_probabilites_tickets()
      return(paste("Probabilités pour Tickets : ", prob_tickets))
    }
  })
```

  
Le lancement de l'application se fait à la fin du script en exécutant la commande ```shinyApp``` de la manière suivante :

```R
shinyApp(ui, server)
```


Aperçu de la page statistique :  

![apercu_statistiques.png](IMAGES%2Fapercu_statistiques.png)

# Déploiement dans l'application web

L'intégration de l'application Shiny dans notre plateforme de ticketing nécessite l'installation de Shiny Server sur le raspberry. 
Shiny Server permet de déployer des applications Shiny sur un serveur web (dans notre cas, un serveur LAMP).

### Installation classique

Avant de pouvoir déployer l'application shiny sur notre application, il faut donc installer shiny server, ce qui est assez compliqué dans notre cas.
Mais voici la procédure d'installation : 

**Etape 1: mise à jour du système**

```bash
sudo apt-get update
sudo apt-get upgrade
```

**Etape 2: installation de shiny server**

Le problème réside dans cette partie. En effet, notre raspberry possède un processeur d'architecture ARM. Hors, aucune version officielle de shiny server 
n'est disponible pour ce type d'architecture ce qui fait que l'installation bloque à la dernière commande de cette étape. Le code source ne peut pas être interprété.

```bash
# Installation de R
sudo apt-get install r-base

# Installation de Shiny Server
sudo apt-get install gdebi-core
wget https://download3.rstudio.org/ubuntu-14.04/x86_64/shiny-server-1.5.16.958-amd64.deb
sudo gdebi shiny-server-1.5.16.958-amd64.deb
```

**Etape 3: Modifier le fichier de conf**  
Il faut ouvrir le fichier de conf situé à ```/etc/shiny-server/shiny-server.conf``` et rajouter les détails de configurations :  

```apacheconf
server {
  listen 3838; 
  location /shiny_app/applicationShiny {
    # Répertoire de l'application Shiny
    app_dir /chemin/vers/votre/application/shiny;
    # URL de base pour l'application
    base_url /shiny_app;
    # Options supplémentaires, le cas échéant
    options {
      # Par exemple, spécifier le répertoire des logs
      log_dir /var/log/shiny-server;
    }
  }
  # Autres configurations, le cas échéant
}
```


**Etape 4: Démarrage de Shiny Server**

```bash
sudo systemctl status shiny-server
```

***Note : en raison de l'incompatibilité de shiny server avec notre matériel, nous avons testé cette procédure sur une machine debian !***

### Une potentielle solution !

Pour faire face à ce problème d'architecture, une des solutions serait d'utiliser docker. En effet, un conteneur pour les architectures ARM est disponible sur 
github à l'adresse suivante : [ici](https://github.com/hvalev/shiny-server-arm-docker)  
  
La différence ici, c'est que les applications shiny doivent se trouver dans le repertoire situé à ```/shiny-server/apps```, tandis que pour l'autre,
les applications se situent dans ```/srv/shiny-server/apps```.

Il faut donc bien faire attentions aux url que nous rentrons lors de la redirection vers l'application shiny, en précisant bien le port d'écoute 3838. Par exemple :

```html
<a href="http://raspb07:3838/srv/shiny-server/apps/appkicationShiny">Application shiny</a>
```

ou encore, dans notre cas : 

```html
<a href="http://raspb07:3838/shiny-server/apps/appkicationShiny">Application shiny</a>
```


# Conclusion

En conclusion, le développement de notre application Shiny à permis d'offrir une interface interactive pour visualiser les données brutes, les statistiques sur les utilisateurs, et les probabilités liées aux tickets. 
Shiny est généralement choisi pour sa simplicité et son intégration avec R, tandis que l'utilisation de Plotly a amélioré la représentation visuelle des données.

Cependant, le déploiement sur Raspberry Pi a posé des défis en raison de l'architecture ARM. 
Une solution potentielle avec Docker a été explorée, mais des ajustements sont nécessaires. 
