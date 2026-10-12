**Remplacer la colonne `category` par `category_id`, clé étrangère vers `categories`, et passer `price` en DECIMAL(8,2)**

La colonne `category` a disparu, `category_id` est non nul avec une clé étrangère vers `categories.id`, et `price` est en `decimal(8,2)`. Les deux ordinateurs existants ont été conservés et rattachés à leur catégorie.

![Structure de la table computers dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-4/carte4-pma-structure.png?raw=true)

![Clé étrangère de computers dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-4/carte4-pma-relation.png?raw=true)

**Mettre à jour le modèle, le contrôleur et les vues existantes**

Formulaire de création : liste déroulante des catégories à la place du champ texte.

![Formulaire de création](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-4/carte4-create.png?raw=true)

Formulaire de modification : la catégorie de l'ordinateur est présélectionnée.

![Formulaire de modification](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-4/carte4-edit.png?raw=true)

Page détail : le nom de la catégorie est affiché via la relation `category()`.

![Page détail](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-4/carte4-show.png?raw=true)

**Non testé** : l'envoi des formulaires dans le navigateur, et le retour arrière (`down()`) de la migration.
