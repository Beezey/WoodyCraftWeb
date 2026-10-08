# Backlog — SP1 WoodyCraft

Liste des tâches de la SP1, à reporter dans le Kanban du repo (colonnes : Backlog, À faire, En cours, En test, Terminé).

## Conception

- [ ] Terminer la maquette Figma
- [ ] Modéliser la base de données (MCD, MLD, dictionnaire de données)
- [ ] Nettoyer le projet : retirer le CRUD `computers` du tutoriel

## Base de données

- [ ] Migration et modèle `categories`
- [ ] Migration et modèle `puzzles` (clé étrangère vers `categories`)
- [ ] Migration et modèle `adresses` (clé étrangère vers `users`)
- [ ] Migration et modèle `paniers` (clés étrangères vers `users` et `adresses`)
- [ ] Migration et modèle `lignes_panier` (clés étrangères vers `paniers` et `puzzles`)
- [ ] Relations Eloquent entre les modèles
- [ ] Seeders : catégories et puzzles de démonstration

## Catalogue (visiteur)

- [ ] Page d'accueil avec la liste des catégories
- [ ] Page liste des puzzles d'une catégorie
- [ ] Page détail d'un puzzle (image, description, prix, stock)
- [ ] Mise en page commune : en-tête, navigation, pied de page selon la maquette

## Compte client

- [ ] Adapter l'inscription et la connexion Breeze à la maquette
- [ ] Gestion des adresses du client (ajout, modification, suppression)

## Panier

- [ ] Ajouter un puzzle au panier
- [ ] Afficher le panier avec le total
- [ ] Modifier la quantité d'une ligne
- [ ] Supprimer une ligne du panier
- [ ] Vérifier le stock disponible lors de l'ajout

## Commande

- [ ] Choisir l'adresse de livraison
- [ ] Choisir le mode de paiement (chèque ou PayPal)
- [ ] Valider le panier : passage en commande et mise à jour du stock
- [ ] Page de confirmation avec récapitulatif de la commande
- [ ] Historique des commandes du client

## Qualité et livraison

- [ ] Validation des formulaires et messages d'erreur
- [ ] Tests des parcours principaux (catalogue, panier, commande)
- [ ] Mettre à jour le README (installation, configuration, lancement)
