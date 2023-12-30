![](images/DOCUMENTATIONS_SPECIFICATIONS/page_de_garde_4.png)

# Sommaire
1. [Introduction](#Introduction)
    * Contexte
    * Objectif
    * Contenu du dossier de spécifications
2. [Premier Cycle : Lancement et maquettes](#Premier-Cycle-:-Lancement-et-maquettes)
3. [Deuxième Cycle : Livraison d'une version minimaliste](#Deuxième-Cycle-:-Livraison-d'une-version-minimaliste)
4. [Troisième Cycle : Terminons la conception](#Troisième-Cycle-:-Terminons-la-conception)
5. [Quatrième Cycle : Version finale](#Quatrième-Cycle-:-Version-finale)

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

***Nom :*** Lancement du projet et Livraison du site statique
***Début :*** 25 septembre 2023  
***Fin :*** 22 octobre 2023  
***Livraison :*** 23 octobre 2023

>Ce premier cycle de vie, comme son nom l'indique, nous a permis de démarrer le projet
par la rédaction du cahier des charges et du recueil de besoins (document [ici](#Cahier_Des_Charges_et_Recueil_Des_Besoins)).
Ainsi, en accord avec le client, le but de ce premier cycle de vie est de fournir le site web statique ainsi que les maquettes correspondantes.
Nous fournirons également le travail de communication (sujet [ici](#documents/sujets/sujet_SAE3_communication.pdf)) .

### Exigences :
Durant ce premier cycle de vie, les principaux impératifs sont les suivants :
- Élaboration du cahier des charges pour énoncer les buts du projet.
- Rassemblement des besoins du client et des parties prenantes.
- Édification de maquettes web pour le site statique.
- Commencer le développement des pages html.

***Remarque : Afin d'avoir plus d'informations sur la conception, consultez le dossier de conception [ici](#Conception.md).***

### Cas d'Utilisation :
Ce cycle de vie est principalement caractérisé par le cas d'utilisation suivant :

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

***Nom :*** Livraison de la deuxième version de l'application.  
***Début :*** 23 octobre 2023  
***Fin :*** 12 novembre 2023 (+1 semaine de retard)
***Livraison :*** 13 novembre 2023 (20/11/2023)

>Ce deuxième cycle nous permettra de démarrer le développement de l'application en implémentant certains cas d'utilisations.
> Il nous permettra également de préparer le seul livrable matériel nécessaire pour notre client.

### Exigences :
Durant ce deuxième cycle de vie, les principales exigences sont les suivantes :
- Faire toutes les installations sur la carte sd.
- Concevoir et commencer le développement de la base de données.
- Finir le développement des pages HTML. (*Remarque : ici, finir veut dire que si des modifications doivent être apportées, ces modifications pourront être faites*)
- Commencer le développement des pages PHP.

***Remarque : Afin d'avoir plus d'informations sur la conception, consultez le dossier de conception [ici](#Conception.md).***

### Cas d'Utilisation :
Ce cycle de vie est caractérisé par les scénarios d'utilisation suivants :

#### Cas 1 : Authentification à l'application
*(Il s'agit du cas 4 du recueil des besoins)*

**Portée :** Les clients  
**Niveau :** Objectif utilisateur  
**Acteur :** Utilisateur inscrit, techniciens, administrateur web et administrateur système  
**Scénario :**
* Les acteurs accèdent à la page de connexion
* Les acteurs entrent leurs identifiants
* Les acteurs accèdent à leur profil

#### Cas 2 : Inscription sur l'application
*(Il s'agit du cas 6 du recueil des besoins)*

**Portée :** Les clients  
**Niveau :** Objectif stratégique  
**Acteur :** Visiteurs
**Scénario :**
* Les visiteurs accèdent au formulaire d'inscription
* Les visiteurs entrent leurs informations
* Les visiteurs valident le formulaire
* Les visiteurs peuvent maintenant se connecter



### Livrable : 13 novembre
Le livrable sera la carte SD qui contiendra :
* L'OS du Raspberry PI
* Le serveur APACHE et MySQL
* La documentation nécessaire

Ainsi que la version 2 de l'application avec les cas d'utilisation implémentés.

### Bilan :
Malgré le retard accumulé, ce cycle de vie nous a permis de proposer une deuxième version de l'application web, complète, 
avec toutes les composantes de l'application. La première version de la base de données permet aux utilisateurs de se connecter et de s'inscrire 
via les formulaires présents sur le site (sans sécurisation pour le moment). Les utilisateurs peuvent maintenant visionner leurs informations personnelles
sur leur profil.

Cette version de l'application (maintenant hébergée sur le Raspberry PI 4) est une base solide qui permettra d'implémenter les derniers cas d'utilisations durant le troisième cycle de vie.


# Troisième Cycle : Terminons la conception 

### Détails

***Nom :*** Livraison de la troisième version de l'application.  
***Début :*** 20 novembre 2023
***Fin :*** 21 décembre 2023  
***Livraison :*** Pas de livrable

>L'objectif de ce troisième cycle de vie est de parachever les cas d'utilisations manquants afin de livrer 
>une troisième version de l'application web. En effet, nous commencerons le développement des cas d'utilisations manquants
>et proposerons une version qui se rapproche le plus possible de la version définitive.

### Exigences

Durant ce troisième cycle de vie, les principales exigences sont les suivantes :
- Terminer la conception de l'application.
- Terminer le développement de la base de données.
- Développer les pages php pour l'implémentation des cas d'utilisations.

### Cas d'utilisations

Ce cycle de vie ne se caractérise par aucun cas d'utilisation. Plus précisément, il vient poser
les bases de développement des cas d'utilisations qui seront développé dans le quatrième et dernier cycle de vie.


### Bilan :
Durant ce cycle de vie, nous avons respecté les exigences déterminées au début du cycle. La base de données est développée et les pages php sont débutées 
ce qui nous permet d'implémenter les derniers cas d'utilisation. Les utilisateurs peuvent même modifier leur profil ainsi que leur mot de passe.

Egalement, la conception de l'application est terminée, il ne manque plus qu'à rajouter le diagramme de déploiement serveur dans le dossier de conception. 
Ce cycle de vie nous a permis d'avancer dans le développement de l'application et finir la conception de celle-ci.




# Quatrième Cycle : Version finale

### Détails

***Nom :*** Version finale de l'application.  
***Début :*** 30 décembre 2023
***Fin :*** 16 janvier 2024 
***Livraison :*** 17 janvier 2024


### Exigences :
Durant ce quatrième et dernier cycle de vie, les principales exigences sont les suivantes :
- Implémenter les derniers cas d'utilisations.
- Préparer la soutenance du mercredi 17 janvier 2024


### Cas d'utilisations
Ce cycle de vie se caractérise par les scénarios d'utilisations suivants :  
*(Pour plus d'informations, consultez le recueil des besoins [ici](Cahier_Des_Charges_et_Receuil_Des_Besoins.md))*

#### Cas 1 : Visualisation des tickets ouverts
*(Il s'agit du cas 3 du recueil des besoins)*

**Portée :** Administrateur web  
**Niveau :** Objectif sous-fonction  
**Acteur :** Administrateur web  
**Scénario :** Une fois connecté, l'administrateur web peut visualiser toutes les informations concernant les tickets.

#### Cas 2 : Création de techniciens
*(Il s'agit du cas 2 du recueil des besoins)*

**Portée :** Administrateur web  
**Niveau :** Objectif stratégique 
**Acteur :** Administrateur web  
**Scénario :** Une fois connecté, l'administrateur web peut créer un nouveau technicien.

#### Cas 3 : Gestion des tickets
*(Il s'agit du cas 1 du recueil des besoins)*

**Portée :** Techniciens, Administrateur web  
**Niveau :** Objectif stratégique  
**Acteur :** Techniciens, Administrateur web  
**Scénario :** 
* Une fois connecté, l'administrateur web peut attribuer un ticket à un technicien.
* Une fois connecté, les techniciens peuvent prendre en charge les tickets, résoudre les problèmes et mettre à jour le statut des tickets.

#### Cas 4 : Création de tickets
*(Il s'agit du cas 5 du recueil des besoins)*

**Portée :** Client  
**Niveau :** Objectif sous-fonction
**Acteur :** Client 
**Scénario :** Une fois connecté, un client peut ouvrir un ticket pour signaler un problème.

#### Cas 5 : Visionnage des journaux d'activités 
*(Il s'agit du cas 8 du recueil des besoins)*

**Portée :** Administrateur système  
**Niveau :** Objectif sous-fonction
**Acteur :** Administrateur système  
**Scénario :** Une fois connecté, l'administrateur système peut visionner les connexions/inscriptions sur l'application, les créations de tickets, mais aussi les résolutions des problèmes et les prises en charges des tickets. 


### Livrable : 16 janvier 2024
Le livrable à la fin du cycle de vie sera la troisième version de l'application
qui contiendra les cas d'utilisations implémentés. Il s'agira de la version "finale" de l'application. 

# Bilan :

## ***A compléter !!!***


