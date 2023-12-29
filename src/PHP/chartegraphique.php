<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/css_site_statique.css">
    <title>Charte Graphique</title>
    <meta charset="UTF-8">
    <meta name="description" content="Description de la charte graphique de la plateforme de ticketing de l'IUT Vélizy.">
    <meta name="keywords" content="charte graphique, palette de couleurs, typographie, formes, accessibilité">
    <meta name="author" content="TYMCHYSHYN Ostap, Elkhalki Yassine, Husleag Aaron">
    <style>
        .logo-trans {
            position: relative;
        }

        .logo-overlay {
            position: absolute;
            top: 0;
            left: 100%;
            visibility: hidden;
            transform: translateX(100%);
            transition: transform 0.8s ease-in-out, visibility 0s 0.3s;
        }

        .logo-trans:hover .logo-overlay {
            transform: translateX(0);
            visibility: visible;
            transition: transform 0.8s ease-in-out;
        }

        .logo-trans img {
            transition: transform 0.8s ease-in-out;
        }

        .logo-trans img.move-right {
            transform: translateX(10px);
        }
    </style>
    <script>
        function moveRightOnHover(element) {
            const logoOverlay = element.nextElementSibling;
            logoOverlay.classList.add("move-right");
            logoOverlay.style.visibility = "visible";
        }

        function resetPosition(element) {
            const logoOverlay = element.nextElementSibling;
            logoOverlay.classList.remove("move-right");
            logoOverlay.style.visibility = "visible";
            logoOverlay.style.transform = "translateX(0)";
        }
    </script>
</head>
<body>
<?php
include('../HTML/entete_general.html');
?>
<section>
    <div class="Toute-la-page">
        <div class="bas-page">
            <div class="block2-transparent">
                <h3 style="color: #FFFFFF">Présentation de la charte graphique</h3>
                <p>Une charte graphique est un ensemble de directives visuelles et stylistiques essentielles pour guider la conception visuelle d'un projet, en l'occurrence, la plateforme de ticketing interne développée pour notre IUT (IUT Vélizy). Cette charte a pour but de définir l'identité visuelle de la plateforme en déterminant les couleurs, les polices de caractères, la mise en page, les éléments de navigation, et bien d'autres aspects visuels. Elle assure la cohérence et l'harmonie de l'ensemble, garantissant ainsi une expérience utilisateur unifiée.</p>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</section>

