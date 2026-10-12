**Migrations avec les clés étrangères**

Les 6 tables sont créées par 6 migrations : `categories`, `addresses`, `carts`, `cart_items`, `orders`, `order_items`.

`categories` : le nom est unique, sur 100 caractères.

![Structure de la table categories dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-3/carte3-pma-structure-categories.png?raw=true)

`addresses` : clé étrangère `user_id` vers `users.id`, les adresses sont supprimées avec le compte.

![Structure de la table addresses dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-3/carte3-pma-structure-addresses.png?raw=true)

![Clé étrangère de addresses dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-3/carte3-pma-relation-addresses.png?raw=true)

`carts` : `user_id` (client connecté) et `session_id` (visiteur) sont facultatifs et uniques, donc un seul panier par client.

![Structure de la table carts dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-3/carte3-pma-structure-carts.png?raw=true)

![Clé étrangère de carts dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-3/carte3-pma-relation-carts.png?raw=true)

`cart_items` : clés étrangères vers `carts.id` et `computers.id`, les lignes sont supprimées avec le panier.

![Clés étrangères de cart_items dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-3/carte3-pma-relation-cart_items.png?raw=true)

`orders` : clés étrangères vers `users.id` et `addresses.id`, total en `decimal(10,2)`.

![Structure de la table orders dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-3/carte3-pma-structure-orders.png?raw=true)

![Clés étrangères de orders dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-3/carte3-pma-relation-orders.png?raw=true)

`order_items` : clés étrangères vers `orders.id` (suppression en cascade) et `computers.id` (suppression refusée : un ordinateur déjà commandé ne peut pas être supprimé).

![Clés étrangères de order_items dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-3/carte3-pma-relation-order_items.png?raw=true)

**Modèles et relations Eloquent**

6 modèles dans `app/Models` : `Category`, `Address`, `Cart`, `CartItem`, `Order`, `OrderItem`, avec leurs relations (`belongsTo`, `hasMany`). Le modèle `User` reçoit `addresses()`, `cart()` et `orders()`. Pas de capture : ce sont des fichiers PHP, les relations ont été chargées sans erreur avec `php artisan tinker`.

**Contraintes d'unicité sur `cart_items` et `order_items`**

Index unique `cart_items_cart_id_computer_id_unique` sur (`cart_id`, `computer_id`) : un ordinateur n'apparaît qu'une fois par panier.

![Structure et index de cart_items dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-3/carte3-pma-structure-cart_items.png?raw=true)

Index unique `order_items_order_id_computer_id_unique` sur (`order_id`, `computer_id`).

![Structure et index de order_items dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-3/carte3-pma-structure-order_items.png?raw=true)

**Non testé** : le retour arrière (`down()`) des migrations, et les tests automatiques (`phpunit.xml` pointe sur la base de travail). Les tables sont vides : les relations Eloquent n'ont pas été essayées avec de vraies lignes.
