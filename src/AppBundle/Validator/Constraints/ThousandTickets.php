<?php

// src/AppBundle/Validator/Constraints/ThousandTickets.php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

 /**
  * @Annotation
  */
 class ThousandTickets extends Constraint
 {
   public $message = 'Plus de réservation disponible pour ce jour!';

   // Cible la classe Order
   public function getTargets() {
    return self::CLASS_CONSTRAINT;
   }
 }
