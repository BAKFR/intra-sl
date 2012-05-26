Intranet Epitech Security Lab
=============================

Il s'agit du code source de l'intranet de l'association Security Lab, de l'école EPITECH Lyon.

Le code est basé sur Symfony2.

Fork
-----

Pour avoir un intranet fonctionnel après fork, vous devez executer la commande  `php bin/vendors install`  
Vous devez également définir le fichier de paramètre `app/config/parameters.ini`,
avec les différents champs nécessaire pour configurer l'accès à la base de donnée.
Voir la doc de symfony 2 pour plus de détails.

CHANGELOG
---------

 - Première version posté sur Github:  
   Listing des membres, des groupes, et des entreprises.  
   Possibilité d'ajouter des tests (logs).  
   Les champs date et datetime ont maintenant un datepicker.
   - Les sauts de ligne sont pris en compte sur la page de vue des tests
   - La liste des membres d'un groupe s'affiche dans la description de celui-ci
   - Regroupement des pages entreprises et tests, avec une meilleure lisibilité
   