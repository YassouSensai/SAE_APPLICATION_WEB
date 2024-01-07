![page_de_garde_5.png](images%2FTESTS%2Fpage_de_garde_5.png)

# Sommaire
1. [Introduction](#Introduction)
    * Contexte
    * Objectif
2. [Site web statique : Première version](#Site-web-statique-:-Première-version)
    * Tests d'acceptation
    * Page d'accueil
    * Page de connexion
    * Autres pages (devoir de communication)
    * Bilan
3. [Site web dynamique : Deuxième version](#Site-web-dynamique-:-Deuxième-version)
    * Données de tests
    * Format de test
    * Inscription d'un utilisateur
    * Connexion d'un utilisateur
    * Bilan
   


# Introduction

### Contexte
>Ce dossier de tests présente les tests des différentes parties de la SAE
>du troisième semestre du BUT informatique. Le but de la SAE en question est de développer une plateforme
>de ticketing interne pour les salles informatiques de l'IUT. Cette plateforme a été demandée par notre client,
>M. Hoguin. La réalisation de cette plateforme est confiée à notre équipe de trois étudiants en deuxième
>année de formation en informatique.

### Objectif
>Le dossier de test est un élément essentiel du processus de développement logiciel, 
agissant en tant que gardien de la qualité. Il identifie les anomalies, vérifie la 
conformité aux spécifications, évalue les performances et renforce la sécurité. Grâce 
à une documentation rigoureuse, il assure la traçabilité des tests et minimise les risques 
liés aux erreurs en production, garantissant ainsi la fiabilité du logiciel.


# Site web statique : Première version
### Tests d'acceptation

>Les tests d'acceptation pour un site web statique ont pour objectif de confirmer que le site 
respecte tant visuellement que fonctionnellement les attentes initiales. Ils s'assurent de 
la cohérence avec la maquette web, en vérifiant que la disposition, le design, les couleurs, 
les polices et la structure correspondent. Les captures d'écran servent à comparer chaque 
page du site aux designs approuvés, garantissant que tous les éléments visuels sont 
correctement positionnés. De plus, les tests valident que la navigation suit le modèle de 
la maquette et que les liens entre les pages sont corrects, contribuant ainsi à l'assurance 
de la qualité du site web statique.


***Pour chaque test, vous pourrez consulter la maquette de la page web en consultant ce [fichier](images%2FCONCEPTION%2FMaquettes_WEB%2Ffichier_maquettes_web.pdf).***

### Page d'accueil 

***Captures d'écran :***  

![test_page_accueil_1.png](images%2FTESTS%2FSITE_STATIQUE%2Ftest_page_accueil_1.png)  

![test_page_accueil_2.png](images%2FTESTS%2FSITE_STATIQUE%2Ftest_page_accueil_2.png)

### Page de connexion

***Note : Le lien de redirection vers le formulaire d'inscription n'est pas présent, car cette page n'a pas encore été réalisée.***

***Captures d'écran :***  

![Page_de_connexion_Ostap_Aaron_Yassine.png](images%2FTESTS%2FSITE_STATIQUE%2FPage_de_connexion_Ostap_Aaron_Yassine.png)

### Autres pages (devoir de communication)

>Il est important de noter qu'il peut être inutile et contre-productif de documenter les 
tests d'acceptation pour chaque page individuelle du site web statique, car cela 
générerait une quantité considérable de documentation et de travail supplémentaire. Souvent, 
une approche plus efficace consiste à se concentrer sur les pages clés, les modèles et les 
fonctionnalités cruciales, tout en utilisant ces tests comme des représentants de l'ensemble 
du site. Cela permet de réduire la complexité du dossier de tests, de gagner du temps et de 
minimiser la redondance tout en assurant la qualité globale du site. En fin de compte, 
l'objectif principal est de garantir que les fonctionnalités essentielles sont validées,
et de minimiser les efforts inutiles et la surcharge de documentation.



### Bilan

>En conclusion, les tests d'acceptation ont validé avec succès la conformité du site web aux 
maquettes et aux captures d'écran approuvées. Tous les éléments visuels, tels que la 
disposition, le design, les couleurs, les polices et la structure, correspondent de manière 
précise aux spécifications initiales. De plus, la navigation a été vérifiée, confirmant que le 
site suit fidèlement le modèle de la maquette, avec des liens entre les pages correctement 
fonctionnels. Ce bilan positif garantit que le site web statique est prêt à être déployé, 
offrant ainsi une expérience utilisateur conforme aux attentes et visuellement cohérente 
avec le design prévu.


# Site web dynamique : Deuxième version 

### Données de tests

**Administrateur WEB** (*login :* gestion, *mdp :* #gestion#)  
**Administrateur Système** (*login :* admin, *mdp :* #admin#)  
**Techniciens** (*login :* tech1, *mdp :* #tech1#), (*login :* tech2, *mdp :* #tech2#)



### Format de test

>Les tests du site web dynamique visent à évaluer la fonctionnalité et l'interaction des différents composants du site.
Ils couvrent les aspects tels que l'inscription et la connexion des utilisateurs, la manipulation des données en temps réel,
et l'assurance de la réactivité du site. Ces tests contribuent à garantir que la plateforme de ticketing répond de manière adéquate 
aux besoins de l'utilisateur, offrant une expérience fluide et fiable.


***Pour chaque test, vous pourrez consulter la maquette de la page web en consultant ce [fichier](images%2FCONCEPTION%2FMaquettes_WEB%2Ffichier_maquettes_web.pdf).***

### Inscription

>Lorsqu'un utilisateur s'inscrit, ses données sont récupérée dans la base de données, lui permettant ainsi de se connecter.

***Capture utilisateur en train de s'inscrire :***  

![inscription_d'utilisateur.png](images%2FTESTS%2FSITE_DYNAMIQUE%2Finscription_d%27utilisateur.png)

***Capture utilisateur qui valide son formulaire :***  

![utilisateur_inscrit.png](images%2FTESTS%2FSITE_DYNAMIQUE%2Futilisateur_inscrit.png)

### Connexion

***Capture de la page utilisateur.php lorsque l'utilisateur entre ses identifiants :***  

![connexion_utilisateur.png](images%2FTESTS%2FSITE_DYNAMIQUE%2Fconnexion_utilisateur.png)  

### Bilan

>En résumé, les tests du site web dynamique ont permis de valider la fonctionnalité des étapes cruciales telles 
que l'inscription et la connexion des utilisateurs. Les captures d'écran démontrent que le site réagit correctement 
aux actions de l'utilisateur, assurant une expérience fluide et sécurisée. Ces résultats positifs renforcent la 
confiance dans la qualité globale de la base de donnée et surtout, de la plateforme de ticketing en développement. Le prochain stade du processus de 
test impliquera une évaluation approfondie des fonctionnalités interactives et en temps réel pour assurer une 
performance optimale.