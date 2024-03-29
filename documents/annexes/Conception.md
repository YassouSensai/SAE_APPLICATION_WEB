![](images/CONCEPTION/page_de_garde_2.png)

# Sommaire
1. [Introduction](#Introduction)
   * Contexte
   * Analyse des besoins du client
2. [Architecture générale](#Architecture-générale)
   * Figure 1 : Schémas de l'architecture générale 
   * Explications
3. [Site web statique](#Site-web-statique)
   * But
   * Maquettes web
   * DOM page d'accueil
4. [Base de données](#Base-de-données)
   * Conception
   * Développement
   * Explications avec exemples
5. [Raspberry PI 4](#Raspberry-PI-4)
   * Description
   * Fonctionnement 
   * Carte SD 
   * UML composantes connecteurs
6. [Site web dynamique](#Site-web-dynamique)
   * Adaptation du site statique
   * Langages de programmation
   * Sécurité
   * Gestion des erreurs
   * Gestion des sessions
   * Profil & Tableau de bord 
   * Journal d'activité
   * Rappel sur les cas d'utilisation
   * Maquettes web
   * UML composantes connecteurs
7. [Déploiement serveur](#Déploiement-serveur)
   * Explications
   * Diagramme UML
8. [Annexes](#Annexes)
   * Maquettes web
   


# Introduction

### Contexte
>Ce dossier de conception présente les détails de la conception pour la SAE 
>du troisième semestre du BUT informatique. Le but de la SAE en question est de développer une plateforme 
>de ticketing interne pour les salles informatiques de l'IUT. Cette plateforme a été demandée par notre client, 
>M. Hoguin. La réalisation de cette plateforme est confiée à notre équipe de trois étudiants en deuxième 
>année de formation en informatique.

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
Les utilisateurs interagissent avec l'application en envoyant des requêtes HTTP. Ces requêtes seront reçues 
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


# Site web statique
### But

>L'interface utilisateur, dans le cadre du projet de plateforme de ticketing interne, a pour 
rôle de créer une expérience conviviale et interactive pour tous les utilisateurs, qu'ils 
soient administrateurs, techniciens, utilisateurs inscrits ou visiteurs. En résumé, elle 
permet de simplifier la soumission des demandes de dépannage, la gestion des requêtes, 
la supervision administrative, le travail des techniciens, l'accès aux informations pour 
les visiteurs, ainsi que la mise à disposition de ressources explicatives. Elle joue un 
rôle central pour garantir que le processus de ticketing interne soit efficace, transparent 
et accessible à tous les utilisateurs.

***Important : Pour le site web, il a été jugé inutile de fournir un diagramme UML. Néanmoins, il sera fait et disponible avant le développement du site web dynamique***  

***Note : Vous pouvez consulter les tests d'acceptation dans le dossier de test ([Tests.md](Tests.md))***

### Maquettes web
***Note : Toutes les maquettes web sont réalisées avec le logiciel en ligne lucidspark.***

>**Page d'accueil :** Le rôle principal de la page d'accueil dans le contexte de la plateforme de 
ticketing interne est de fournir aux utilisateurs des informations essentielles sur le fonctionnement
de l'application et de les orienter vers les actions qu'ils peuvent entreprendre. En bref, la 
page d'accueil vise à :  
>* Expliquer le service
>* Faciliter la navigation
>* Promouvoir la vidéo de démonstration
>* Offrir un accès aux ressources
>* Présenter l'application
>  
> La page d'accueil se doit donc d'être informative et conviviale, mais aussi, elle doit être axée sur l'action.
![page_accueil.jpeg](images%2FCONCEPTION%2FMaquettes_WEB%2Fpage_accueil.jpeg)

>**Page de connexion :** La page de connexion, bien qu'étant un formulaire simple, est très importante pour l'application.
En effet, celle-ci permettra aux utilisateurs d'accéder à leur profil et ils ne devront rencontrer aucun problème !
![connexion.jpeg](images%2FCONCEPTION%2FMaquettes_WEB%2Fconnexion.jpeg)  

***Note : Afin de consulter les maquettes des pages web pour la communication, veuillez consulter ce [fichier](images%2FCONCEPTION%2FMaquettes_WEB%2Ffichier_maquettes_web.pdf) qui comporte toutes les maquettes au fur et à mesures qu'elles seront réalisées.***  

### DOM page d'accueil
>Le Document Object Model (DOM) d'une page HTML joue un rôle essentiel en permettant d'interagir de manière 
dynamique avec le contenu web. Il représente la structure de la page sous forme d'une hiérarchie d'objets 
qui sont accessibles par des langages de programmation tels que JavaScript. Le DOM offre la possibilité de 
manipuler et de modifier le contenu, les styles et les interactions de la page en temps réel. Cette 
fonctionnalité se révèle particulièrement précieuse pour la création de sites web interactifs, la gestion 
des événements utilisateur, l'ajout ou la suppression d'éléments, la mise à jour de données sans nécessiter 
de rechargement de la page, entre autres. En résumé, le DOM agit comme une interface entre le code et le 
contenu HTML, permettant de créer des expériences utilisateur dynamiques et réactives sur le web.
>
>Voici le DOM de la page d'accueil : 
![arbre_DOM_page_acceuil.png](images%2FCONCEPTION%2FMaquettes_WEB%2Farbre_DOM_page_acceuil.png)

***Note : Plus tard, si nous avons le temps, le(s) DOM(s) pourra(ont) être réalisé grâce au langage JavaScript***

# Base de données

### Conception

>La phase de conception de la base de données joue un rôle central dans la gestion des différents utilisateurs, 
tickets et leurs status. Ainsi, plusieurs entités sont envisagées pour modéliser les données 
clés. Parmi celles-ci, on retrouve typiquement les entités Utilisateur, Ticket et StatutTicket. 
Ces entités sont inter-reliées pour assurer un suivi cohérent des informations.
>
> Cette phase de conception débute évidemment par la création d'un schéma entités/associations qui modélise la base de données. 
>
>![shemas_bd.png](images%2FCONCEPTION%2Fshemas_bd.png)

### Développement

>Le développement de la base de données se traduit par la création effective des tables et des 
relations entre ces entités. Lé développement sera effectué grâce au langage de requêtes SQL 
afin d'être effectif sur le serveur de bases de données MySQL. Ces requêtes permettent de 
mettre en place la structure de la base de données en définissant les clés primaires, 
les clés étrangères, ainsi que les différents attributs et types de données.

### Exemples 

> Dans cette section, vous pouvez visionner quelques exemples de requêtes qui pourront être utilisées 
dans le cadre de l'application web.

```SQL
-- On insère des utilisateurs fictifs dans la table Utilisateur
INSERT INTO Utilisateur (id_util, nom_util, prenom_util, email_util, mdp_util, type_util) VALUES
(1, 'Doe', 'John', 'john.doe@example.com', 'motdepasse1', 'Utilisateur'),
(2, 'Smith', 'Alice', 'alice.smith@example.com', 'motdepasse2', 'Utilisateur'),
(3, 'Johnson', 'Bob', 'bob.johnson@example.com', 'motdepasse3', 'Utilisateur');

-- On insère des faux tickets dans la table Ticket
INSERT INTO Ticket (id_tic, desc_pb_tic, createur_tic, tech_charge_tic, status_tic, nv_urgence_tic, date_maj_tic)
VALUES (1, 'Problème 1', 1, 1, 1, 3, CURRENT_DATE),
       (2, 'Problème 2', 2, 2, 1, 2, CURRENT_DATE),
       (3, 'Problème 3', 3, 1, 3, 1, CURRENT_DATE);
```

***Ainsi, par exemple, si l'on souhaite sélectionner tous les tickets ouvets par l'utilisateur Smith Alice ; On exécutera la requête suivante :***

```SQL
SELECT T.id_tickets, T.desc_pb_tic
FROM Ticket T
JOIN Utilisateur U ON T.createur_ti = U.id_util
WHERE nom_util = 'Smith' AND prenom_util = 'Alice';
```

# Raspberry PI 4

***Note : Vous pouvez consulter le rapport pour la configuration du Raspberry PI 4 [ici](..%2Ftravaux%2Frapport_RPI.md).***

### Description 

>Le Raspberry Pi 4 est un micro-ordinateur monocarte de 
> la fondation Raspberry Pi. Dans notre SAE, il joue un rôle central, 
> car il offre une plateforme matérielle compacte et polyvalente pour 
> héberger notre application web et donc notre site. Mais pourquoi e Raspberry Pi 4? 
> En effet cela constitue une solution puissante pour des applications diverses,
> ainsi il fonctionne comme un serveur dédié, exécutant le système 
> d'exploitation Raspberry Pi OS, un serveur web Apache, 
> et le système de gestion de bases de données MariaDB. 
> 
> Sa configuration spécifique, notamment le système d'exploitation, 
> le serveur web, la base de données, et le code source de 
> l'application, est chargé sur une carte SD fournie par nos professeurs. 
> Cette carte SD, insérée dans le Raspberry Pi 4, 
> permet à notre équipe d'accéder de manière sécurisée à l'appareil 
> via un tunnel SSH, ce qui simplifie les mises à jour et 
> les maintenances de l'application. 
> C'est donc un outil économe 
> en énergie et le taille, offrant une solution
> efficace et économique pour le déploiement d'applications web, 
> tout en facilitant la gestion à distance de notre système.

### Fonctionnement

>Nous fournirons une carte SD préparée pour être insérée dans le Raspberry Pi 4. Une fois la carte SD installée, notre équipe aura un accès sécurisé via un tunnel SSH (Secure Shell) pour effectuer des mises à jour du code source directement depuis les machines de l'IUT. Cette configuration permet une gestion aisée de l'application et garantit que les dernières mises à jour et améliorations peuvent être appliquées en toute simplicité. Notre objectif est de simplifier le processus d'installation et de maintenance de l'application, offrant ainsi une expérience agréable à notre client.

### Carte SD

>Pour ce projet, il nous a donc été demandé de fournir une carte SD qui contiendra les éléments suivants :
>1. **Raspberry PI OS :** Le système d'exploitation
>2. **APACHE :** Le serveur WEB qui permettra de démarrer l'application
>3. **MariaDB :** Le serveur de bases de données
>4. **Le code source :** Afin de pouvoir avoir démarrer l'application
>5. **Git :** L'outil de versionnage et de collaboration qui nous permet de développer l'application, et qui nous permettra de mettre à jour l'application.

***Note : La carte SD sera insérée dans un Raspberry PI 4 par M. Hoguin qui nous fournira l'adresse IP correspondante. ce qui nous permettra de se connecter grâce au tunnel ssh, et ainsi, mettre le code source de l'application à jour.***

### UML composantes connecteur

![uml_pi.mdj.png](images%2FCONCEPTION%2FUML%2Fuml_pi.mdj.png)

# Site web dynamique 

### Adaptation du site statique

> Le passage d'un site statique à un site web dynamique peut être décrit comme 
une évolution significative dans la manière dont le contenu est généré sur un site web,
affiché, et interagi avec les utilisateurs qui l'utilisent.
Ainsi, on peut donc proposer les éléments clés à prendre en compte dans ce passage (ou évolution) :
>
> Pour rendre notre site statique dynamique, nous allons effectuer plusieures actions cruciales. Tout d'abord les pages HTML vont être converties en fichiers PHP, permettant une gestion plus flexible du contenu. De plus, nous allons scinder les composants principaux tels que l'en-tête (entete.html), le profil (profil.html), et le pied de page(pied.html) du site statique en HTML. Ces composants vont être désormais inclus dynamiquement dans les pages PHP correspondantes.


### Langages de Programmation :

>#### PHP (Hypertext Preprocessor) :
> PHP est un langage de script côté serveur conçu pour le développement web,
notamment pour les sites statiques dans notre cas. Son utilisation principale est la
génération de contenu dynamique, le traitement des formulaires, la gestion des sessions,
ainsi que l'interaction avec les bases de données.
>
>**Utilisation SAE :**
Dans notre projet, PHP est souvent combiné avec le code HTML pour créer des pages web dynamiques. Les balises `<?php ... ?>` permettent d'exécuter du code côté serveur, contrairement à HTML qui ne le permet pas. Pour cette SAE, les bases de données les plus adaptées sont MySQLi ou PDO, car car c'est les seules qu'on a vu cette année en PHP.

>#### SQL (Structured Query Language) :
>SQL est un langage de requête utilisé pour interagir avec les bases de données relationnelles.
>
>**Utilisation SAE :**
Aujourd'hui, énormément de professionnels utilisent SQL pour créer et gérer des bases de
données en créant la base entièrement et en la chargeant de données ensuite. Ainsi pour
notre SAE, on a défini complètement la base en commençant par : la structure des tables,
ensuite l'ajout des données, et par la suite les tests tels que des opérations de base dans
les langages tels que SELECT, INSERT, UPDATE, et DELETE. Ces étapes sont donc cruciales pour
le bon fonctionnement et la bonne vérification de la base de données.

>#### HTML (Hypertext Markup Language) :
>HTML est le langage de balisage standard pour structurer et présenter le contenu sur le web.
>
>**Utilisation SAE :**
HTML est souvent combiné avec d'autres langages tels que PHP pour créer des pages
dynamiques. Dans notre projet, son association avec PHP permet de générer du contenu
dynamique côté serveur. De plus, HTML est compatible avec CSS pour le style et JavaScript
pour l'interactivité, offrant ainsi une expérience utilisateur beaucoup plus riche.

>#### CSS (Cascading Style Sheets) :
>CSS est un langage de style utilisé pour définir la présentation d'un document HTML.
>
>**Utilisation SAE :**
Les professionnels utilisent CSS pour créer des styles visuels et l'esthétique sur les pages
web. Donc dans le contexte des besoins et de la SAE, le CSS est un élément indispensable,
car il permet : la gestion des couleurs, des polices, des tailles de texte et de la mise en
page globale. Ainsi cela assure une présentation cohérente et attrayante sur divers appareils,
et est essentiel pour l'expérience utilisateur.


### Sécurité : 

>La sécurité est un élément essentiel dans le développement d'une application web qui doit concerner tout les porjets.
>
>En plus de la gestion des sessions qui va être décrite plus tard, nous allons mettre en place des mesures de sécurité 
supplémentaires pour protéger notre site contre les attaques par injection SQL par exemple, 
donc en utilisant des requêtes préparées, nous allons favoriser une interaction sécurisée avec la base de données, 
réduisant ainsi le risque d'injections malveillantes.


***Voici un exemple de requête préparée en PHP :***
```PHP
// par exemple, pour une requête de sélection de l'identifiant et du mot de passe.
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$query = "SELECT * FROM ".$table_user." WHERE identifiant = ? AND mdp = ?";

$prep = mysqli_prepare($connexion, $query);
mysqli_stmt_bind_param($prep, 'ss', $username, $password);
mysqli_stmt_execute($prep);

$resultat = mysqli_stmt_get_result($prep);
```

>De plus, l'intégration de captchas dans nos formulaires d'authentification (connexion.php et inscription.php) comme demandé par M.Hoguin, 
va permettre de renforcer la sécurité en empêchant les tentatives d'accès automatisées par des programmes extérieurs. 
Les captchas vont donc ajouter une deuxième couche de vérification, 
assurant que les actions sont entreprises par des utilisateurs réels et pas des robots automatisés.


### Gestion des erreurs

>Pour fournir une meilleure expérience utilisateur en termes de compréhension et utilisation, nous avons pensé à créer des messages d'erreur, 
afin de gérer et afficher les erreurs en utilisant le langage JavaScript.
>
>En effet, en cas d'erreur que ce soit d'inscription ou de connexion, des messages clairs et compréhensibles s'afficheront. 
Cependant, nous créerons également des messages qui indiquent si l'utilisateur a saisi des 
informations incorrectes, de mauvaise manière ou même s'il a réussi de s'inscrire par exemple.
>
>Pour plus de confidentialité, ces messages d'erreur seront génériques, ce qui évitera de divulguer tout détail sensible comme des noms de tables.


### Gestion des sessions

>#### Pages connexion.php et inscription.php :
>**Connexion (connexion.php) :**
Lorsqu'un utilisateur saisit ses identifiants (pseudo et mot de passe) et soumet le formulaire, le script PHP (action_connexion.php) vérifie ces informations dans la base de données.
>En cas de : 
>1. **Succès** : une session est démarrée avec la création d'une variable de session 'utilisateur' contenant le pseudo de l'utilisateur et il est redirigé vers son profil.
>2. **Echec** : l'utilisateur est redirigé vers la page de connexion avec un message d'erreur.
>
>**Inscription (inscription.php) :**
Lorsqu'un nouvel utilisateur remplit le formulaire d'inscription, le script PHP (action_inscription.php) vérifie la validité des données et les insère dans la base de données.
>En cas de :
>1. **Succès** : une session est démarrée avec la création d'une variable de session contenant le nouveau pseudo créé, et l'utilisateur est redirigé vers son profil.
>2. **Échec** : l'utilisateur est informé de l'erreur.

>#### Page utilisateur.php :
>Cette page sera la page d'arrivée des utilisateurs qui se connectent et sera utilisé comme page de profil, 
qu'ils soient administrateurs, techiniciens ou même simple utilisateur.
>
>En fonction du type d'utilisateur, des liens d'accès différents seront présents sur cette page. 

>#### Communication client / serveur :
> 
>La communication client/serveur dans notre application web se déroulera à 
travers le protocole HTTP classique. 
> 
>Lorsque l'utilisateur effectue des actions, 
telles que se connecter ou modifier son profil, le navigateur va envoyer des 
requêtes sur notre serveur. 
> 
>Ainsi du côté du serveur, des fichiers, souvent écrits en PHP, 
recevront ces requêtes, interagissent avec la base de données s'il le faut, et vont générer 
des réponses au format HTML. Ces réponses sont renvoyées au client, où le 
navigateur les interprète pour afficher le contenu sur le site. 
> 
>Enfin, de cette manière quand on utilisera le site de la SAE, les informations seront échangées de manière fluide entre le navigateur et notre serveur. Par exemple, lorsque quelqu'un modifiera le profil, les changements seront effectués sans avoir à recharger toute la page. 

***Note : HTTP (Hypertext Transfer Protocol), est l'ensemble des règles permettant de transférer des fichiers tels que du texte, des images, du son, de la vidéo et d'autres fichiers multimédias sur le Web notamment les sites internet.***


### Profil & Tableau de bord :

>La conception du profil utilisateur et du tableau de bord constitue également une étape très importante dans le développement d'une application,
>car cela permet de fournir aux utilisateurs un accès facile aux informations et aux fonctionnalités essentielles de la base de données et le site.
>
>Ces éléments sont donc très importants pour offrir une bonne expérience utilisateur.

#### Tableau de bord :

>Le tableau de bord est une interface très intéressante dans le cadre de notre SAE, étant 
donné que notre site est un site de ticketing interne, il offre un aperçu synthétique des 
activités et des données importantes. Il peut inclure des widgets dynamiques, 
des graphiques et des résumés pour permettre à l'utilisateur de suivre rapidement les 
informations pertinentes.
>
>La conception du profil et du tableau de bord se constitue autour de principes d'utilisabilité,
de facilité de navigation et de personnalisation, garantissant ainsi une expérience 
utilisateur fluide et intuitive.
> 
>Ainsi, le tableau de bord va inclure 3 fichiers : admin_sys.php, admin_web.php et 
technicien.php, qui sont consultables par les administrateurs systèmes, administrateurs 
web et techniciens (plus celui des utilisateurs).
>
>Les actions effectuées par les administrateurs systèmes, administrateurs web et 
techniciens seront gérées via des pages actions qui leur seront attribué (1 page action 
pour chacun).


### Journal d'activité

>Le journal d'activité est un composant clé dans le suivi des actions effectuées 
au sein de la plateforme de ticketing interne. Il enregistre différentes activités, 
offrant ainsi une trace chronologique des événements sur le site WEB. 
Le journal vise à garantir la traçabilité de différents données (status,quantité etc..) et actions,
des opérations effectuées par les différents utilisateurs de notre site.

#### Données récoltées :

>Les données que contient notre journal sont les suivantes : 
>
>1. **Date :** La date à laquelle l'activité a été enregistrée dans le journal.
>
>2. **Adresse IP :** L'adresse IP associée à l'utilisateur.
>
>(à virer peut etre)
>
>3. **Utilisateur :** Identifiant de l'utilisateur qui a initié l'activité.
>
>4. **Nature de l'Activité :** Description détaillée de l'action réalisée, que ce soit la création d'un ticket, la modification d'un profil, l'attribution d'un ticket à un technicien, etc.
>
>5. **Niveau d'Urgence (pour les tickets) :** Lorsqu'un ticket est créé ou modifié, le niveau d'urgence associé à ce ticket est enregistré.

***Note : Les données récoltées seront stockées dans une table probablement JournalActivite de notre base de données.***

#### Objectif du journal :

>En effet, sur un site Web, un tel journal d'activité permet d'améliorer : 
>- **La Traçabilité :** donc suivre chaque action effectuée dans l'application.
>- **L'Audit :** donc la vérification et l'audit des activités pour des raisons de sécurité et de conformité.
>- **La Détection d'Anomalies :** donc repérer des schémas inhabituels ou des activités suspectes sur le site.
>- **Les Statistiques :** donc des données pour des analyses statistiques (par ex : les connexions réussies et infructueuses).

### Rappel sur les cas d'utilisation :

#### Utilisateurs :
>Une fois inscrit, l'utilisateur connecté peut :
>* Soumettre une demande de dépannage (ouvrir un ticket).
>* Accéder à son tableau de bord pour voir la liste des tickets publiés et leur état.
>* Accéder à son profil pour changer son mot de passe.

#### Administrateurs Web :
>Une fois connecté, l'administrateur web peut ou doit :
>* Doit pouvoir gérer la liste des libellés attribués aux différents problèmes.
>* Il pourra définir les statuts des tickets (ouvert, en cours de traitement, fermé).
>* Il pourra définir les niveaux d'urgence attribués aux tickets.
>* Il pourra créer les comptes des techniciens et affecter les tickets ouverts à un technicien.

#### Administrateurs Systèmes :
>Une fois connecté, l'administrateur système peut ou doit :
>* Doit pouvoir acceder aux journaux d'activité de l'application web.
>
>Remarques : Chaque validation d'un ticket par un utilisateur est enregistrée dans un journal d'activité (contient : les infos des tickets). 

#### Techniciens :
>Une fois connecté, le technicien peut ou doit :
> Les techniciens peuvent s'attribuer des tickets et changer leur état.
> Ils peuvent également mettre à jour les tickets qui leur sont attribués.

### Maquettes web

>Avant de développer les pages web en PHP, des maquettes supplémentaires ont été réalisées. Notamment la plus importante,
la maquette de la page utilisateur.php (profil utilisateur) : 
>
>![utilisateur.png](images%2FCONCEPTION%2FMaquettes_WEB%2Futilisateur.png)


***Note : Les autres maquettes seront faites et proposées au client ultérieurement***

***Note : Vous pouvez consulter les autres maquettes web sur ce [fichier](images%2FCONCEPTION%2FMaquettes_WEB%2Ffichier_maquettes_web.pdf).***

***Note : Vous pouvez consulter les tests d'acceptation dans le dossier de test ([Tests.md](Tests.md))***



### UML composantes connecteurs 

>Le diagramme UML (Unified Modeling Language) est un outil visuel utilisé en développement logiciel pour représenter 
graphiquement la structure et les interactions d'un système. 
En effet, c'est un outil très intéressant et surtout très important, car il facilite la compréhension, la conception, la documentation, 
et la communication au sein du groupe et surtout nous permet de mieux comprendre et comment mieux réaliser notre site dynamique.
>
>Puisque c'est un outil de conception, il comprendra des éléments tels que les classes, les relations, les méthodes, et autres,
pour représenter la structure et le fonctionnement du système.

L'UML pour concevoir notre site :

![UML_détaille_app_web.png](images%2FCONCEPTION%2FUML%2FUML_d%E9taille_app_web.png)

***Note : Vous pouvez consulter le UML sur ce [fichier](images%2FCONCEPTION%2FUML%2FUML_fonc_siteWEB.mdj) qu'il faut ouvrir avec starUML***


# Déploiement serveur

>Le processus de déploiement du serveur pour notre SAE joue un rôle important pour garantir la disponibilité et la performance de l'application. Les étapes ci-dessous détaillent le déploiement sur un Raspberry Pi 4 (RPi4).

### Etapes définies pour le déploiement :
#### Configuration du Serveur

>1. **Préparation de la carte SD :**
>  - Premièrement installation du système d'exploitation sur la carte SD du RPi4.
>  - Configuration des services nécessaires, y compris Apache pour le serveur web et MySQL pour la base de données.
>
>2. **Configuration Réseau :**
>  - Configuration du réseau pour permettre l'accès à distance au serveur.
>  - Configuration du pare-feu pour autoriser les connexions entrantes et sortantes.
>  - Configuration du serveur pour permettre l'accès à distance via un tunnel SSH.

#### Installation des Services

>1. **Base de Données :**
>  - création de la base de données sur le serveur en utilisant le script SQL fourni.
>  - Accord des privilèges appropriés.
>
>2. **Serveur Web :**
>  - Configurez Apache pour héberger l'application web.
>  - S'assurer de la bonne configuration du serveur pour PHP.
>
>3. **Services Additionnels :**
>  - Installation des autres services requis, tels que des bibliothèques ou des dépendances spécifiques à l'application.

#### Spécifications du Serveur 

>1. **Spécifications Logicielles :**
> - Système d'Exploitation : Raspberry Pi OS
> - Serveur Web : Apache pour héberger l'application.
> - Base de Données : MariaDB pour stocker et gérer les données de l'application.
> - Langage de Programmation : PHP pour le développement d'applications web dynamiques.
> - Services Additionnels :
Fail2Ban pour la protection contre les attaques par force brute.

***Note : fail2ban est expliqué dans la partie explications.***
>3. **Sécurité et Authentification :**
Accès à Distance :
Utilisation d'un tunnel SSH pour un accès distant sécurisé.
Configuration du pare-feu pour limiter l'accès aux seules connexions nécessaires.
Authentification :
Mise en place de méthodes d'authentification sécurisées, telles que l'utilisation de clés SSH.
Gestion des droits d'accès et des privilèges pour assurer une sécurité appropriée.

#### Les mises à jour

>Dans le cadre de notre SAE, les mise à jour de notre plateforme en lien avec le serveur Raspberry PI 4 c'est important également, pour assurer la validité,la sécurité et la performance continues de votre serveur. Les mises à jour peuvent être déclenchées par des améliorations significatives apportées au dépôt Git du projet comme par des amélioration du système.

>Mises à Jour du Système :
>
>Les mises à jour du système sont effectué que dans le besoin urgents
,notamment celles système d'exploitation en utilisant les commandes système appropriées, telles que "sudo apt" update et "sudo apt upgrade".
>
>Services Applicatifs (Apache, MariaDB, PHP) :
>
>De la même manière que pour le système, on procede au suivi régulier des versions des services utilisés dans le déploiement.
>
>Fail2Ban :
>
>On doit également surveiller des mises à jour de Fail2Ban et application des nouvelles versions de manière proactive. De plus on doit proceder aux
révisions régulières de la configuration de Fail2Ban pour s'assurer qu'elle reste adaptée aux dernières menaces de sécurité.
>
>Dépôt Git :
>
>Toute amélioration significative du projet est d'abord effectuée dans le dépôt Git.
Utilisation de branches pour le développement de fonctionnalités et de correctifs.
Fusion régulière des branches de développement dans la branche principale (habituellement main ou master).
Ensuite le projet est mis à jour sur le rasberry.



### Explications

>Fail2Ban est un service open source conçu pour renforcer la sécurité d'un serveur en protégeant contre les attaques de force brute dans un système. Il vise principalement à protéger des services tels que SSH, FTP, et d'autres protocoles qui peuvent être victimes des attaques.
>
>Généralement le service Fail2Ban fonctionne de manière suivante:
>
>1. Il surveille des journaux d'activité : Fail2Ban surveille les logs files, qui enregistrent tout ce qui concerne les connexions (tentatives, tentatives infructueses, et d'autres événements liés à la sécurité).
>
>2. Il Détecte de motifs suspects : Il recherche de motifs spécifiques indiquant des tentatives d'authentification infructueuses ou d'autres activités suspectes.
>
>3. Il bloque les adresses IP : En effet,  Fail2Ban prend des mesures automatiques pour bloquer l'adresse IP qui sont à l'origine de l'activité malveillante (pare-feu).
>
>4. Il dure le blocage : En effet, Fail2Ban propose généralement un mécanisme temporaire pour le blocage, donc cela signifie que l'adresse IP n'est pas bloquée indéfiniment, mais seulement pour une période temporaire (décourage les attaques tout en minimisant les risques de blocage accidentel des IP innocentes).

### Diagramme UML

L'UML pour le déploiement de notre serveur :
![uml_deploiment.png](images%2FCONCEPTION%2FUML%2FUML_deploiment_serveur.png)

***Note : Vous pouvez également consulter le UML en .mdj sur ce [fichier](images%2FCONCEPTION%2FUML%2FUML_deploiment_serveur.mdj) ***

# Conclusion

>En conclusion, le déploiement du serveur pour notre SAE sur un Raspberry Pi 4 (RPi4) constitue une étape cruciale dans la réalisation d'une plateforme robuste et performante pour notre projet. Les différentes phases, de la configuration initiale à la maintenance continue, seront soigneusement élaborées pour garantir la stabilité, la sécurité et la disponibilité de notre application.
>
>La configuration du serveur, depuis la préparation de la carte SD jusqu'à la mise en place des services essentiels tels qu'Apache et MySQL, fait objet d'un minutieux détaillage pour assurer un environnement propice au bon fonctionnement de notre SAE. Les spécifications logicielles du Raspberry Pi 4 offre un cadre solide pour notre application, exploitant pleinement ses capacités tout en garantissant une connectivité fiable.
>
>Ensuite, la sécurité occupe une place centrale dans cette partie, avec des mesures telles que l'utilisation d'un tunnel SSH, la configuration du pare-feu et la mise en place de méthodes d'authentification robustes. L'intégration de Fail2Ban renforce davantage cette sécurité en protégeant contre les attaques de force brute, contribuant ainsi à la préservation de l'intégrité du serveur.
>
>En effet, le serveur subi des mises à jour régulières du système, des services applicatifs, et de Fail2Ban. L'utilisation d'un dépôt Git facilite le suivi des améliorations du projet, assurant une gestion efficace des versions et la mise à jour cohérente du Raspberry Pi 4.
>
>Enfin, le diagramme UML offre une représentation visuelle de l'ensemble du processus de déploiement. 