<section>
    <div class="Toute-la-page">
        <div class="milieu-gauche">
            <h3>Déclinaison de logos</h3>
            <p>Le symbole visuel principal qui représente notre plateforme de ticketing interne est le logo. Afin de garantir une uniformité visuelle, il est essentiel d'utiliser le logo de manière cohérente dans toutes les applications et sur tous les supports. Toutefois, il peut être requis de produire différentes versions du logo pour s'adapter à divers contextes. Ci-dessous, vous trouverez les principales variations du logo :</p>

            <p><strong>Logo principal (voir argumentaire partie 2. Logo 2) :</strong></p>
            <br><br>
            <div class="logo-trans">
                <img src="../images/logonontrans.png" alt="Logo principal de la plateforme"
                     onmouseover="moveRightOnHover(this)"
                     onmouseout="resetPosition(this)">
                <!-- Nouvelle image à droite -->
                <img class="logo-overlay" src="../images/logotrans.png" alt="Nouvelle image du logo transparent ">
            </div>
            <br><br>
            <p>La version principale du logo est le symbole visuel de notre plateforme. Il doit être utilisé dans des cas d'utilisation standard sur des fonds clairs et uniformes. La couleur prédominante du logo est le corail (#ffcdb2), avec des nuances de rose et de brun.</p>

            <p><strong>Dans le but de développer notre marque (™ : trade-mark) :</strong></p>
            <br><br>
            <div class="logo-trans">
                <img src="../images/logonontransTM.png" alt="Logo principal de la plateforme"
                     onmouseover="moveRightOnHover(this)"
                     onmouseout="resetPosition(this)">
                <!-- Nouvelle image à droite -->
                <img class="logo-overlay" src="../images/logotransTM.png" alt="Nouvelle image du logo transparent avec marquage TM">
            </div>
            <br><br>
            <p>Incorporer le symbole ™ (marque de commerce) dans un logo est une pratique fréquente pour signifier que le logo est protégé en tant que marque commerciale. Cela indique que le logo est la propriété exclusive de l'entreprise et ne peut pas être utilisé par d'autres sans autorisation. En ajoutant le symbole ™, l'entreprise affirme sa revendication légale sur le logo, ce qui peut dissuader les contrefacteurs et renforcer la protection de sa marque. Il est important de noter que l'ajout du symbole ™ ne confère pas le même niveau de protection juridique qu'une marque déposée (®), mais cela reste une étape essentielle dans la préservation de l'identité visuelle de l'entreprise.</p>
            <p><strong>Pourquoi les logos transparents ?</strong></p>

            <p>Lorsque le logo doit être superposé à des images ou des arrière-plans variés, utilisez la version du logo avec un fond transparent pour qu'il se fonde harmonieusement dans l'environnement visuel.</p>
        </div>
        <div class="milieu-droite">
            <div class="block1">
                <h3>Palette de couleurs</h3>
                <p>
                    La palette de couleurs est un élément crucial de la conception visuelle d'un site web, en effet, elle influence directement la perception et l'expérience des utilisateurs naviguant sur le site. Ainsi les palettes de couleurs que notre groupe a sélectionnés jouent un rôle essentiel dans la création d'une ambiance visuelle appropriée pour votre site web. Puisque les couleurs sont très importantes pour cette SAE, nous avons choisi d'utiliser un mélange entre 2 palettes pour que notre site soit beaucoup plus esthétique, équilibré et riche en couleurs.
                </p>
                <h4 style="color: #FFFFFF">Première palette de couleurs :</h4>
                <img src="../images/palette1.PNG" alt="Première palette de couleurs">
                <ul>
                    <li><span style="background-color: #FFFFFF; color: #534F59;">#ffcdb2</span>: Cette teinte douce et chaleureuse de corail apporte une touche d'accueil et de convivialité à votre site web. Elle sert à créer une atmosphère accueillante et rassurante, ce qui est essentiel pour une plateforme de ticketing interne. Les utilisateurs se sentiront à l'aise lorsqu'ils soumettent des demandes de dépannage.</li>
                    <li><span style="background-color: #FFFFFF; color: #534F59;">#ffcdb2</span>: Le rose corail plus foncé ajoute une nuance d'optimisme à la palette. Cela peut symboliser l'engagement de l'IUT à fournir un service de qualité et à résoudre les problèmes de manière efficace.</li>
                    <li><span style="background-color: #FFFFFF; color: #534F59;">#ffcdb2</span>: Le rose terne ajoute de la profondeur à la palette, renforçant l'aspect sérieux et professionnel de la plateforme. Ainsi, il évoque la fiabilité et la crédibilité.</li>
                    <li><span style="background-color: #FFFFFF; color: #534F59;">#ffcdb2</span>: Le brun rosé apporte une teinte neutre et apaisante à la palette. Cela peut aider à équilibrer l'aspect vibrant des couleurs précédentes, créant ainsi une expérience utilisateur agréable.</li>
                    <li><span style="background-color: #FFFFFF; color: #534F59;">#ffcdb2</span>: Le gris foncé peut être utilisé pour des éléments de texte ou de contraste. Il offre une lisibilité claire et une séparation visuelle entre les différents éléments de la page.</li>
                </ul>
                <h4 style="color: #FFFFFF">Deuxième palette de couleurs :</h4>
                <img src="../images/palette2.PNG" alt="Deuxième palette de couleurs">
                <ul>
                    <li><span style="background-color: #FFFFFF; color: #534F59;">#ffcdb2</span>: Le bleu marine foncé représente la confiance et la stabilité. Il suggère que la plateforme est un lieu sûr pour soumettre des demandes de dépannage et que l'IUT est déterminé à les résoudre de manière fiable.</li>
                    <li><span style="background-color: #FFFFFF; color: #534F59;">#ffcdb2</span>: La nuance de violet évoque la créativité et l'innovation. Elle peut suggérer que l'IUT adopte des approches novatrices pour résoudre les problèmes.</li>
                    <li><span style="background-color: #FFFFFF; color: #534F59;">#ffcdb2</span>: Le rose marron ajoute une touche de chaleur à la palette. Cela peut aider à créer une ambiance accueillante et empathique pour les utilisateurs qui souhaitent demander de l'aide.</li>
                    <li><span style="background-color: #FFFFFF; color: #534F59;">#ffcdb2</span>: Le rose corail plus clair ajoute de la luminosité et de l'optimisme à la palette. Il peut symboliser la résolution réussie des problèmes par l'IUT.</li>
                    <li><span style="background-color: #FFFFFF; color: #534F59;">#ffcdb2</span>: Le brun clair peut être utilisé pour des éléments de contraste. Il offre une lisibilité tout en maintenant une cohérence visuelle.</li>
                </ul>
                <p>
                    Ces deux palettes de couleurs offrent un équilibre entre des tons chaleureux et sérieux dans un environnement professionnel, fiable et accueillant. Cependant, pour une cohérence sur le site, certaines couleurs ne seront pas utilisées.
                </p>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</section>

