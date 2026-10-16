**Ajouter `is_admin` à la table `users`**

Migration `2026_10_15_140000_add_is_admin_to_users_table` : colonne `is_admin` en `tinyint(1)` (booléen), non nulle, `0` par défaut. Le compte déjà inscrit reste un simple client.

![Structure de la table users dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-5/carte5-pma-structure-users.png?raw=true)

**Réserver les routes de gestion des ordinateurs à l'administrateur**

Middleware `EnsureUserIsAdmin` (alias `admin`) : erreur 403 si l'utilisateur n'est pas administrateur. Les routes `computers.index`, `create`, `store`, `edit`, `update`, `destroy` et `duplicate` sont sous `['auth', 'admin']` ; `computers.show` reste publique.

Résultats des requêtes :

| | `/computers` | `/computers/create` | `/computers/1/edit` | `/computers/1` |
|---|---|---|---|---|
| Visiteur | connexion | connexion | connexion | 200 |
| Client | 403 | 403 | 403 | 200 |
| Administrateur | 200 | 200 | 200 | 200 |

Un client connecté qui ouvre `/computers` :

![Erreur 403 pour un client](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-5/carte5-acces-client-403.png?raw=true)

L'administrateur sur la même page :

![Gestion des ordinateurs pour l'administrateur](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-5/carte5-acces-admin.png?raw=true)

**Créer un compte administrateur de démonstration**

`AdminSeeder` (appelé par `DatabaseSeeder`) : compte `admin@woodycraft.test`, mot de passe `password`, `is_admin` à 1.

![Comptes de la table users dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-5/carte5-pma-comptes-admin.png?raw=true)

**Non testé** : les routes en écriture (`store`, `update`, `destroy`, `duplicate`) n'ont pas été appelées par un client ; elles portent le même middleware (vérifié avec `php artisan route:list -v`). Pas de connexion réelle par le formulaire avec le compte admin : les requêtes ont été exécutées dans l'application avec l'utilisateur connecté. Retour arrière (`down()`) de la migration non testé. Les liens de gestion de l'en-tête restent visibles pour un client (partie front).
