**Layout commun : en-tête, navigation, pied de page**

Toutes les pages utilisent le même en-tête (logo WoodyCraft, navigation, panier, compte) et le même pied de page (`layouts/footer`), y compris les pages de connexion et d'inscription.

![Accueil avec l'en-tête et le pied de page](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-7/carte7-accueil.png?raw=true)

![Détail d'un ordinateur dans le nouveau layout](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-7/carte7-detail.png?raw=true)

**Couleurs et polices de la maquette**

Fond beige `#F4ECDD`, vert sapin `#1F4A3A`, brun `#2E2118`, ajoutés à Tailwind (`cream`, `pine`, `bark`). Titres en Fraunces, texte en DM Sans. Les boutons principaux et les champs de saisie reprennent aussi ces couleurs.

![Liste des ordinateurs aux couleurs de la maquette](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-7/carte7-liste.png?raw=true)

**Lien vers le panier avec le nombre d'articles**

Le nombre affiché est la somme des quantités du panier (panier du client connecté, ou du visiteur par son identifiant de session). Ci-dessus, un client avec 3 articles ; ci-dessous, un visiteur au panier vide.

![Visiteur non connecté, panier à 0](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-7/carte7-connexion-visiteur.png?raw=true)

**Non testé / à noter**

- L'ajout au panier n'existe pas encore (carte #11) : pour la capture, le panier de 3 articles a été créé dans une transaction annulée après le rendu. La base n'a pas été modifiée.
- Le lien « Panier » ne mène nulle part tant que la page du panier n'existe pas (cartes #12 et #29).
- Affichage mobile (menu replié) non vérifié en capture.
- Le libellé « Computers » n'est pas traduit (carte #37, version multilingue), pas plus que le sélecteur FR / EN de la maquette.
