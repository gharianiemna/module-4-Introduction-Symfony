Poue cette activité, les objectifs sont: 
-réaliser un mini-site personnel avec modele MVC: Controlleur, son Routeur et Twig.
-écrire une Entité Doctrine.
- migrer le modèle de données Doctrine vers la base de donnée 
- creer dans le controller, differentes routes pour afficher et modifier les données via doctrine 

Pour exécuter le code voici les différentes commandes:

1-composer i
2-symfony console doctrine:database:create
3-symfony console make:migration  
4-symfony console doctrine:migrations:migrate 
5-composer require server
6-php bin/console server:run