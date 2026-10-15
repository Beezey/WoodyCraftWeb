**Route et contrôleur de la page d'accueil**

La route `/` (nommée `home`) appelle maintenant `HomeController@index` au lieu de la page par défaut de Laravel. Elle est publique : un visiteur non connecté y a accès (requête HTTP testée : code 200).

```
GET|HEAD  /  home › HomeController@index
```

**Récupérer toutes les catégories et les transmettre à la vue**

Le contrôleur récupère toutes les catégories, triées par nom, et les passe à la vue `home`. Les 6 catégories de la table `categories`…

![Table categories dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-8/carte8-pma-categories.png?raw=true)

…apparaissent toutes sur la page d'accueil, vue par un visiteur :

![Page d'accueil avec la liste des catégories](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-8/carte8-accueil.png?raw=true)

**Non testé / à noter**

- La liste est volontairement simple : la mise en page de la maquette (une carte par catégorie, avec un lien vers sa page) est le travail de la carte #25.
- Les catégories de test « Tuff » et « 5 » sont toujours en base, donc elles s'affichent aussi.
- La vue `welcome` de Laravel n'est plus utilisée, mais elle n'a pas été supprimée.
- Pas de test automatique (`phpunit` pointe sur la base de travail).
