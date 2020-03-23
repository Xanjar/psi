# Psi

* Projet qui regroupe la gestion d'individus et de groupe d'individus dans une université. Les individus sont importable en csv/excel et les individus au seins d'un groupe sont exportable en csv/excel.

## Installation

* Installer php si ça n'est pas déjà fait
* Installer "composer"
* creer la base à l'aide du script sql
* pull ce projet
* lancer à la racine du projet: ```composer install```
* créer un .env si il n'est pas là en copiant le .env.example
* modifier les valeurs associé à database, username, password dans le .env
* modifier les mêmes valeurs mais dans le /config/database.php
* Enfin lancez la commande ```php artisan serve``` à la racine et allez au localhost dans votre navigateur

## Dépendances

* php
* Laravel 5.5
* Laravel Excel
* Bootsrap
* Font-awesome


## A venir

* api permettant de récuperer des individus au format Json/Xml.