<?php

namespace AppBundle\Form;

use AppBundle\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use AppBundle\Form\TicketType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class OrderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('visitDay',       DateType::class)
          ->add('type',           ChoiceType::class, array (
            'choices' => array('Journée' => true, 'Demi-journée' => false)))
          ->add('email',          EmailType::class)
          ->add('save',           SubmitType::class)

          /* argument1 : nom du champs "tickets", car c'est le nom de l'attributs
             arg2 : type du champs "CollectionType" construit une collection, une liste
             arg3 : tableau d'option du champ*/
          ->add('tickets', CollectionType::class, array(
            'entry_type'    => TicketType::class, // entry_type le formulaire crée une liste de TicketType
            'allow_add'     => true,
            'allow_delete'  => true,
          ))
          ->add('save',           SubmitType::class);

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Order'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_order';
    }


}
