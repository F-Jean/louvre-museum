<?php

// src/AppBundle/Validator/Constraints/ThousandTicketsValidator.php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Ticket;

 /**
  * Class ThousandTicketsValidator
  */
 class ThousandTicketsValidator extends ConstraintValidator {

   private $entityManager;
   public function __construct(EntityManagerInterface $entityManager) {
     $this->entityManager = $entityManager;
   }

   // $protocol car on cible une classe
   public function validate($protocol, Constraint $constraint) {

     // $protocol -> Order
     if($this->entityManager->getRepository(Ticket::class)->countTicketsByVisitDay($protocol->getVisitDay()) + count($protocol->getTickets()) > 1000){
     $this->context->buildViolation($contraint->message)
           ->atPath("visitDay")
           ->addViolation();
     }

   }

 }
