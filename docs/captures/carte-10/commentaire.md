**Route et contrôleur de la page d'un ordinateur, accessibles sans connexion**

La route `computers.show` est sortie du groupe protégé par `auth` : elle est maintenant publique. Les autres routes de gestion (liste, création, modification, suppression, duplication) demandent toujours une connexion.

```
GET|HEAD  computers/{computer}  computers.show › computerController@show
```

Requêtes HTTP sans être connecté : `/computers/16` → 200, `/computers/99999` → 404, `/computers/create` et `/computers` → redirection vers `/login`.

La page de l'ordinateur 16, vue par un visiteur non connecté (bouton « Se connecter » dans l'en-tête) :

![Page d'un ordinateur vue par un visiteur](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-10/carte10-page-ordinateur-visiteur.png?raw=true)

**Récupérer l'ordinateur avec sa catégorie**

Le contrôleur charge la relation (`$computer->load('category')`). En base, l'ordinateur 16 a la catégorie 5, « Portables », et c'est bien ce que la page affiche :

![Ordinateur 16 et sa catégorie dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-10/carte10-pma-ordinateur-categorie.png?raw=true)

**Non testé / à noter**

- La page garde son ancienne présentation ; la mise en page de la maquette est le travail de la carte #27.
- Le lien « Retour » mène à la liste de gestion des ordinateurs, réservée aux utilisateurs connectés : un visiteur qui clique dessus arrive sur la page de connexion. À revoir dans la carte #27.
- Pas de test automatique (`phpunit` pointe sur la base de travail).
