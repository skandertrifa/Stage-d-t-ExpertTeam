<?php

// src/AdminBundle/Form/RegistrationType.php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type',ChoiceType::class,[
            'choices'  => [
                'Particulier' => 'planifié',

            ],
            'empty_data' => 'Particuler'
        ])
                ->add('numeroTelephone')
                ->add('prenom')
                ->add('nom')
                ->add('canalDeCommunication')
                ->add('profession');

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}