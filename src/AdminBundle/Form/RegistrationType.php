<?php

// src/AdminBundle/Form/RegistrationType.php

namespace AdminBundle\Form;

use AdminBundle\Entity\ClientPro;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;



class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$repository = $this->Doctrine()->getRepository(ClientPro::class);
        //$clientspro = $repository->findAll();

        $builder->add('type',ChoiceType::class,[
            'choices'  => [
                'Particulier' => 'Particulier',
                'ClientPro'=> 'Client pro'
            ],
            'empty_data' => 'Particulier'
        ])
                ->add('clientPro',EntityType::class,[
                    'class' => 'AdminBundle\Entity\ClientPro',
                    'multiple' => false,
                    'expanded' => false,
                    'required' => false,
                    'empty_data' => ''
                ])
                ->add('numeroTelephone')
                ->add('prenom')
                ->add('nom')
                ->add('canalDeCommunication')
                ->add('profession')
                ->add("valider",SubmitType::class);

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