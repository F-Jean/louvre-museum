<?php

// src/AppBundle/Controller/TicketController.php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

/**
 * Class TicketController
 */
class TicketController extends Controller
{

  public function showAction()
  {
    // Cree objet Order (pour une nouvelle commande)
    $order = new Order();

    // Cree le FormBuilder grace au service form factory
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $order);

    // Ajout des champs de l'entite que l'on veut a notre formulaire
    $formBuilder
      ->add('visitDay',       DateType::class)
      ->add('type',           TextType::class)
      ->add('ticketQuantity', IntegerType::class)
      ->add('email',          EmailType::class)
      ->add('save',           SubmitType::class)
      ;

    // Generation du formulaire a partir du FormBuilder
    $form = $formBuilder->getForm();

    //On passe la methode createView() du formulaire a la vue
    //afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('AppBundle:form:step1.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}

/* Rappel FORMULAIRE SYMFONY
Un formulaire se construit sur un objet existant, et son objectif est d'hydrater cet objet.
Les entités sont de simples objets avant d'être des entités.
Hydrater est un terme précis pour dire que le formulaire va remplir les attributs de l'objet avec les valeurs entrées par le visiteur.
Faire $objet->setAuthor('nom'),$objet->setDate(new \Datetime()), etc.

Le formulaire en lui-même n'a donc comme seul objectif que d'hydrater un objet.
Ce n'est qu'une fois l'objet hydraté que vous pourrez en faire ce que vous voudrez.
Ex : enregistrer en base de données, envoyer un e-mail dans le cas d'un objetContact, etc.
Le système de formulaire ne s'occupe pas de ce que vous faites de votre objet, il ne fait que l'hydrater.

*/
