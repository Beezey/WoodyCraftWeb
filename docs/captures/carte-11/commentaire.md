**Route et contrôleur d'ajout au panier**

Nouvelle route publique `POST /cart/{computer}` (nommée `cart.add`), qui appelle `CartController@add`. Elle est protégée par le jeton CSRF de Laravel, comme tout formulaire, et renvoie le visiteur sur la page d'où il vient avec le message « Ordinateur ajouté au panier. ».

```
POST  cart/{computer}  cart.add › CartController@add
```

Testé par de vraies requêtes HTTP en visiteur non connecté (cookie de session et jeton CSRF) : `POST /cart/16` deux fois puis `POST /cart/32` → 302 vers la page de l'ordinateur ; l'en-tête affiche ensuite « Panier 3 ». Sans jeton CSRF → 419.

**Retrouver ou créer le panier (`user_id` si connecté, `session_id` sinon)**

Le panier est retrouvé ou créé par `Cart::currentOrCreate()` : par `user_id` si le visiteur est connecté, par `session_id` sinon. Le panier 6 a été créé par le visiteur non connecté (requêtes HTTP), le panier 7 par l'utilisateur 1 connecté (test dans tinker, en appelant le contrôleur après `Auth::login`) :

![Table carts dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-11/carte11-pma-carts.png?raw=true)

**Créer la ligne dans `cart_items`, ou augmenter sa quantité si l'ordinateur y est déjà**

Chaque ajout cherche la ligne de l'ordinateur dans le panier : si elle n'existe pas, elle est créée avec la quantité 1, sinon sa quantité augmente de 1. L'ordinateur 16 ajouté deux fois par le visiteur donne une seule ligne en quantité 2 ; l'ordinateur 28 ajouté trois fois par l'utilisateur connecté, une seule ligne en quantité 3 :

![Lignes des paniers dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-11/carte11-pma-cart_items.png?raw=true)

**Non testé / à noter**

- Le bouton « Ajouter au panier » et le message de confirmation sur la page du produit relèvent de la carte #28 : pour l'instant la route n'est appelée par aucun formulaire du site.
- Le cas « connecté » a été testé dans tinker, pas par une vraie connexion dans le navigateur.
- À la connexion, Laravel change l'identifiant de session : le panier créé avant la connexion n'est pas encore rattaché au compte. C'est la carte #14.
- Les paniers 6 et 7 sont des données de test, à supprimer après vérification.
- Pas de test automatique (`phpunit` pointe sur la base de travail).
