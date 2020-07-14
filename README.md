# contact_form

Pour faire fonctionner ce formulaire de contact il faut un serveur (exemple wamp) ensuite utiliser la commande : symfony server:start

Accessible sur le : http://localhost:8000/

Pour ajouter un admin utiliser la commande : php bin/console doctrine:fixtures:load
Il est possible de configurer le nom de le mot de passer de l'admin dans : src/DataFixtures/UserFixtures.php

Pour accéder aux outils administrateur se rendre sur : http://localhost:8000/admin
