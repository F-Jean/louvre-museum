<?php

namespace AppBundle\Form;

use AppBundle\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
          ->add('visitDay',   DateType::class, array(
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',
          ))
          ->add('type',       ChoiceType::class, array (
            'choices' => array(
              'Journée' => 1,
              'Demi-journée' => 2)))
          ->add('email',      EmailType::class)

          /* argument1 : name of the field "tickets", because it's the attribute's name
             arg2 : type of the field "CollectionType" that construct a collection, a list
             arg3 : field's option's array */
          ->add('tickets',    CollectionType::class, array(
            'entry_type'    => TicketType::class, // entry_type the form create a list of TicketType
            'allow_add'     => true,
            'allow_delete'  => true,
          ));
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
