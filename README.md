louvre-museum
=============

A Symfony project created on November 4, 2017, 6:05 pm.

_ Champs 'birthdayDate', utiliser un widget calendrier --> installer un script datepicker dans le form symfony
--> widget single text --> format

_ Finir contraintes avec les callbacks (crées une méthode dans l'entité pour testé ce que l'on veut) :

  _ champs date de visite, pas possible de commander le mardi, le dimanche
                                                     1er mai
                                                     1er novembre
                                                     25 décembre
                                                     jours + 1000 billets vendus

  _ type, si 14h passées dsipo que demi-journée (+ pop-up 'entrée à 14h')
  _ birthdayDate, ne peut pas être supérieur à la date du jour,

_ Afficher les tarifs --> devis en dynamique (cf bootstrap 3 section javascript --> affix)
