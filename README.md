# Symfony - Sessions de dormations

## 📋 Contexte du projet
Dans le cadre de votre formation en développement web, vous avez la charge de développer une application permettant de gérer des sessions de formations pour les administrateurs d’un centre de formation 

## 🎯 Objectifs pédagogiques
### Consignes
- Réaliser le MCD / MLD d'une telle application 
- Réaliser le maquettage (wireframe ou mock-up) en prenant soin de l’UX/UI
- Créer un Trello suivant la méthode MoSCoW 
- Réaliser l'application de gestion en respectant le design pattern MVC à l'aide du framework PHP Symfony.
- Réaliser une interface permettant d'ajouter des stagiaires et des sessions avec la possibilité de programmer les différents modules dans les sessions.

### Critères de performance
- Code structuré selon le pattern MVC
- Validation des données côté client ET serveur
- Sécurisation des requêtes SQL (requêtes préparées)
- Code commenté et indenté
- Gestion de l'authentification et des permissions

## 🔧 Technologies utilisées
### Languages
- HTML
- CSS
- JavaScript
- PHP
- Twig
- Symfony

### Outils
- Looping
- Figma
- Visual Studio Code
- Laragon
- Git/GitHub
- HeidiSQL

## 💡 Concepts clés abordés
- **Twig**
  - Affichage Conditionel
  - Gestion des formulaires
  - Création de Layouts
  
- **PHP / Symfony**
  - Sessions
  - Architecture MVC
  - Authentification
  - Server Side Rendering
  - Traitement et validation des données

## 📦 Installation et configuration
### Cloner le repository
```bash
git clone https://github.com/LouisHyt/Symfony-Sessions.git
cd Symfony-Sessions/code
```

### Installer les dépendances
```
composer install
```

### Créer la base de données
1. Modifier le dossier .env pour y spécifier le nom de votre base de donnée

2. Lancer les commandes suivantes :
```bash
symfony console doctrine:database:create 
symfony console make:migration
symfony console doctrine:migrations:migrate
```

3. Insérer un utilisateur avec "ROLE_ADMIN" dans le champ "role"

### Lancer l'application
```
symfony server:start
```
ou
```
symfony serve -d
```

## 🚀 Structure du projet
work in progress...

## ✨ Démonstration
### MCD & MLD
- Modèle Relationnel des données : ![Schéma Looping du model relationnel des données](/MCD-MLD/MCD.jpg)
  
- Modèle Logique des données : ![Schéma Looping du model Logique des données](/MCD-MLD/MLD.jpg)


## 🏆 Compétences visées
- Développer un panel administrateur
- Mettre en place une architecture MVC
- Gérer l'affichage des données
- Sécuriser et vérifier les données stockées
- Manipuler une base de données avec l'ORM doctrine
- Sécuriser le site et le base de donnée

---
Exercice réalisé dans le cadre de la formation Développeur Web Full Stack au sein d'Elan Formation
- 📅 Date : Janvier 2025
- ✍️ Auteur : Louis Hayotte
