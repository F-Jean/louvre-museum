louvre-museum
=============

A Symfony project created on November 4, 2017, 6:05 pm.

_ Afficher les tarifs --> devis en dynamique (cf bootstrap 3 section javascript --> affix)
_ Remplacer le btn 'Continue' par l'id ou la class du btn 'Ajouter un billet' (renommé le btn)
--> faire un vrai btn (pas en symfony)
_ Pour que btn 'Ajouter un billet' & 'Terminer' se repositionne sous chaque nvx billet ajouté, faire une div
qui contient tous les billet et la placée au dessus des 2 btn
_ Champs 'birthdayDate', utiliser un widget calendrier --> installer un script datepicker dans le form symfony
--> widget single text --> format
_ $this -> redirect("Homepage");
_ Implémenter message 'Commande réussie' avant redirection
--> $this -> addFlash('notice', "Commande réussie");
_ Finir contraintes avec les callbacks (crées une méthode dans l'entité pour testé ce que l'on veut) :
  _ champs date de visite, pas possible de commander le mardi, le dimanche
                                                     1er mai
                                                     1er novembre
                                                     25 décembre
                                                     jours + 1000 billets vendus

  _ type, si 14h passées dsipo que demi-journée (+ pop-up 'entrée à 14h')
  _ birthdayDate, ne peut pas être supérieur à la date du jour,
  _ Finir mise en forme esthétique
  _ Pourquoi mes champs du form ticket ne sont pas reconnu dans ma vue twig ? (cascade ?)