<section>
    <div class="Toute-la-page">
        <div class="bas-page">
            <div class="block2-transparent">
                <h3>Typographie et Formes</h3>
                <ul  class="styled-list">
                    <li>
                        <strong>Police Principale choisie : Lato</strong><br>
                        <strong>Description :</strong> Lato est une police sans sérif élégante et lisible, adaptée à une variété de contenus. Elle offre une grande lisibilité à l'écran, ce qui en fait un excellent choix pour les interfaces utilisateur et le contenu textuel. Lato est polyvalente et offre différentes variations de style gras pour mettre en évidence des éléments clés ou des en-têtes.
                    </li>
                    <li>
                        <strong>Police pour les titres : Raleway</strong><br>
                        <strong>Description :</strong> Raleway est une police sans sérif moderne, idéale pour les titres et les en-têtes. Elle a une apparence élégante et légère qui attire l'attention. Son design la rend adaptée aux sites web professionnels et modernes.
                    </li>
                    <li>
                        <strong>Police pour les paragraphes : Open Sans</strong><br>
                        <strong>Description :</strong> Open Sans est une police sans sérif conviviale et lisible. Elle est parfaite pour les contenus longs, tels que des articles ou des descriptions. Open Sans offre une lisibilité exceptionnelle, même à de petites tailles de police, c’est donc une police très classique mais aussi très efficace dans le cadre de la SAE.
                    </li>
                </ul>
                <h3>Formes</h3>
                <p>
                    Dans cette partie, nous avons choisi de rester dans la cohérence, simplicité et l’efficacité des formes pour notre site, donc on a choisi des formes essentielles et simples pour maintenir une identité visuelle solide en respectant un certain équilibre.
                </p>
                <ul  class="styled-list">
                    <li>
                        <strong>Formes Circulaires :</strong><br>
                        Les formes circulaires, notamment les logos et les icônes sur notre site, apportent une touche d'élégance et d'harmonie à la conception visuelle de la plateforme. Elles sont idéales pour représenter des éléments essentiels et des identifiants visuels. Ainsi, les logos circulaires créent un sentiment d'unité et d'intégration avec l'ensemble du site, tandis que les icônes circulaires offrent une esthétique propre et soignée, ce qui accompagne très bien nos palettes de couleurs.
                    </li>
                    <li>
                        <strong>Blocs Carrés :</strong><br>
                        Les blocs carrés, avec parfois des bords arrondis pour adoucir l'apparence, sont parfaits pour structurer l'information et l'agencement des contenus. Ils fournissent une présentation ordonnée et sont souvent utilisés pour encadrer des sections de contenu, des images, des boutons d'action, et d'autres éléments interactifs. L'utilisation de blocs carrés avec des bords arrondis contribue à créer une esthétique moderne tout en conservant une certaine douceur visuelle, ce qui va très bien avec la légèreté que nous voulons faire passer sur notre site.
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</section>

