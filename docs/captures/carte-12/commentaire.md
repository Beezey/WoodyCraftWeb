**Route et contrôleur de mise à jour d'une ligne du panier**

Nouvelle route `PATCH /cart/items/{item}` (nommée `cart.update`), qui appelle `CartController@update`. Le contrôleur vérifie d'abord que la ligne est bien dans le panier du visiteur (sinon erreur 403), puis enregistre la nouvelle quantité et renvoie sur la page du panier avec le message « Quantité mise à jour. ».

```
GET|HEAD  cart               cart.index  › CartController@index
PATCH     cart/items/{item}  cart.update › CartController@update
```

Testé par de vraies requêtes HTTP en visiteur non connecté : la ligne 7 (Portable Érable 14) passe de 2 à 4. La ligne 9, qui appartient au panier d'un autre utilisateur → 403 ; une ligne inexistante → 404.

![Panier après la mise à jour de la quantité](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-12/carte12-panier-quantite-totaux.png?raw=true)

**Valider la quantité (entier supérieur ou égal à 1)**

Règle de validation : `required|integer|min:1`. Les valeurs `0`, `abc`, `2.5` et vide sont refusées : le visiteur revient sur le panier avec le message d'erreur, et la quantité en base ne change pas (toujours 4).

![Message d'erreur pour une quantité de 0](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-12/carte12-panier-quantite-invalide.png?raw=true)

**Calculer le total de chaque ligne et le total du panier**

Deux méthodes dans les modèles : `CartItem::total()` (prix de l'ordinateur × quantité) et `Cart::total()` (somme des totaux des lignes). La page du panier (`GET /cart`, `CartController@index`) les affiche : 4 × 749,00 = 2 996,00 €, 1 × 429,00 = 429,00 €, total 3 425,00 € (captures ci-dessus). Les mêmes calculs faits en SQL dans phpMyAdmin donnent les mêmes montants :

![Total de chaque ligne en SQL](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-12/carte12-pma-lignes-totaux.png?raw=true)

![Total du panier en SQL](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-12/carte12-pma-total-panier.png?raw=true)

**Non testé / à noter**

- La page du panier est un simple tableau, sans boutons + et − : la mise en page de la maquette, les boutons et le message « panier vide » relèvent de la carte #29. La mise à jour a donc été testée par requêtes HTTP, pas depuis un formulaire.
- Le lien « Panier » de l'en-tête mène maintenant à cette page.
- Pas de test automatique (`phpunit` pointe sur la base de travail).
