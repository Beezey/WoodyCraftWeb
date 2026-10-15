# Journal de bord — SP1 WoodyCraft Web

Projet : site d'e-commerce WoodyCraft (Laravel 10, MySQL), catalogue d'ordinateurs.
Dépôt : https://github.com/Beezey/WoodyCraftWeb

## Séance du 8 octobre 2026

### Objectifs de la séance

Travail demandé par la professeure pour cette journée en distanciel :

1. Terminer la maquette Figma et la lui envoyer
2. Ajouter `aemenier` aux collaborateurs du dépôt
3. Modéliser la base de données de la SP1
4. Pousser la modélisation dans le dépôt
5. Créer un Kanban dans le dépôt
6. Lister les tâches de toute la SP1 dans le backlog

### Travail réalisé

**Maquette**

- 7 écrans en 1440 px : accueil, catégorie, produit, panier, connexion, commande, administration des ordinateurs.
- Thème « atelier bois chaleureux » : fond beige `#F4ECDD`, vert sapin `#1F4A3A`, brun `#2E2118`, polices Fraunces (titres) et DM Sans (texte).
- Sélecteur de langue FR / EN dans l'en-tête, en prévision de la fonctionnalité supplémentaire « version multilingue ».
- Les écrans ont d'abord été produits en pages HTML, puis importés dans Figma avec le plugin html.to.design et retouchés dans Figma.

**Modélisation de la base de données**

- Fichier `docs/modelisation.drawio`, deux pages : MCD (notation Merise) et MLD.
- 6 entités : UTILISATEUR, ADRESSE, PANIER, COMMANDE, ORDINATEUR, CATEGORIE.
- 8 tables : `users`, `addresses`, `carts`, `cart_items`, `orders`, `order_items`, `computers`, `categories`.
- Poussée sur `main` (commits `c82cf53` et `6eb3b9d`).

**Kanban et backlog**

- 37 issues créées dans le dépôt, puis ajoutées au tableau Kanban du projet GitHub.
- 13 user stories tirées du sujet (US01 à US13), chacune découpée en une carte `[Back]` et une carte `[Front]`.
- 5 tâches techniques et 6 cartes de livrables (validations, dossier projet).
- Étiquettes : `user story`, `technique`, `livrable`, `back-end`, `front-end`, et une priorité de 1 à 3.

**Collaborateur**

- `aemenier` figure bien dans les collaborateurs du dépôt.

**Carte #3 — création des tables**

- 6 migrations : `categories`, `addresses`, `carts`, `cart_items`, `orders`, `order_items`, avec clés étrangères et contraintes d'unicité.
- 6 modèles Eloquent et leurs relations ; relations `addresses()`, `cart()` et `orders()` ajoutées au modèle `User`.
- Migrations exécutées sur la base. Les contraintes ont été testées dans une transaction annulée à la fin : doublon refusé dans un panier, un seul panier par client, suppression refusée pour un ordinateur déjà commandé, suppression en cascade des lignes d'un panier.

### Choix de conception

| Choix | Raison |
|---|---|
| Le panier est enregistré en base (`carts`, `cart_items`) | Il survit à la fermeture du navigateur et peut être rattaché au compte à la connexion |
| `carts.user_id` est facultatif, avec un `session_id` pour les visiteurs | Le sujet n'impose la connexion que pour passer commande, pas pour remplir le panier |
| Le prix unitaire est recopié dans `order_items` | Une commande passée ne doit pas changer si le prix de l'ordinateur évolue |
| Une adresse modifiée lors d'une commande crée une nouvelle adresse | L'adresse des anciennes commandes ne doit pas être altérée |
| Les meilleures ventes sont calculées à partir de `orders.created_at` et des quantités | Pas besoin d'une table dédiée pour « les plus vendus des 7 derniers jours » |
| Un ordinateur déjà commandé ne peut pas être supprimé | Conserver l'historique des commandes |
| Tables et colonnes en anglais, entités du MCD en français | Suivre les conventions de Laravel et le code existant (`users`, `computers`) |
| Chaque user story est séparée en carte back-end et carte front-end | Distinguer le travail sur les données et les routes du travail sur les pages |

### Difficultés rencontrées