<section>
    <div class="Toute-la-page">
        <div class="milieu-gauche">
            <h3>IMAGES ASSOCIES AU PROJET</h3>
            <p>pas encore d'images apparaitront plus tard
            </p>
        </div>
        <div class="milieu-droite">
            <div class="block1">
                <h3>Description vidéo et photo</h3>
                <p>
                    Bien que notre site contienne principalement un tutoriel vidéo explicatif, les images et les photographies, telles que les palettes de couleurs ou les illustrations, ont également un rôle essentiel dans l'enrichissement visuel de la plateforme.
                </p>
                <p>
                    Les images, les palettes de couleurs et les illustrations, sont des éléments visuels cruciaux pour améliorer la convivialité de notre site. Leur utilisation doit respecter les points suivants : cohérence de style, signification, et surtout la qualité graphique (haute résolution).
                </p>
                <p>
                    Cependant, notre vidéo, qui sert de tutoriel expliquant le fonctionnement de la plateforme, est un élément central de notre site, elle doit donc respecter les mêmes points que les images, mais aussi les points tels que le contenu explicatif.
                </p>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</section>

<section>
    <div class="Toute-la-page">
        <div class="bas-page">
            <div class="block2">
                <h2 style="color: #FFFFFF">Description de la mise en page</h2>
                <p>
                    La mise en page de notre plateforme de ticketing interne est donc conçue pour offrir une expérience utilisateur fluide et intuitive. Nous avons choisi une structure axée sur la simplicité, l'efficacité et l'accessibilité. Nous utilisons des blocs carrés aux bords arrondis pour encadrer les différents éléments, facilitant la lecture et la navigation. L'agencement des contenus est pensé de manière à mettre en avant les informations essentielles, notamment les demandes de dépannage et les notifications pour une gestion efficace. Tout cela combiné à la police choisie ainsi que des couleurs, crée une certaine hiérarchie dans notre site web.
                </p>
                <p>
                    La charte graphique de notre site est conçue pour garantir une expérience utilisateur cohérente et esthétique. Elle définit les directives concernant les couleurs, les polices, les images et d'autres éléments visuels utilisés sur le site. Notre charte graphique vise à transmettre notre identité visuelle et à renforcer la reconnaissance de notre marque.
                </p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="Toute-la-page">
        <div class="bas-page">
            <div class="block2">
                <h2 style="color: #FFFFFF">Respect de l'accessibilité</h2>
                <p>
                    Dans le cadre de la SAE et pas que, l’accessibilité est vraiment un élément à ne pas négliger. Nous nous engageons donc à rendre notre site web utilisable par un large éventail d'individus, y compris ceux ayant des besoins spécifiques ou des limitations physiques. Voici donc les points qu’on a respectés pour notre site web :
                </p>
                <ul style="text-align: left;">
                    <li>Conception Inclusive : Nous nous engageons à créer un site web accessible à tous, indépendamment de leur capacité ou de leur situation (diversité d’utilisateurs).</li>
                    <li>Normes d'Accessibilité : Nous respectons les normes d'accessibilité web reconnues, notamment les directives WCAG (Web Content Accessibility Guidelines). Cela signifie que notre site est conçu pour être navigable par des technologies d'assistance, comme les lecteurs d'écran, et qu'il est compatible avec différents navigateurs et appareils (lecture et explication du contenu pour tout le monde).</li>
                    <li>Contraste et lisibilité : Nous utilisons des couleurs à fort contraste pour garantir une lisibilité optimale du texte. Les polices de caractères sont choisies avec soin, en veillant à ce qu'elles soient lisibles et adaptées à la lecture sur écran (notamment pour les daltoniens).</li>
                    <li>Structuration Logique : Notre site est organisé de manière logique avec une hiérarchie d'informations claire. Les en-têtes, listes et liens sont utilisés de manière cohérente pour faciliter la navigation.</li>
                    <li>Alternatives aux Médias : Nous fournissons des descriptions textuelles pour les images et les vidéos, permettant ainsi aux utilisateurs qui dépendent de technologies d'assistance de comprendre pleinement le contenu visuel.</li>
                    <li>Tests d'Accessibilité : Nous réalisons régulièrement des tests d'accessibilité pour identifier et corriger les éventuels problèmes d'accessibilité.</li>
                </ul>
                <p>
                    Notre engagement envers l'accessibilité reflète notre désir d'offrir une expérience en ligne inclusive et équitable pour tous les utilisateurs. Nous reconnaissons que l'accessibilité est un élément essentiel de la conception web, et nous travaillons constamment à améliorer notre site dans ce sens.
                </p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="Toute-la-page">
        <div class="milieu-gauche">
            <h3>Éléments de Navigation</h3>
            <p>
                Les éléments de navigation sont essentiels pour permettre aux utilisateurs de se déplacer efficacement sur notre site web. Pour garantir une expérience fluide, nous utilisons des menus de navigation clairs et intuitifs, des liens bien structurés et une organisation logique des informations. Voici quelques éléments de navigation clés :
            </p>
            <ul>
                <li><strong>Menu Principal : </strong>Notre menu principal est situé en haut de la page pour une visibilité maximale. Il comprend des liens vers les sections importantes du site, y compris la page d'accueil, la charte graphique, les différentes versions du logo et la page de connexion.</li>
                <li><strong>Liens Contextuels : </strong>Nous utilisons des liens contextuels à l'intérieur du contenu pour permettre aux utilisateurs d'accéder rapidement à des informations connexes. Ces liens sont formatés de manière à être facilement identifiables.</li>
                <li><strong>Barre de Recherche : </strong>Une barre de recherche est disponible pour permettre aux utilisateurs de rechercher des informations spécifiques. Elle est située en haut de la page pour une accessibilité accrue.</li>
                <li><strong>Pied de Page : </strong>Notre pied de page contient des liens supplémentaires vers des pages importantes, des informations de contact et des liens vers nos médias sociaux.</li>
            </ul>
        </div>
        <div class="milieu-droite">
            <div class="block1">
                <h3>Utilisation des Boutons et des Liens</h3>
                <p>
                    Les boutons et les liens sont des éléments interactifs cruciaux de notre site web. Ils permettent aux utilisateurs d'effectuer des actions et de naviguer facilement dans le contenu. Voici comment nous utilisons ces éléments de manière accessible :
                </p>
                <ul>
                    <li><strong>Contraste : </strong>Nous assurons un contraste adéquat entre le texte et l'arrière-plan pour garantir la lisibilité des boutons et des liens, en particulier pour les utilisateurs ayant des problèmes de vision. Les boutons et les liens utilisent des couleurs de contraste élevé.</li>
                    <li><strong>Étiquetage clair : </strong>Les boutons et les liens sont étiquetés de manière claire et concise pour indiquer leur fonction. Les utilisateurs doivent pouvoir comprendre instantanément ce que fait un bouton ou un lien.</li>
                    <li><strong>Focus Visuel : </strong>Nous utilisons des indicateurs visuels pour mettre en évidence l'élément actuellement sélectionné ou survolé. Cela aide les utilisateurs à savoir où ils se trouvent dans la navigation.</li>
                    <li><strong>Texte de Remplacement : </strong>Les images utilisées comme boutons ou liens comportent des textes de remplacement (attribut "alt") pour décrire leur fonction. Cela est essentiel pour les utilisateurs qui dépendent de lecteurs d'écran.</li>
                </ul>
                <p>
                    Notre approche pour les boutons et les liens vise à garantir une expérience utilisateur accessible et conviviale, en permettant à tous les utilisateurs de naviguer et d'interagir efficacement avec notre site web.
                </p>
            </div>
        </div>
    </div>
</section>

<?php
include('../HTML/pied.html');
include('../HTML/pied_lien.html');
?>
</body>
</html>
