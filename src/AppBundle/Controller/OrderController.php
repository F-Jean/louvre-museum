<?php

// src/AppBundle/Controller/OrderController.php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Entity\Ticket;
use AppBundle\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class OrderController
 */
class OrderController extends Controller
{

  public function showAction(Request $request)
  {
    // Creation of the Order's object
    $order = new Order();

    // Create the FormBuilder via the form factory's service
    $form = $this->createForm(OrderType::class, $order);

    //
    $form ->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $order = $form->getData();

      //Saving of $order in database
      $em = $this->getDoctrine()->getManager();
      $em->persist($order);
      $em->flush();

      $this->addFlash('notice', 'Commande réussie');
      return $this->redirectToRoute("homepage");
    }

    /*We carry out the method createView() of the form to the view
    in order that it can display the form on it owns */
    return $this->render('AppBundle:defaults:index.html.twig', array(
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