- **Import dans Figma.** Le premier import est arrivé sans mise en forme, car la feuille de style était dans un fichier séparé. Elle a été intégrée dans chaque page. Le second import déformait certains blocs : les mises en page souples (éléments qui s'étirent ou passent à la ligne) ont été remplacées par des largeurs fixes.
- **Pages du fichier draw.io.** L'extension VS Code n'affiche pas les onglets de pages par défaut ; le MLD est sur la seconde page.
- **Table `computers` existante.** Elle stocke la catégorie en texte libre et le prix en FLOAT, ce qui ne correspond pas au modèle. L'adaptation est prévue dans la carte #4.

### Points à confirmer avec la professeure

- Le sujet indique « Vous utiliserez Gitlab », alors que le dépôt demandé est sur GitHub.
- Le sujet dit que le paiement se fait en cliquant sur « Commander » depuis le panier. La maquette prévoit deux temps : « Commander » dans le panier, puis « Confirmer la commande » après la saisie de l'adresse.

### État en fin de séance

| Élément | État |
|---|---|
| Maquette Figma | Terminée, carte #1 clôturée |
| Modélisation | Poussée, carte #2 clôturée |
| Kanban et backlog | En place, 37 cartes |
| Carte #3 (tables) | Terminée en local, à commiter et pousser |

### Prochaines étapes

1. Commiter et pousser la carte #3.
2. Carte #4 : adapter `computers` (clé étrangère `category_id`, prix en DECIMAL) et renommer `computer.php` en `Computer.php`.
3. Carte #6 : données de démonstration (catégories et ordinateurs).
4. Carte #7 : mise en page commune reprise de la maquette.
5. Catalogue : US01 à US03, back puis front.

## Séance du 9 octobre 2026

### Travail réalisé

**Carte #4 — adaptation de la table `computers`**

- Migration `2026_10_09_090000_adapt_computers_table` : la colonne `category` (texte libre) est remplacée par `category_id`, clé étrangère vers `categories` ; `price` passe de FLOAT à DECIMAL(8,2).
- Les ordinateurs existants sont conservés : leurs catégories en texte libre sont converties en lignes de `categories` pendant la migration.
- Modèle renommé en `Computer.php`, avec la relation `category()`. Contrôleur et vues (création, modification, détail) mis à jour : la catégorie se choisit dans une liste déroulante.

**Carte #6 — données de démonstration**

- `CategorySeeder` : les 4 catégories de la maquette (Portables, PC de bureau, Gaming, Mini PC).
- `ComputerSeeder` : 20 ordinateurs répartis dans ces catégories (8, 4, 4, 4), avec les noms et les prix de la maquette quand ils existent.
- Les seeders utilisent `firstOrCreate` et `updateOrCreate` : on peut relancer `php artisan db:seed` sans créer de doublons.

**Organisation**

- `CLAUDE.md` à la racine : consignes lues par l'assistant à chaque session (déroulé d'une carte, captures de vérification dans `docs/captures/`).

### Choix de conception

| Choix | Raison |
|---|---|
| Images de démonstration générées en SVG (data URI) par le seeder | La colonne `image` contient l'image encodée ; pas de fichiers à télécharger ni de droits d'image à gérer |
| Les seeders ne suppriment aucune donnée | La base est aussi la base de travail ; les données de test restent à supprimer à la main |

### Difficultés rencontrées

- **Précision du prix.** La migration avait d'abord été écrite en DECIMAL(10,2) alors que la carte demandait DECIMAL(8,2) ; corrigé après relecture de la carte.
- **Tests automatiques.** `phpunit.xml` pointe sur la base de travail : les tests ne sont pas lancés tant qu'une base de test séparée n'est pas configurée.

### État en fin de séance

| Élément | État |
|---|---|
| Carte #4 (table `computers`) | Terminée en local, à commiter et pousser |
| Carte #6 (données de démonstration) | Terminée en local, à commiter et pousser |

## Séance du 12 octobre 2026

### Travail réalisé

**Cartes #3 et #4 — vérification et mise en ligne**

- Structure, clés étrangères et index des 7 tables relus en base : conformes aux deux cartes.
- Captures phpMyAdmin de la carte #3 ajoutées dans `docs/captures/carte-3/` (structure des 6 tables, clés étrangères), avec le commentaire de la carte.
- Un commit par carte, poussés sur `main`, ainsi que la carte #6, `CLAUDE.md` et l'outil de captures `tools/captures-pma.mjs`.

### État en fin de séance

