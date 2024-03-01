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
4. [Seance réalisée en cours le 1 mars 2024](#Seance-réalisée-en-cours-le-1-mars-2024)
    * Boîte noir
    * Boîte blanche 
   


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

# Seance réalisée en cours le 1 mars 2024

Cette séance sera réalisée sur la fonction initialize du module de crypto. Deux tests seront réalisés pour
cette séance ; un en boîte noir et un autre en boîte blanche.

```php
/**
 * Fonction initialize du module de crypto.
 * Cette fonction prend en paramètre une clé (chaine de caractère)
 * et créé une séquence (un tableau de 256 éléments) 
 * @param $cle (string)
 * @return tab [256]
 */
function initialize($cle) {
    $longueur_cle = strlen($cle);
    $sequence_cle = range(0, 255);
    $j = 0;

    for ($i = 0; $i < 256; $i++) {
        $j = ($j + $sequence_cle[$i] + ord($cle[$i % $longueur_cle])) % 256;

        // échange des valeurs
        $temp = $sequence_cle[$i];
        $sequence_cle[$i] = $sequence_cle[$j];
        $sequence_cle[$j] = $temp;
    }
    return $sequence_cle;
}
```
### Boite blanche (chemins indépendants)

### Graphe des chemins indépendants indépendants :

![graphe_chemins_independants.png](images%2FTESTS%2Fgraphe_chemins_independants.png)

### Chemins indépendants :
- **2 chemins :**
   - **P1 :** 1, 2, 3, 4
   - **P2 :** 1, 2, 4

<table>
  <tr>
    <th colspan="4">Identification de test : Tests pour le fichier crypto</th>
  </tr>
  <tr>
    <td colspan="4">Description de test : Test de différentes valeurs incluses dans les ensembles différents ci-dessus pour chacun des cas possibles (également vu ci-dessus)</td>
  </tr>
  <tr>
    <td colspan="4">Ressources requises : aucune</td>
  </tr>
  <tr>
    <td colspan="4">Responsables : Tymchyshyn Ostap, Elkhalki Yassine, Husleag Aaron</td>
  </tr>
  <tr>
    <th>Cas ou méthode testé</th>
    <th>Acteurs</th>
    <th>Action</th>
    <th>Résultat attendu</th>
  </tr>
  <tr>
    <td>initialize()</td>
    <td>char chaine de caractères</td>
    <td>renvoyer un clé générée à partir du paramètre donné</td>
    <td>tableau généré à partir de la clé</td>
  </tr>
</table>

<table>
  <tr>
    <th>Classe</th>
    <th>Ensemble de a</th>
    <th>Valeur de sortie c</th>
  </tr>
  <tr>
    <td >P1 clé est vide</td>
    <td>Lorsque la clé est vide, le nombre d'éléments dans le tableau retourné doit être égal à 256.</td>
    <td>tableau (0,1,2,3…255)</td>
  </tr>
  
  <tr>
    <td>P2 n’est pas vide</td>
    <td>Lorsque la clé a une longueur de 256</td>
    <td>Tableau généré en fonction de la clé</td>
  </tr>
</table>

<table>
  <tr>
    <th>Classe</th>
    <th>Ensemble de a</th>
    <th>Valeur de sortie c</th>
  </tr>
  <tr>
    <td >P1 clé est vide</td>
    <td>initialize() retourne [0, 1, 2, ..., 255]</td>
    <td>Tableau de 256 éléments
</td>
  </tr>

  <tr>
    <td>P2 n’est pas vide</td>
    <td>initialize('example_key')                                              [67, 153, 25, ..., x] (où 'example_key' est utilisée pour générer la séquence de clé)</td>
    <td>Tableau de 256 éléments</td>
  </tr>
</table>

Les tests ont été conçus pour s'assurer que la fonction réponde correctement tant aux scénarios où la clé est vide que lorsqu'elle est non vide. Chaque ensemble de données de test est accompagné d'un résultat attendu clairement défini, ce qui permettra de vérifier avec précision si la fonction `initialize()` fonctionne comme prévu dans diverses situations.

### Boite noire

<table>
  <thead>
    <tr>
      <th colspan="3">Identification : Test de la fonction initialize</th>
    </tr>
    <tr>
      <th colspan="2">Réalisateur : notre groupe</th>
      <th>Version : 1.0</th>
    </tr>
    <tr>
      <th>Cas</th>
      <th>Test</th>
      <th>Sortie Attendue</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Clé vide</td>
      <td>Un tableau de 256 éléments ordonné de 0 à 255</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Clé non vide</td>
      <td>Un tableau de 256 éléments, l'ordre des éléments du tableau doit être différent pour différentes clés.</td>
    </tr>
    <tr>
      <td>3</td>
      <td>Clé de longueur maximale (256 caractères)</td>
      <td>Un tableau de 256 éléments, l'ordre des éléments du tableau doit être différent pour différentes clés.</td>
    </tr>
    <tr>
      <td>4</td>
      <td>Clé de longueur supérieure à 256 caractères</td>
      <td>Même comportement que pour une clé de 256 caractères, car la longueur est réduite modulo 256.</td>
    </tr>
    <tr>
      <td>5</td>
      <td>Clé de longueur inférieure à 256 caractères</td>
      <td>Un tableau de 256 éléments, mais l'ordre des éléments du tableau doit être différent pour différentes clés. Certains éléments du tableau peuvent ne pas être affectés par la clé.</td>
    </tr>
    <tr>
      <td>6</td>
      <td>Clé contenant des caractères spéciaux</td>
      <td>Un tableau de 256 éléments, l'ordre des éléments du tableau doit être différent pour différentes clés.</td>
    </tr>
    <tr>
      <td>7</td>
      <td>Clé contenant des caractères Unicode</td>
      <td>Un tableau de 256 éléments, l'ordre des éléments du tableau doit être différent pour différentes clés.</td>
    </tr>
    <tr>
      <td>8</td>
      <td>Clé contenant des caractères de contrôle ou non imprimables</td>
      <td>Un tableau de 256 éléments, l'ordre des éléments du tableau doit être différent pour différentes clés.</td>
    </tr>
    <tr>
      <td>9</td>
      <td>Clé de longueur 1</td>
      <td>Un tableau de 256 éléments, mais l'ordre des éléments du tableau doit être différent pour différentes clés.</td>
    </tr>
  </tbody>
</table>




