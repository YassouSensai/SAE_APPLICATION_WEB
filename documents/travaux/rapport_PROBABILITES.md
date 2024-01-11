![page_de_garde_PROBA.png](IMAGES%2Fpage_de_garde_PROBA.png)


1. [Introduction](#Introduction)
2. [Shiny](#Shiny)
3. [Choix du jeu de données](#Choix-du-jeu-de-données)
4. [Développement de l'application shiny](#Développement-de-l'application-shiny)
5. [Déploiement dans l'application web](#Deploiement-dans-pplication-web)
6. [Conclusion](#Conclusion)


# Introduction

Dans le cadre de la SAE du troisième semestre de BUT informatique qui a pour but de concevoir et de développer une plateforme de ticketing,
les questions que nous pouvons nous poser en tant qu'équipe de projet ou encore (éventuellement), en tant qu'organisation, sont multiples.
Ainsi, il est primordial de mener une étude de marché approfondie, s'appuyant sur des données ancrées dans la réalité. Cette étude vise à 
établir des statistiques et des probabilités, offrant ainsi une évaluation solide quant à la conformité de notre application avec les attentes prédéfinies.

# Shiny


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