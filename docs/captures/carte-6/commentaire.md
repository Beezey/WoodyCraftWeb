**Seeder des catégories**

`CategorySeeder` crée les 4 catégories de la maquette : Portables, PC de bureau, Gaming, Mini PC.

![Table categories dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-6/carte6-pma-categories.png?raw=true)

**Seeder des ordinateurs, répartis dans les catégories**

`ComputerSeeder` crée 20 ordinateurs : 8 portables, 4 PC de bureau, 4 gaming, 4 mini PC, chacun avec un prix, une description et une image d'attente. Les deux seeders sont appelés par `DatabaseSeeder` (`php artisan db:seed`) et peuvent être relancés sans créer de doublons.

![Ordinateurs et leur catégorie dans phpMyAdmin](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-6/carte6-pma-computers.png?raw=true)

Les ordinateurs de démonstration dans la liste du site :

![Liste des ordinateurs](https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-6/carte6-liste.png?raw=true)

**À noter** : les deux ordinateurs de test (« PC 4509Xx », « pc cool ») et leurs catégories (« Tuff », « 5 ») sont toujours en base, les seeders ne suppriment rien.