| Élément | État |
|---|---|
| Carte #3 (tables) | Poussée, à vérifier puis clôturer |
| Carte #4 (table `computers`) | Poussée, à vérifier puis clôturer |
| Carte #6 (données de démonstration) | Poussée, à vérifier puis clôturer |

## Séance du 15 octobre 2026

### Travail réalisé

**Carte #7 — mise en page de la maquette**

- Layout commun (`layouts/app` et `layouts/guest`) : en-tête vert sapin avec le logo WoodyCraft, la navigation et le lien vers le panier ; nouveau pied de page brun (`layouts/footer`) ; fond beige.
- Les pages de connexion et d'inscription ont maintenant le même en-tête et le même pied de page que le reste du site.
- Couleurs de la maquette ajoutées à Tailwind (`cream`, `pine`, `bark`), polices Fraunces (titres) et DM Sans (texte) chargées depuis fonts.bunny.net. Liens de navigation, bouton principal et champs de saisie repris aux couleurs de la maquette.
- Nombre d'articles du panier : calculé dans `AppServiceProvider` (composeur de vue) en additionnant les quantités du panier du client connecté, ou du visiteur grâce à son identifiant de session.

**Carte #8 — US01 back : catégories sur la page d'accueil**

- Route `/` nommée `home`, qui appelle `HomeController@index` à la place de la page d'accueil par défaut de Laravel (`welcome`).
- Le contrôleur récupère toutes les catégories, triées par nom, et les transmet à la nouvelle vue `home`.
- La vue `home` affiche pour l'instant une simple liste des noms ; la mise en page de la maquette (cartes et liens) est le travail de la carte #25.
- Vérifié par une vraie requête HTTP sur `/` (code 200) : les 6 catégories de la base apparaissent sur la page.

**Carte #9 — US02 back : ordinateurs d'une catégorie**

- Route publique `/categories/{category}` nommée `categories.show`, qui appelle `CategoryController@show`.
- Le contrôleur ne récupère que les ordinateurs de la catégorie demandée (`$category->computers()`), triés par nom, et les transmet à la vue `categories.show`.
- Une catégorie inexistante renvoie une erreur 404 grâce à la liaison de modèle de la route (route model binding).
- La vue affiche une simple liste (nom et prix) ; la mise en page de la maquette est le travail de la carte #26.
- Vérifié en HTTP : `/categories/5` (Portables) renvoie les 8 portables, `/categories/3` (Tuff) son seul ordinateur, `/categories/999` une erreur 404. Les nombres correspondent à la base.

### Choix de conception

| Choix | Raison |
|---|---|
| Mode sombre de Tailwind passé en `class` | La maquette est en thème clair ; sans cela, un navigateur en mode sombre affichait des titres illisibles |
| Le lien « Panier » pointe vers `cart.index` seulement si la route existe | La page du panier sera créée par les cartes #12 et #29 ; d'ici là le lien ne mène nulle part |
| Le sélecteur FR / EN de la maquette n'est pas encore ajouté | Il relève de la carte #37 (version multilingue) |
| La page d'accueil est publique | Le sujet permet à un visiteur de parcourir le catalogue sans être connecté |
| Catégories triées par nom | Ordre stable et facile à parcourir pour le visiteur |
| Erreur 404 par la liaison de modèle (`Category $category`) | Laravel renvoie lui-même la 404 si l'id n'existe pas : pas de test à écrire à la main |

### Difficultés rencontrées

- **Fichiers de la maquette.** Les pages HTML d'origine ne sont plus sur le poste : la mise en page a été reprise à partir de la charte notée dans ce journal (couleurs, polices).
- **Preuve du compteur.** L'ajout au panier n'existe pas encore (carte #11) : pour la capture, un panier de 3 articles a été créé dans une transaction annulée juste après le rendu. La base n'a pas été modifiée (0 panier avant et après).
- **Push depuis l'assistant.** Git ne peut pas demander l'identifiant GitHub dans la session de l'assistant : le push se fait depuis VS Code ou un terminal ouvert à la main.

### État en fin de séance

| Élément | État |
|---|---|
| Carte #7 (mise en page) | Poussée, à vérifier puis clôturer |
| Carte #8 (US01 back) | Commitée, à pousser, vérifier puis clôturer |
| Carte #9 (US02 back) | Commitée, à pousser, vérifier puis clôturer |

### Outils utilisés

Laravel 10, MySQL, Laragon, VS Code, Figma et html.to.design, draw.io, GitHub (issues et projet), Claude Code (assistant IA).
