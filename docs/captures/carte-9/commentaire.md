**Route et contrôleur de la page d'une catégorie**

Route publique `/categories/{category}` (nommée `categories.show`), qui appelle `CategoryController@show` :

```
GET|HEAD  categories/{category}  categories.show › CategoryController@show
```

**Récupérer uniquement les ordinateurs de la catégorie demandée**

Le contrôleur passe par la relation `$category->computers()`, triée par nom. Dans la base, la catégorie Portables (id 5) contient 8 ordinateurs…

![Ordinateurs de la catégorie 5 dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-9/carte9-pma-ordinateurs-portables.png?raw=true)

…et la page `/categories/5` affiche exactement ces 8 ordinateurs, sans ceux des autres catégories :

![Page de la catégorie Portables](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-9/carte9-categorie-portables.png?raw=true)

**Erreur 404 si la catégorie n'existe pas**

`/categories/999` (aucune catégorie avec cet id) renvoie une erreur 404, grâce à la liaison de modèle de la route :

![Erreur 404 pour /categories/999](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-9/carte9-categorie-inexistante-404.png?raw=true)

**Non testé / à noter**

- La page est volontairement simple (nom et prix) : fil d'Ariane, grille de produits et message si la catégorie est vide relèvent de la carte #26.
- Les pages de l'accueil ne mènent pas encore vers les catégories : les liens sont prévus dans la carte #25.
- La page 404 est celle de Laravel par défaut, pas aux couleurs de la maquette.
- Pas de test automatique (`phpunit` pointe sur la base de travail).
