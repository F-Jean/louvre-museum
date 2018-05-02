<?php

// src/AppBundle/Form/TicketType.php

namespace AppBundle\Form;

use AppBundle\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('firstName',    TextType::class, array (
            'label' => 'Nom',
            'attr' => [
                'data-rules' => json_encode([
                    'required' => true,
                    'minlength' => '2'
                  ]),
                'data-messages' => json_encode([
                    'required' => 'Veuillez remplir ce champ',
                    'minlength' => 'Votre nom doit contenir au moins 2 lettres'
                  ]),
                'class' => 'input_validation'
              ]
          ))
          ->add('lastName',     TextType::class, array (
            'label' => 'Prénom',
          ))
          ->add('country',      TextType::class, array (
            'label' => 'Pays',
          ))
          ->add('birthdayDate', DateType::class, array(
            'label' => 'Date de naissance',
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',
          ))
          ->add('reducedPrice', CheckboxType::class, array(
            'label' => 'Réduction',
            'required' => false));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ticket';
    }


}
