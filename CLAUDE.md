# WoodyCraft Web

Projet de BTS SIO SLAM (situation professionnelle 1) : site d'e-commerce en Laravel 10 et MySQL.
Le sujet parle de puzzles 3D ; le projet vend des ordinateurs (`computers`). Garder les ordinateurs sauf demande contraire.

- Dépôt : https://github.com/Beezey/WoodyCraftWeb (public, branche `main`)
- Backlog : les issues GitHub du dépôt, appelées « cartes ». « Fais la carte 5 » = l'issue #5.
- Suivi : `docs/journal-de-bord.md` (choix de conception, état, prochaines étapes). Modélisation : `docs/modelisation.drawio`.
- Répondre en français. Code, tables et colonnes en anglais ; commentaires et messages de commit en français.

## Environnement (Windows, Laragon)

- `git` n'est pas dans le PATH : utiliser `C:\laragon\bin\git\cmd\git.exe`.
- `php`, `node` et `npm` sont dans le PATH. `gh` n'est pas installé.
- Navigateur pour les captures : `C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe`.
- Lire un PDF : `C:\laragon\bin\git\mingw64\bin\pdftotext.exe -layout -enc UTF-8 <pdf> <txt>`.
- La base (`eleve10`, voir `.env`) est la vraie base de travail, sur le serveur du lycée.
  - **Ne jamais lancer `phpunit`, `migrate:fresh`, `migrate:refresh` ni `db:wipe`** : `phpunit.xml` pointe sur cette base et les tests Breeze la videraient.
  - `php artisan migrate` est autorisé. Faire `migrate --pretend` d'abord, et conserver les données existantes dans les migrations qui modifient une table.

## Faire une carte

1. **Lire la carte** : `https://api.github.com/repos/Beezey/WoodyCraftWeb/issues/<n>` (lecture anonyme possible). La liste de tâches de la carte fait foi, au détail près (types, tailles de colonnes, noms).
2. **Coder** uniquement ce que la carte demande, dans le style du code existant.
3. **Vérifier** : migration passée, données relues en base, vues concernées rendues sans erreur.
4. **Relire la liste de tâches de la carte point par point** avant d'annoncer que c'est fini.
5. **Prendre les captures** (section suivante) dans `docs/captures/carte-<n>/`.
6. **Ajouter une entrée** dans `docs/journal-de-bord.md` (travail réalisé, choix, difficultés).
7. **Commiter** : un commit par carte, message en français commençant par `Carte #<n> : `.
8. **Pousser et commenter la carte** (dernière section).
9. Finir par un résumé : ce qui est fait, ce qui n'a pas été testé, les captures produites.

## Captures de vérification

Elles servent à prouver, dans un commentaire de la carte, que chaque tâche est faite. Une capture par chose à prouver, nommée `carte<n>-<sujet>.png`.

- **Carte back (base de données)** : de vraies captures de phpMyAdmin, nommées `carte<n>-pma-<sujet>.png`. Jamais de page de preuve fabriquée à la place.
- **Carte front ou vues modifiées** : une capture de chaque page concernée, avec de vraies données.

### phpMyAdmin

phpMyAdmin est sur `http://<DB_HOST>/phpmyadmin/` (version 5.2). Le script `tools/captures-pma.mjs` s'y connecte avec les identifiants de `.env` et prend les captures :

```powershell
node tools\captures-pma.mjs C:\laragon\www\WoodyCraftWeb <tmp>\shots.json
```

`shots.json` (dans le dossier temporaire) est une liste de `{ "url", "out", "height", "js" }`. `{db}` est remplacé par le nom de la base. Hauteur 765 par défaut, à augmenter si le tableau est coupé.

- Structure d'une table : `index.php?route=/table/structure&db={db}&table=<table>`
- Clés étrangères : `index.php?route=/table/relation&db={db}&table=<table>`
- Contenu d'une table : `index.php?route=/sql&db={db}&table=<table>&pos=0`
- Requête libre (jointure, colonnes choisies) : une requête passée dans l'URL ne marche pas. Ouvrir `index.php?route=/database/sql&db={db}` et donner dans `js` deux étapes : la première met la requête dans tous les éditeurs `.CodeMirror` hors `#pma_console` et dans `#sqlquery`, puis clique sur `#button_submit_query` ; la seconde fait `window.scrollTo(0, 0)`.
- Pour une table avec des colonnes longues (`computers.image`, `description`), préférer une requête libre qui ne sélectionne que les colonnes utiles.
- Lancer le script avec une limite de temps, et vérifier ensuite qu'il ne reste pas de processus `msedge` avec `edge-pma-profile` dans sa ligne de commande.

### Pages du site

Méthode (ne modifie pas le code de l'application) :

1. Lancer `php artisan serve --host=127.0.0.1 --port=8123` en arrière-plan, pour servir le CSS de `public/build`.
2. Écrire dans le dossier temporaire un script PHP exécuté avec `php artisan tinker <script.php>` qui :
   - appelle `URL::forceRootUrl('http://127.0.0.1:8123')` ;
   - partage `errors` (`view()->share('errors', new ViewErrorBag)`) et connecte un utilisateur (`Auth::login(User::first())`) pour les pages protégées ;
   - enregistre le HTML de chaque vue avec `view(...)->render()`, et la page de preuve BDD.
3. Capturer chaque fichier HTML avec Edge sans interface :
   ```powershell
   Start-Process -Wait -FilePath $edge -ArgumentList "--headless=new","--disable-gpu","--hide-scrollbars","--blink-settings=preferredColorScheme=1","--user-data-dir=`"<tmp>\edge-profile`"","--window-size=1440,<hauteur>","--screenshot=`"<png>`"","`"file:///<html>`""
   ```
   `preferredColorScheme=1` force le mode clair (en mode sombre certains titres sont illisibles). Ajuster la hauteur pour que rien ne soit coupé.
4. **Ouvrir chaque capture pour la contrôler**, puis arrêter le serveur du port 8123.
5. Si une valeur change après coup, refaire la capture concernée.

## Pousser et commenter la carte

Les images d'un commentaire doivent être en ligne : elles sont donc commitées dans `docs/captures/carte-<n>/` et poussées avant de commenter.

- Lien d'image à utiliser : `https://github.com/Beezey/WoodyCraftWeb/blob/main/docs/captures/carte-<n>/<fichier>.png?raw=true`
- Format du commentaire : une phrase par tâche de la carte, suivie de sa capture, puis la liste de ce qui n'a pas été testé.
- Si `gh` est installé et connecté (`gh auth status`) : `gh issue comment <n> --repo Beezey/WoodyCraftWeb --body-file <fichier.md>`, puis donner le lien du commentaire.
- Sinon : écrire le commentaire dans `docs/captures/carte-<n>/commentaire.md` et dire à Gwendal de le coller dans la carte. Ne pas aller chercher le jeton GitHub dans le gestionnaire d'identifiants de git.
- Ne pas fermer la carte ni la déplacer dans le Kanban : c'est Gwendal qui le fait après vérification.
