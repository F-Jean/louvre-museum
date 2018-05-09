<?php

// src/AppBundle/Form/OrderType.php

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
        ->add('visitDay',     DateType::class, [
              'label' => 'Date de la visite :',
              'widget' => 'single_text',
              'format' => 'dd/MM/yyyy',
              'attr' => [
                  'class' => 'datetimepicker',
              ],
              'invalid_message' => 'Veuillez saisir une date au bon format.',
          ])
          ->add('type',       ChoiceType::class, array (
            'label' => 'Type de billet',
            'choices' => array(
              'Journée' => 1,
              'Demi-journée' => 2),
            'attr' => [
                'data-rules' => json_encode([
                  'required' => true,
                  'regex' => "^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$"
                ]),
                'data-messages' => json_encode([
                  'required' => "Veuillez sélectionner une date.",
                  'regex' => "Veuillez saisir une date valide."
                ]),
                'class' => 'input_validation'
            ]))
          ->add('email',      EmailType::class, array (
            'label' => 'Email',
            'attr' => [
                'data-rules' => json_encode([
                    'email' => true,
                  ]),
                'data-messages' => json_encode([
                    'email' => 'Veuillez saisir une adresse email.',
                  ]),
                'class' => 'input_validation'
            ]))

          /* argument1 : name of the field "tickets", because it's the attribute's name
             arg2 : type of the field "CollectionType" that construct a collection, a list
             arg3 : field's option's array */
          ->add('tickets',    CollectionType::class, array(
            'label' => false,
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
