![](images/CONCEPTION/page_de_garde_2.png)

# Sommaire
1. [Introduction](#Introduction)
   * Contexte
   * Analyse des besoins du client
   * Objectif
2. [Architecture générale](#Architecture-générale)
   * Schémas de l'architecture générale 
   * Explications
   


# Introduction 

>Ce dossier de conception présente les détails de la conception pour la SAE 
>du troisième semestre du BUT informatique. Le but de la SAE en question est de développer une plateforme 
>de ticketing interne pour les salles informatiques de l'IUT. Cette plateforme a été demandée par notre client, 
>M. Hoguin. La réalisation de cette plateforme est confiée à notre équipe de trois étudiants en deuxième 
>année de formation en informatique.

### Contexte

### Analyse des besoins du client

>L'analyse des besoins du client est une étape importante qui a été menée dans le cahier des charges et le recueil des besoins.
>Cette étape essentielle nous a permis de prendre connaissance des objectifs du client,
>d'identifier les spécificités, et de mettre en lumière les opportunités 
>d'amélioration. En analysant minutieusement les besoins de notre client, nous nous engageons à concevoir 
>une solution parfaitement adaptée aux attentes de notre client. En outre, cette analyse éclairée des besoins 
>nous a aidé à établir des exigences claires, à anticiper les risques et à optimiser l'utilisation 
>de nos ressources. En somme, l'analyse des besoins est le socle sur 
>lequel repose notre démarche de conception, nous guidant vers la réalisation d'une solution qui répondra 
>précisément aux attentes de notre client tout en maximisant l'efficacité du projet.
>  
>  
>Ce travail précédemment réalisé nous a donc permis de mettre en place le tableau ci-dessous qui regroupe les objets
>du problème, leurs états ainsi que leur comportement.

***Remarque : Ici, le domaine du problème est l'application web qui sera la future plateforme de ticketing.***

#### Tableau Objet/Etat/Comportement

<table>
  <tr>
    <th>Objet</th>
    <th>État</th>
    <th>Comportement</th>
  </tr>
  <tr>
    <td>Système informatique</td>
    <td>En développement</td>
    <td>Gestion des interactions avec les utilisateurs, gestion des tickets de dépannage, gestion des acteurs.</td>
  </tr>
  <tr>
    <td>Application web</td>
    <td>En développement</td>
    <td>Interface utilisateur en cours de création, gestion des tickets, gestion des utilisateurs (création de tickets, attribution, mise à jour), gestion des acteurs.</td>
  </tr>
  <tr>
    <td>Utilisateurs</td>
    <td>Actifs (divers rôles)</td>
    <td>Selon leur rôle, ils peuvent se connecter/déconnecter, créer des tickets, attribuer des tickets, gérer des tickets, gérer des comptes, s'inscrire.</td>
  </tr>
  <tr>
    <td>Tickets de dépannage</td>
    <td>Peuvent être en cours, résolus ou en attente</td>
    <td>Création de tickets, attribution à des techniciens, mise à jour de l'état, résolution, suivi de l'avancement.</td>
  </tr>
  <tr>
    <td>Administrateur Web</td>
    <td>Actif</td>
    <td>Gestion des statuts des tickets, gestion des libellés, gestion des niveaux d'urgence, gestion des utilisateurs.</td>
  </tr>
  <tr>
    <td>Techniciens</td>
    <td>Actifs</td>
    <td>Attribution de tickets, prise en charge des tickets, mise à jour des tickets.</td>
  </tr>
  <tr>
    <td>Utilisateur inscrit</td>
    <td>Actif</td>
    <td>Création de tickets, gestion de son propre compte.</td>
  </tr>
  <tr>
    <td>Visiteur</td>
    <td>Actif</td>
    <td>Inscription en tant qu'utilisateur inscrit, visionnage de la page d'accueil.</td>
  </tr>
  <tr>
    <td>Administrateur système</td>
    <td>Actif</td>
    <td>Accède aux journaux d'activités de l'application web.</td>
  </tr>
  <tr>
    <td>Base de données</td>
    <td>Opérationnelle</td>
    <td>Stockage des données relatives aux tickets, utilisateurs, ...</td>
  </tr>
  <tr>
    <td>Serveur APACHE</td>
    <td>Actif</td>
    <td>Hébergement de l'application web, de la base de données.</td>
  </tr>
  <tr>
    <td>Raspberry 4 (RPI4)</td>
    <td>Paramétré par le client</td>
    <td>Support du serveur</td>
  </tr>
  <tr>
    <td>Carte SD</td>
    <td>Stocke l'application</td>
    <td>Devra être insérée dans le RPI4</td>
  </tr>
  <tr>
    <td>Documentation</td>
    <td>En cours de création</td>
    <td>Explique le code, les utilisations, ...</td>
  </tr>
  <tr>
    <td>Normes de codage</td>
    <td>Pour les pages HTML/PHP et le CSS</td>
    <td></td>
  </tr>
  <tr>
    <td>Exigences d'accessibilité</td>
    <td>À respecter</td>
    <td></td>
  </tr>
  <tr>
    <td>Calendrier</td>
    <td>Estimation terminée</td>
    <td>Suivi du planning, gestion des échéances du projet.</td>
  </tr>
</table>


# Architecture générale

>L'architecture générale d'une application web constitue la structure organisationnelle déterminant l'ensemble 
des interactions entre les composants de l'application, dans le but de fournir une expérience utilisateur 
cohérente et opérationnelle. Elle englobe la conception des modules, leur disposition, leurs interrelations, 
ainsi que l'usage de technologies et de normes pour garantir le bon fonctionnement de l'application. 
L'objectif premier de cette architecture est d'assurer la solidité, la sécurité, la facilité de maintenance 
et la capacité d'évolution de l'application, tout en répondant aux besoins spécifiques des utilisateurs. 
Elle constitue le plan directeur qui oriente le développement de l'application web et qui assure la 
coordination de tous les éléments en vue de fournir une expérience utilisateur fluide et fiable.  

### Figure 1 : Shémas de l'architecture générale de l'application web

![architecture_generale.jpg](images%2FCONCEPTION%2Farchitecture_generale.jpg)

### Explications de la figure 1 et de l'architecture

>L'architecture repose sur un modèle client-serveur, et le client est l'utilisateur. 
Les utilisateurs interagissent avec l'application en envoyant des requêtes HTTP. Ces requêtes sont reçues 
et traitées par le serveur web Apache, qui utilise le langage de programmation PHP pour les exécuter. 
PHP communique avec la base de données MySQL pour stocker et récupérer des données.
>
>La base de données MySQL est au cœur de l'application, stockant des informations essentielles telles que 
les utilisateurs, les tickets de dépannage, les journaux d'activité, et plus encore. Parallèlement, 
le journal d'activité enregistre de manière exhaustive toutes les actions effectuées, fournissant un 
historique détaillé.
>
>La gestion des sessions est cruciale pour l'authentification et l'autorisation des utilisateurs, leur 
permettant de rester connectés et de maintenir leur état pendant leur interaction. Cette architecture 
garantit une gestion fluide des requêtes utilisateur, un stockage de données fiable et une sécurité 
renforcée.

