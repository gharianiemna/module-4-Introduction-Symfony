
Pour cette activité, les objectifs sont: 
- travailler avec le service « FormBuilder» qui permet de travailler facillement les formulaires et 
donc d'enregistrer et manipuler des données dans la base de données.

Pour exécuter le code voici les différentes commandes:

1-composer i
2-symfony console doctrine:database:create
3-symfony console make:migration  
4-symfony console doctrine:migrations:migrate 
5-composer require server
6-php bin/console server:run

les routes sont:
@Route("/"): Home


@Route("/formulaire"): pour afficher le formulaire à remplir
 @Route("/Montant/display"):pour afficher la liste des Montants

@Route("/emailForm") : pour  ejouter une adresse email
@Route("/Email/display") : pour afficher la liste des email

@Route("/link") : pour  ejouter un link
@Route("/link/display") : pour afficher les link ajoutés


@Route("/Equipr") : pour  ejouter une equipe

Vous Pouvez Aussi utiliser le Navbar!