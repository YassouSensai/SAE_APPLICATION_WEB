![](images/DOCUMENTATIONS_SPECIFICATIONS/page_de_garde_3.png)

# Sommaire 
1. [Introduction](#Introduction)
    * Contexte
    * But
    * Utilisation sur un environnement classique (ex : XAMP)
    * Utilisation sur le Raspberry PI 4
2. [Site web statique](#Site-web-statique)
    * Explications
    * Structure du site
    * Description des pages
    * Bilan
3. [Deuxième version](#Deuxième-version)
    * Explications
    * Dynamisation du site web statique
    * Implémentations
    * Bilan
4. [Version finale](#Version-finale)


## 1. Introduction

### Contexte

>La documentation du projet est un élément essentiel pour comprendre, utiliser et maintenir 
notre Plateforme de Ticketing Interne. Elle offre une vue d'ensemble complète du système, de 
son architecture et de ses fonctionnalités. Ce document est destiné aux membres de l'équipe de 
développement, aux administrateurs système, aux techniciens, ainsi qu'aux utilisateurs finaux, 
afin de faciliter l'utilisation et la gestion de la plateforme.

### But

>Le but de cette documentation est de fournir des informations détaillées sur la conception, 
la mise en œuvre et l'utilisation de la Plateforme de Ticketing Interne. Vous y trouverez des 
instructions sur l'installation du système, des guides d'utilisation, des descriptions des 
fonctionnalités et des informations sur la maintenance. Cette documentation a pour objectif 
de faciliter la prise en main du logiciel, d'assurer sa stabilité et de garantir une expérience 
utilisateur optimale.

### Utilisation sur un environnement classique (ex : XAMPP)

1. **Clonage du Dépôt Git :** Pour accéder au code source et aux fichiers du site, commencez par cloner le dépôt Git associé à ce projet. Utilisez la commande suivante dans votre terminal (ou seulement le lien dans votre IDE) :

**git clone https://github.com/YassouSensai/SAE_APPLICATION_WEB.git**

2. **Configuration de l'Environnement :** Assurez-vous que vous disposez de l'environnement nécessaire, y compris PHP, MySQL et un serveur web tel qu'Apache (**Vous pouvez très bien utiliser le logiciel XAMPP**). Suivez les instructions de configuration spécifiques à votre système. ***(Au besoin, un manuel sera mis à votre disposition)***

3. **Chargement de la base de données :** Il faut également charger la base de données si ce n'est pas encore fait. Pour XAMPP, accédez à phpMyAdmin et exécutez ce [script](..%2F..%2Fsrc%2FSQL%2Fbase_de_donnees.sql). 

4. **Création d'un accès à l'application :** Pour simplifier l'accès à l'application, créez un Alias nommé "start" pour démarrer le serveur Apache et accéder directement à l'application depuis votre navigateur. Pour cela, modifiez le fichier de configuration d'Apache ("httpd.conf" situé dans le dossier de configuration de XAMPP XAMPP/apache/conf) et ajoutez l'Alias suivant :

```apache
Alias /start "chemin_vers_le_dossier_de_votre_application"
<Directory "chemin_vers_le_dossier_de_votre_application">
    Options Indexes
    Require all granted
</Directory>
```
Il vous suffit de lancer la page index.html s'il s'agit de la première version, index.php s'il s'agit de la version 2 ou postérieure.

4. **Navigation sur le Site :** Explorez les fonctionnalités du site statique en cliquant sur tous les liens et/ou logos.

### Utilisation sur le Raspberry PI 4

1. **Insertion de la carte SD :** Premièrement, il faut insérer la carte SD dans le Raspberry PI 4 au niveau de l'emplacement prévu. Dans cette carte sd, le serveur APACHE et MariaDb(mysql) ainsi que PHP et l'application sont déjà installé sur la carte SD. Il y a également le logiciel git d'installé et un tunnel ssh configuré.

2. **Vérification des services :** Avant d'essayer de lancer l'application, vérifiez que les services sont bien actifs. Ainsi, il faut éxécuter les commandes suivantes :

```shell
systemctl restart apache2;
systemctl restart mysql;
```

Ensuite, vérifiez :

```shell
systemctl status apache2;
systemctl status mysql;
```

3. **Chargement de la base de données :** Il faut également charger la base de données si ce n'est pas encore fait. Entrez dans la ligne de commande MySQL (```mysql -u root```), puis exécutez ce [script](..%2F..%2Fsrc%2FSQL%2Fbase_de_donnees.sql).

4. **Lancement de l'application :** Sur le Raspberry PI 4, l'accès à l'applicationa déjà été configuré.

   - **Directement sur firefox via interface graphique :** Dans la barre de recherche, entrez : *localhost/start*
   - **Depuis une machine de l'IUT :**
        * Connectez-vous au RPI : ```ssh admin@adresse_IP```, un mot de passe vous sera demandé (*!pisae!*)
        * Dans lla barre de recherche du navigateur de la machine de l'IUT, entrez : http://raspb07/start

5. **Navigation sur le Site :** Explorez les fonctionnalités du site statique en cliquant sur tous les liens et/ou logos.


>Pour des instructions plus détaillées sur chaque étape, consultez les sections pertinentes de cette documentation. Que vous soyez un utilisateur, un administrateur ou un membre de l'équipe de développement, cette documentation vous guidera tout au long du processus.
Elle sera donc mis à jour à chaque fin de cycle.

# Site web statique 
***Note : Il s'agit de la première version de l'application. Les données énoncées pourront être modifiées au cours des prochains cycle de vies.***

### Explications
>Afin de mieux connaître les spécifications pour le site web statique, consultez le dossier de spécification ([Specifications.md](Specifications.md))
dans la partie #Premier cycle. Consultez également le dossier de conception ([Conception.md](Conception.md)) dans la partie #Site web statique.
>Vous pourrez aussi visionner le DOM de la page d'accueil.

### Structure du site
Le projet du site web statique se compose de plusieurs pages HTML qui sont liées entre elles. Voici une vue d'ensemble de la structure du projet :

1. `index.html`: Page d'accueil du site.
2. `logo1.html`: Page dédiée à la présentation du logo 1.
3. `logo2.html`: Page dédiée à la présentation du logo 2.
4. `chartegraphique.html`: Page expliquant la charte graphique du site.
5. `connexion.html`: Page de connexion pour les utilisateurs.
6. `css_site_statique.css`: Fichier CSS pour la mise en page et le style du site.
7. `images/`: Dossier contenant les images utilisées sur le site.

### Description des Pages
#### Page d'Accueil (`index.html`)
La page d'accueil est la première page que les visiteurs voient lorsqu'ils accèdent au site. Elle présente une brève introduction au groupe et à l'objectif du site.

#### Page Logo 1 (`logo1.html`)
Cette page est dédiée à la présentation du premier logo. Elle explique les éléments graphiques du logo, les couleurs, et leur signification. De plus, elle détaille l'outil utilisé pour la création du logo.

#### Page Logo 2 (`logo2.html`)
De manière similaire à la page Logo 1, cette page présente le deuxième logo du groupe. Elle explique les éléments graphiques du logo, les couleurs, et leur signification, ainsi que l'outil utilisé pour la création.

#### Page Charte Graphique (`chartegraphique.html`)
La page de la charte graphique détaille les choix de conception pour le site, y compris les couleurs, la typographie, les images, et la mise en page. Elle met en évidence l'importance de maintenir une identité visuelle cohérente.

#### Page de Connexion (`connexion.html`)
La page de connexion permet aux utilisateurs de se connecter à leur compte. Elle comprend un formulaire pour entrer le pseudo et le mot de passe.


### Bilan
Cette documentation fournit un aperçu complet du site web statique, y compris sa structure, sa conception, et les technologies utilisées. Elle peut servir de référence pour la maintenance et les futures mises à jour du site.

# Deuxième version

### Explications 

>Afin de mieux connaître les spécifications pour la deuxième version, consultez le dossier de spécification ([Specifications.md](Specifications.md))
dans la partie (#Deuxième Cycle : Livraison d'une version minimaliste). Consultez également le dossier de conception ([Conception.md](Conception.md)) dans les parties #Base de données, #Raspberry PI 4
et #Site web dynamique

### Dynamisation du site web statique
La dynamisation du site web statique est passée par plusieurs étapes. 

* **Etape 1 :**

La première étape était de mettre en évidence des parties communes à toutes les pages web. Ainsi, nous avons mis en évidence :
   * [entete_general.html](..%2F..%2Fsrc%2FHTML%2Fentete_general.html) : L'entête commun à toutes les pages HTML du site statique
   * [pied.html](..%2F..%2Fsrc%2FHTML%2Fpied.html) : Le pied de page commun à toutes les pages HTML du site statique, mais également à toutes les pages web PHP.

* **Etape 2 :**

La deuxième étape était de transformer les pages html du site statique en pages php. Maintenant, nous avons :

   * [index.php](..%2F..%2Fsrc%2FPHP%2Findex.php) : Page d'accueil du site.
   * [logo1.php](..%2F..%2Fsrc%2FPHP%2Flogo1.php) : Page dédiée à la présentation du logo 1.
   * [logo2.php](..%2F..%2Fsrc%2FPHP%2Flogo2.php) : Page dédiée à la présentation du logo 2.
   * [chartegraphique.php](..%2F..%2Fsrc%2FPHP%2Fchartegraphique.php) : Page expliquant la charte graphique du site.
   * [connexion.php](..%2F..%2Fsrc%2FPHP%2FAuthentification%2Fconnexion.php) : Page de connexion pour les utilisateurs.

***Note : Toutes ces pages sont relié à l'entête et au pied de page.***

* **Etape 3 :**

La dernière étape était de concevoir et de développer les autres pages nécessaires à la deuxième version de l'application (voir [Specifications.md](Specifications.md) et section suivante)

### Implémentations

Cette deuxième version est celle qui a nécessité le plus de création de pages web. Elle a également nécessité la création de la base de données ainsi que la configuration du Raspberry PI 4.  

* **[Authentification](..%2F..%2Fsrc%2FPHP%2FAuthentification) : (*pages reliée au pied de page*)**
   * [inscription.php](..%2F..%2Fsrc%2FPHP%2FAuthentification%2Finscription.php) : La page qui permet aux futurs utilisateurs de l'application de s'inscrire.
   * [deconnexion.php](..%2F..%2Fsrc%2FPHP%2FAuthentification%2Fdeconnexion.php) : Le script PHP qui est relié à chaque profil d'utilisateur et qui permet de fermer une session.
   * [action_connexion.php](..%2F..%2Fsrc%2FPHP%2FAuthentification%2Faction_connexion.php) : Le script PHP qui est relié à la page de connexion et qui permet à un utilisateur de se connecter et d'arriver sur son profil.
   * [action_inscription.php](..%2F..%2Fsrc%2FPHP%2FAuthentification%2Faction_inscription.php) : Le script PHP qui est relié à la page d'inscription et qui permet de créer un compte dans la base de données.

* **[PagesUtilisateur](..%2F..%2Fsrc%2FPHP%2FPagesUtilisateur) : (*pages reliée au pied de page*)**
   * [utilisateur.php](..%2F..%2Fsrc%2FPHP%2FPagesUtilisateur%2Futilisateur.php) : La page d'arrivée de tous les utilisateurs qui se connectent

* **[Autres](..%2F..%2Fsrc%2FPHP%2FAutres) :**
   * [fonctions_generales.php](..%2F..%2Fsrc%2FPHP%2FAutres%2Ffonctions_generales.php) : Script PHP qui regroupe les fonctions utiles au site dynamique. Il y a également la fonction ```tableau_profil($username, $table_user)``` qui gère l'affichage du profil en fonction du type d'utilisateur qui se connecte.

* **[JavaScript](..%2F..%2Fsrc%2FJS) :**
   * [messages.js](..%2F..%2Fsrc%2FJS%2Fmessages.js) : Le script JavaScript qui est reliée à la page de connexion et d'inscription et qui permet d'afficher les messages d'erreur ou de succès.

* **[SQL](..%2F..%2Fsrc%2FSQL) :**
   * [base_de_donnees.sql](..%2F..%2Fsrc%2FSQL%2Fbase_de_donnees.sql) : Le script SQL qui une fois exécuté, permet d'utiliser convenablement l'application avec les cas d'utilisations déjà implémentées.

* **[CSS](..%2F..%2Fsrc%2FCSS) :**
   * [css_site_dynamique.css](..%2F..%2Fsrc%2FCSS%2Fcss_site_dynamique.css) : Il s'agit de la feuille de style raccordée à toutes les nouvelles pages PHP à partir de cette deuxième version.

### Bilan

La deuxième version de l'application représente une évolution significative par rapport à la première, passant d'un site web statique à un site web dynamique avec une base de données sous-jacente.
Cette version est une base solide à améliorer et sur laquelle nous implémenterons les cas d'utilisations restants.


# Version finale

### Explications

>Afin de mieux connaître les spécifications pour la version définitive, consultez le dossier de spécification ([Specifications.md](Specifications.md))
dans la partie (#Quatrième Cycle : Version finale). Consultez également le dossier de conception ([Conception.md](Conception.md)) dans la partie #Site web dynamique.

### Implémentation des derniers cas d'utilisation

Afin d'implémenter les derniers cas d'utilisation tels qu'ils sont énoncés dans le document de spécifications, nous avons créé plusieurs fichiers supplémentaires dont :


* **[Authentification](..%2F..%2Fsrc%2FPHP%2FAuthentification) : (*pages reliée au pied de page*)**
   *[deconnexion.php](..%2F..%2Fsrc%2FPHP%2FAuthentification%2Fdeconnexion.php) :* Le script php qui permet aux utilisateurs connectés de se déconnecter.

* **[PagesUtilisateur](..%2F..%2Fsrc%2FPHP%2FPagesUtilisateur) : (*pages reliée au pied de page*)**
   * [Traitement_BD](..%2F..%2Fsrc%2FPHP%2FPagesUtilisateur%2FTraitement_BD) : Le dossier de fichiers php qui regroupe tous les traitements back-end pour les actions des utilisateurs 
   * [tableau_de_bord_utilisateur.php](..%2F..%2Fsrc%2FPHP%2FPagesUtilisateur%2Ftableau_de_bord_utilisateur.php) : La page php qui affiche de manière dynamique le tableau de bord des utilisateurs

* *[Crypto](..%2F..%2Fsrc%2FPHP%2FCrypto) :*
  * [crypto.php](..%2F..%2Fsrc%2FPHP%2FCrypto%2Fcrypto.php) : Le fichier contenant les algorithmes de cryptographie des mots de passe

* *[R](..%2F..%2Fsrc%2FR) :*
  * [page_etude_marche.r](..%2F..%2Fsrc%2FR%2Fpage_etude_marche.r) : Notre étude de marché réalisée avec shiny et R