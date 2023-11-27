![page_de_garde_RPI.png](IMAGES%2Fpage_de_garde_RPI.png)

# Sommaire
1. [Introduction](#Introduction)
2. [Installation de l'OS](#Installation-de-l'OS)
    * Raspberry PI OS
    * SSH
3. [Autres installations](#Autres-installations)
    * Fail2ban
    * Apache
    * MariaDB
    * PHP
    * Git
    * ufw
4. [Configuration](#Configuration)
5. [Accès à l'application](#Accès-à-l'application)
6. [Conclusion](#Conclusion)

  

# Introduction

>Ce document présente la procédure suivie, et qui a été mise en place afin de configurer le Raspberry PI 4, et également, faire les différentes installations sur
>nécessaires pour la SAE du troisième semestre de BUT informatique. Le but de la SAE en question est de développer une plateforme
>de ticketing interne pour les salles informatiques de l'IUT. Cette plateforme a été demandée par notre client,
>M. Hoguin. La réalisation de cette plateforme est confiée à notre équipe de trois étudiants en deuxième
>année de formation en informatique.

# Installation de l'OS

### Raspberry PI OS

La première étape de la configuration du Raspberry PI 4 consiste en l'installation du système d'exploitation. 
Nous avons opté pour le Raspberry PI OS, adapté à notre matériel.
Ainsi, premièrement, nous avons installé l'image de l'OS sur la carte SD grâce au logiciel Raspberry PI Imager.  
  
![RPI_Imager.png](IMAGES%2FRPI_Imager.png)  
  
Après cette étape, nous avons inséré la carte SD dans le Raspberry PI 4, branché une souris, un clavier et un écran,
puis nous avons alimenté le RPI et suivi les différentes étapes de configuration (langue, région, utilisateur, mot de passe, ...).

## SSH

Après avoir configuré le RPI, nous avons activé le service SSH (Secure Shell) qui est installé d'office avec Raspberry PI OS.
Pour activer SSH, il faut utiliser la commande suivante afin d'accéder au menu de configuration.

```shell
sudo raspi-config
```

Ensuite, nous avons sélectionné la ligne Advanced Options, puis la ligne SSH et avons confirmé l'activation du service SSH.
On finit par appuyer sur la touche Finish.

L'activation du service SSH nous permet de faciliter la gestion de celui-ci à distance. Cela nous permet d'accéder au Raspberry PI en ligne de commande,
simplifiant ainsi les opérations d'administration et les differentiates installations dont nous avons besoins.

Afin de se connecter à distance, il faut connaître l'adresse IP du RPi en exécutant la commande suivante qui est une abbreviation de la commande ```ip addr show``` :  
```shell
ip a s
```  

Enfin, pour se connecter, il faut utiliser la commande suivante et entrer le mot de passe :  
```shell
ssh "login"@"adresse_ip"
```  

# Autres installations

>Cette partie détaille les étapes d'installation et d'activation de divers logiciels et services sur le Raspberry PI 4. 
>Ces installations sont essentielles pour la réalisation de la plateforme de ticketing interne, conformément aux exigences 
>de la SAE du troisième semestre du BUT informatique.

**Note : Avant d'installer les différents services et logiciels, nous avons exécuté cette commande qui permet de mettre à jour la 
liste des paquets disponibles.**

```shell
sudo apt-get update
```

### Fail2ban

Fail2ban est un logiciel open-source qui permet de sécuriser un serveur en le protégeant contre des attaques
d'intrusion par exemple. En d'autres termes, Fail2ban permet de surveiller les journaux système en les analysant, 
détecter les tentatives de connexion répétée et infructueuse, bloquer automatiquement certaines adresses IP suspectées malveillantes.

Fail2ban est souvent utilisé sur des serveurs Linux en complément de l'utilisation d'SSH.

**Procédure :**
   * Installation :

```shell
sudo apt install fail2ban
```

   * Activation : 

```shell
sudo systemctl enable fail2ban
sudo systemctl start fail2ban
```  

Normalement, l'installation de fail2ban s'arrête là, ce qui devrait nous permettre de directement utiliser le logiciel.
Hors, lorsque nous vérifions l'activation de fail2ban avec la commande ```sudo systemctl status fail2ban```, une erreur se produit avec le message suivant :

```shell

root@raspb07:~# systemctl status fail2ban.service 
x fail2ban.service - Fail2Ban Service
     Loaded: loaded (/lib/systemd/system/fail2ban.service; enabled; preset: enabled)
     Active: failed (Result: exit-code) since Sun 2023-11-26 20:02:51 CET; 1s ago
   Duration: 350ms
       Docs: man:fail2ban(1)
    Process: 12916 ExecStart=/usr/bin/fail2ban-server -xf start (code=exited, status=255/EXCEPTION)
   Main PID: 12916 (code=exited, status=255/EXCEPTION)
        CPU: 342ms

nov. 26 20:02:51 raspb07.dinfo.iut-velizy.uvsq.fr systemd[1]: Started fail2ban.service - Fail2Ban Servic>
nov. 26 20:02:51 raspb07.dinfo.iut-velizy.uvsq.fr fail2ban-server[12916]: 2023-11-26 20:02:51,457 fail2b>
nov. 26 20:02:51 raspb07.dinfo.iut-velizy.uvsq.fr fail2ban-server[12916]: 2023-11-26 20:02:51,494 fail2b>
nov. 26 20:02:51 raspb07.dinfo.iut-velizy.uvsq.fr fail2ban-server[12916]: 2023-11-26 20:02:51,503 fail2b>
nov. 26 20:02:51 raspb07.dinfo.iut-velizy.uvsq.fr systemd[1]: fail2ban.service: Main process exited, cod>
nov. 26 20:02:51 raspb07.dinfo.iut-velizy.uvsq.fr systemd[1]: fail2ban.service: Failed with result 'exit>
```

Et en lançant la commande ```journalctl -u fail2ban```, nous avons plus de détails sur la source du problème : 

```shell
nov. 26 20:02:51 raspb07.dinfo.iut-velizy.uvsq.fr systemd[1]: Started fail2ban.service - Fail2Ban Service.
nov. 26 20:02:51 raspb07.dinfo.iut-velizy.uvsq.fr fail2ban-server[12916]: 2023-11-26 20:02:51,457 fail2ban.configreader   [12916]: WARNING 'allowipv6' not defined in 'Definition'. Using default one: 'auto'
nov. 26 20:02:51 raspb07.dinfo.iut-velizy.uvsq.fr fail2ban-server[12916]: 2023-11-26 20:02:51,494 fail2ban                [12916]: ERROR   Failed during configuration: Have not found any log file for sshd jail
```

Le principal problème viendrait donc du fait que fail2ban n'arrive pas à trouver le bon journal lié à la cellule de surveillance (jail) lié à sshd.
Ainsi, deux solutions de modification du fichier ```/etc/fail2ban/jail.conf``` se sont offerte à nous :

   * Soit, il fallait mettre en commentaire la ligne qui cherchait le journal :

```shell
[sshd]
port = ssh
#logpath = %(sshd_log)s
```

   * Mieux : En cherchant un peu plus, il fallait faire la recherche du journal automatiquement en mettant la variable backend = systemd :

![regler_probleme_fail2ban.png](IMAGES%2Fregler_probleme_fail2ban.png)

### Apache

Apache est un service qui sert de serveur web qui permet d'héberger la plateforme de ticketing. Son installation garantit 
la disponibilité et la sécurité des services web.

**Procédure :**  

* Installation 
```shell
sudo apt install apache2
```  
  
* Activation
```shell
sudo systemctl enable apache2
sudo systemctl start apache2
```  

On peut ensuite vérifier que le service est bien installé et opérationnel en exécutant la commande ```sudo systemctl status apache2```.


### MariaDB

MariaDb est un SGBD (Système de Gestion de Base de Données) qui permettra de gérer les interactions entre la base de 
données de la plateforme de ticketing et le serveur web Apache. MariaDb est un embranchement communautaire de MySQL.

**Procédure :**

* Installation
```shell
sudo apt install mariadb-server
```  

* Sécurisation initiale
```shell
sudo mysql_secure_installation
```  

*La sécurisation initiale de MariaDB, effectuée après son installation pour la plateforme de ticketing, 
renforce la protection des données sensibles en créant des identifiants solides et en limitant les accès non autorisés. 
Elle prévient les attaques en réduisant les vulnérabilités potentielles, contribue à respecter les normes de sécurité 
et améliore la stabilité et les performances de la base de données. Cette étape cruciale assure que MariaDB fonctionne 
de manière sécurisée, garantissant ainsi le traitement adéquat des informations liées aux tickets et utilisateurs.*

* Redémarrage 
```shell
sudo systemctl restart mysql
```  

*Ici, on redémarre mysql car à l'installation, il est automatiquement activé. par contre après la sécurisation initiale,
il faut redémarrer pour prendre en compte les modifications.*

On peut ensuite vérifier que le service est bien installé et opérationnel en exécutant la commande ```sudo systemctl status mysql```.

On peut également accéder à la ligne de commande MariaDb en tant qu'utilisateur root en utilisant cette commande : ```mysql -u root```.
Ou encore, on peut se connecter à la base de données de la plateforme de ticketing : ```musql -u user_sae -p sae_bd```.

**Note :**
* *user_sae* est le login de l'utilisateur de la base de donnée que nous avons créé.
* La base de données que nous avons créée se nomme *sae_bd*.
* Le mot de passe de *user_sae* est *azerty*

### PHP

PHP (hypertext Preprocessor) est le langage de programmation qui est utilisé pour produire les pages web dynamique
de la plateforme de ticketing.

**Procédure :**

* Installation
```shell
sudo apt install php libapache2-mod-php php-mysqli
```  

*On installe php, le module apache pour l'interpretation de php, ainsi que le module php pour la connection avec les bases de données (MariaDB/MySQL).*

* Redémarrage d'Apache 
```shell
sudo systemctl restart apache2
```  

### Git

Git est un système de gestion de version qui permet de faciliter le suivi des modifications du code source (pages web, base de donénes, documentation, ...).
git est également un outil de travail qui permet une meilleure collaboration avec les membres d'une équipe.

Sur Raspberry PI OS, Git est déjà installé. Par contre, nous avons installé Github CLI (Command Line Interface), qui permet 
d'interragir avec le dépôt git qui se situe pour notre part, sur Github. L'utilisation de Github CLI nécessite d'avoir un compte Github
et de se connecter avec son compte sur le RPI.

**Procédure :**

* Installation
```shell
sudo apt install gh
```  

* Authentification : Il faut générer un jeton d'authentification sur son espace personnel Github.
```shell
gh auth login
```  

* Clonage du dépôt :
```shell
gh repo clone YassouSensai/SAE_APPLICATION_WEB
```

Nous avons maintenant accès au dépôt git de l'application sur le RPI, et nous pouvons maintenant mettre à jour le code source à n'importe quel moment.

### UFW

UFW (Uncomplicated FireWall) est un programme informatique qui permet de gérer les règles du pare-feu afin d'assurer la sécurité du RPi,
notamment en autorisant uniquement les connexions nécessaires. L'utilisation de ce genre de programmes informatique permet de protéger
l'application et le RPI des connexions non autorisés.

**Procédure :**

* Installation
```shell
sudo apt install ufw
```  

* Authorisation des connexions nécessaires : SSH, HTTP et Base de données 
```shell
ufw enable 22
ufw enable 80
ufw enable 3306
```


# Configuration

La configuration du système, du serveur web, et de la base de données a été réalisée de manière à obligatoirement garantir l'accès à l'application web.
Ainsi, pour simplifier l'accès à l'application, un alias personnalisé a été créé afin de permettre un accès plus convivial et facile à retenir.

**Alias :**
* Création :
```shell
touch confSAE.conf
nano confSAE.conf
```

* Contenu
```apacheconf
Alias /start /home/pisae/Documents/SAE_APPLICATION_WEB
<Directory /home/pisae/Documents/SAE_APPLICATION_WEB>
Require all granted
Options Indexes
</Directory>
```

**Modification du fichier de configuration d'Apache (/etc/apache2/apache2.conf) :**

* Premièrement, on fait une copie
```shell
cp /etc/apache2/apache2.conf /etc/apache2/apache2.conf.cp
```

* Ensuite, on rajoute à la fin du fichier de configuration, l'alias que l'on a créé :
```shell
nano /etc/apache2/apache2.conf
```

```apacheconf
Include "confSAE.conf"
```

# Accès à l'application

Afin de pouvoir accèder à l'application, il faut :
   * Se connecter au RPI : ```ssh pisae@"adresse_IP"``` (le mot de passe et *!pisae!*)
   * Vérifier que les services sont bien actifs (Apache et Mysql)
   * Ouvrir un navigateur et dans la barre de recherche, taper : "adresse_IP/start"

Vous pourrez ainsi cliquer sur *src* puis *PHP*, la page d'accueil *index.php* s'ouvrira ! (Une modification aura surement prochainement lieu
afin que la page d'accueil se lance immédiatement.)

# Conclusion

En résumé, ce document expose les différentes étapes suivies pour configurer le Raspberry PI 4 et mettre en place la plateforme de ticketing. 
Cette initiative s'inscrit dans le cadre de la SAE du troisième semestre du BUT informatique, avec pour objectif la 
satisfaction des besoins de notre client, M. Hoguin..