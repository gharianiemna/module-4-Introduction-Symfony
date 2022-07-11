
Pour cette activité, les objectifs sont: 
- réaliser un mini-site marchant avec modele MVC: Controlleur, son Routeur et Twig.
- écrire des entités Doctrine avec relation (de catégorie vers produits).
- migrer le modèle de données Doctrine vers la base de donnée 
- travailler avec « relation inverse » : accéder à la catégorie associée d'un objet a traver lui même.
- realiser un système de notifications lié au entités Doctrine


Pour exécuter le code voici les différentes commandes:

1-composer i
2-symfony console doctrine:database:create
3-symfony console make:migration  
4-symfony console doctrine:migrations:migrate 
5-composer require server
6-php bin/console server:run

les routes sont:
@Route("/create-cat/{name}") : pour ajouter une categorie

@Route("/createproduct"): pour ajouter un produit (il faut entrer au dossier controller fichier "Product controller" 
et la function : "create" pour changer les données)

@Route("/productsbycategory/{category_id}"): affiche la liste des produits par categorie

@Route("/product/{id}"): affiche les details d'un produit ainsi que 5 autres de la categorie

@Route("/user/{id}"): affiche le nom de l'utilisateurs et les messages qu'il a.