**Route et contrôleur de suppression d'une ligne du panier**

Nouvelle route `DELETE /cart/items/{item}` (nommée `cart.destroy`), qui appelle `CartController@destroy`. La ligne est supprimée, puis le visiteur revient sur la page du panier avec le message « Ordinateur retiré du panier. ».

```
DELETE  cart/items/{item}  cart.destroy › CartController@destroy
```

Testé par une vraie requête HTTP en visiteur non connecté : suppression de la ligne 8 (Mini PC Bouleau) de son propre panier → 302 vers `/cart`. Le panier ne contient plus que le Portable Érable 14, et le total est recalculé :

![Panier après la suppression d'une ligne](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-13/carte13-panier-apres-suppression.png?raw=true)

**Vérifier que la ligne appartient bien au panier du visiteur**

Avant de supprimer, le contrôleur compare le panier de la ligne avec celui du visiteur (`Cart::current()`) : si ce n'est pas le sien, il répond 403. C'est la même vérification que pour la modification de la quantité (carte #12).

Le même visiteur a essayé de supprimer la ligne 10, qui appartient au panier de l'utilisateur 1 → 403 (une ligne inexistante → 404) :

![Réponse 403 pour la ligne d'un autre panier](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-13/carte13-ligne-autre-panier-403.png?raw=true)

En base, la ligne 8 a bien disparu et la ligne 10 de l'autre panier est toujours là :

![Lignes des paniers après les deux essais](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-13/carte13-pma-cart_items.png?raw=true)

**Non testé / à noter**

- Le bouton de suppression sur chaque ligne du panier relève de la carte #30 : la suppression a été testée par requêtes HTTP, pas depuis un formulaire.
- La page 403 est celle de Laravel par défaut.
- Le panier vidé de sa dernière ligne reste en base (sans ligne) ; il sera réutilisé au prochain ajout.
- Pas de test automatique (`phpunit` pointe sur la base de travail).
