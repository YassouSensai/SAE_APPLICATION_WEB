![](images/DOCUMENTATIONS_SPECIFICATIONS/page_de_garde_4.png)

# Sommaire
1. [Introduction](#Introduction)
    * Contexte
    * Objectif
    * Contenu du dossier de spécifications
2. [Premier Cycle : Lancement et maquettes](#Premier-Cycle-:-Lancement-et-maquettes)
3. [Deuxième Cycle](#Deuxième-Cycle)
4. [Troisième Cycle](#Troisième-Cycle)
5. [Quatrième Cycle](#Quatrième-Cycle)

# Introduction

### Contexte

>Ce dossier de spécifications se concentre sur la création d'une plateforme de 
ticketing interne, qui constitue un projet essentiel au cours du semestre 3 de 
notre programme informatique. Ce projet requiert la collaboration de diverses 
ressources interdisciplinaires, couvrant des domaines allant du développement web à 
la gestion de projet, dans le but de mettre en place une solution complète pour 
notre institution.

### Objectif 

>L'objectif principal de ce projet consiste à élaborer et à mettre en place une 
application web en PHP et MySQL conçue pour gérer les requêtes de dépannage au sein 
des installations informatiques de notre institution. La finalité de cette plateforme 
de ticketing est d'optimiser et de rationaliser la gestion des incidents, avec pour 
résultat l'amélioration de l'efficacité du support informatique.

### Contenu du dossier de scpécifications

>Ce projet se divise en plusieurs cycles de vie distincts, suivant la méthodologie 
Scrum. Chaque cycle de vie durera environ 4 semaines et représente une itération du développement de la plateforme 
de ticketing, et ce dossier contient les spécifications détaillées pour chacun de 
ces cycles de vie. Chaque itération est conçue pour apporter des améliorations 
progressives à la plateforme, en réponse aux besoins changeants de nos utilisateurs 
et à l'évolution du projet dans son ensemble.

***Note : Pour chaque cycle de vie, il y aura les sous parties suivantes :***
1. **Détails :** La durée, le but du cycle selon ce qui a été décidé avec le client
2. **Exigences :** Les exigences fonctionnelles et non fonctionnelles pour ce cycle de vie.
3. **Cas d'utilisations :** Les cas d'utilisations qui doivent être implémenté pour la version définitive et qui seront implémenté durant ce cycle de vie
4. **Livrable :** Contenu et forme du livrable pour le cycle de vie.
5. **Bilan :** Une conclusion sur le travail fournit lors de la réalisation de ce cycle de vie.

***Remarque : Pour plus d'informations concernant les exigences et les cas d'utilisations, consultez les cahier des charges et le recueil des besoins [ici](#Cahier_Des_Charges_et_Recueil_Des_Besoins.md)***

# Premier Cycle : Lancement du projet et version minimaliste

### Détails

***Nom :*** Lancement du projet et Livraison des maquettes au client  
***Début :*** 25 septembre 2023  
***Fin :*** 22 octobre 2023  
***Livraison :*** 23 octobre 2023

>Ce premier cycle de vie, comme son nom l'indique, nous a permis de démarrer le projet
par la rédaction du cahier des charges et du recueil de besoins (document [ici](#Cahier_Des_Charges_et_Recueil_Des_Besoins)).
Ainsi, en accord avec le client, le but de ce premier cycle de vie est de fournir le site web statique ainsi que les maquettes correspondantes. Notre client choisira l'une des deux maquettes.
Nous fournirons également le travail de communication (sujet [ici](#documents/sujets/sujet_SAE3_communication.pdf)) .

### Exigences :
Durant ce premier cycle de vie, les principaux impératifs sont les suivants :
- Élaboration du cahier des charges pour énoncer les buts du projet.
- Rassemblement des besoins du client et des parties prenantes.
- Édification de maquettes web pour le site statique.
- Commencer le développement des pages html.

***Remarque : Afin d'avoir plus d'informations sur la conception, consultez le dossier de conception [ici](#Conception.md).***

### Cas d'Utilisation :
Ce cycle de vie s'est principalement caractérisé par le cas d'utilisation suivant :
#### Cas 1 : Visionnage du site
*(Il s'agit du cas 7 dans le recueil des besoins)*

**Portée :** Les clients  
**Niveau :** Objectif utilisateur  
**Acteur :** Visiteurs  
**Scénario :**
* Les visiteurs visionnent la page d'accueil
* Les visiteurs visionnent les pages pour le devoir de communication
* Les visiteurs visionnent la page d'authentification et d'inscription

### Livrable :
Le livrable à la fin du cycle de vie sera une archive de notre dépôt git. Les documents principaux qui concernent ce cycle sont :
1. Le code source du site statique dans le dossier ([HTML](..%2F..%2Fsrc%2FHTML))
2. Les maquettes web disponibles dans le dossier de conception ([Conception.md](Conception.md))
3. Le dossier de test ([Tests.md](Tests.md))
4. Le cahier des charges et le recueil des besoins ([Cahier_Des_Charges_et_Receuil_Des_Besoins.md](Cahier_Des_Charges_et_Receuil_Des_Besoins.md))
5. Le dossier de communication pour le devoir de communication ([dossier_de_communication.pdf](..%2Ftravaux%2Fdossier_de_communication.pdf))

### Bilan :
Ce premier cycle de vie s'est avéré fondamental pour établir les bases du projet. L'élaboration du cahier des charges et la collecte des besoins ont permis de définir clairement les objectifs du projet. La création de la page d'accueil et du volet communication a fourni une vitrine pour le projet, tandis que l'introduction de la page de connexion a permis de projeter les bases de l'authentification.

Il s'agit de la première itération de l'application web, qui sera développée davantage au cours des cycles de vie ultérieurs. Ce cycle de vie a jeté les fondements pour la suite du projet en fournissant une version minimale de l'application et en éclaircissant les besoins du client. Il nous permettra de progresser et d'ajouter des fonctionnalités au fur et à mesure que le projet avancera.


# Deuxième Cycle : Livraison d'une version minimaliste

### Détails

***Nom :*** Livraison de la première version de l'application (simplifiée)  
***Début :*** 23 octobre 2023  
***Fin :*** 20 novembre 2023  
***Livraison :*** 6 et 21 novembre 2023

>Ce deuxième cycle nous permettra de démarrer le développement de l'application en implémentant certains cas d'utilisations.
> Il nous permettra également de préparer le seul livrable matériel nécessaire pour notre client.

### Exigences :
Durant ce deuxième cycle de vie, les principales exigences sont les suivantes :
- Faire toutes les installations sur la carte sd.
- Concevoir la base de données.
- Finir le développement des pages HTML. (*Remarque : ici, finir veut dire que si des modifications doivent être apportées, ces modifications pourront être faites*)
- Commencer le développement des pages PHP.

***Remarque : Afin d'avoir plus d'informations sur la conception, consultez le dossier de conception [ici](#Conception.md).***

### Cas d'Utilisation :
Ce cycle de vie s'est caractérisé par les scénarios d'utilisation suivants :

#### Cas 1 : Inscription sur l'application
*(Il s'agit du cas 4 du recueil des besoins)*

**Portée :** Les clients  
**Niveau :** Objectif utilisateur  
**Acteur :** Utilisateur inscrit, techniciens, administrateur web et administrateur système  
**Scénario :**
* Les acteurs accèdent à la page de connexion
* Les acteurs entrent leurs identifiants
* Les acteurs accèdent à leur profil

#### Cas 2 : Authentification à l'application
*(Il s'agit du cas 6 du recueil des besoins)*

**Portée :** Les clients  
**Niveau :** Objectif stratégique  
**Acteur :** Visiteurs
**Scénario :**
* Les visiteurs accèdent au formulaire d'inscription
* Les visiteurs entrent leurs informations
* Les visiteurs valident le formulaire
* Les visiteurs peuvent maintenant se connecter



### Livrable :
#### Livrable 1 : 6 novembre
Le premier livrable sera la carte SD qui contiendra :
* L'OS du Raspberry PI
* Le serveur APACHE et MySQL
* La documentation nécessaire

#### Livrable 2 : 21 novembre
Le livrable final de ce cycle de vie sera de rendre la version 1.2 de l'application avec les cas d'utilisation implémentés.


### Bilan :

## ***A compléter !!!***

# Troisième Cycle

  




