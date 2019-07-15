<?php

namespace AdminBundle\Form;

use AdminBundle\AdminBundle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('nom',EntityType::class, [
                    'class' => 'AdminBundle\Entity\Theme',
                    'multiple' => false,
                    'expanded' => false,
                ])
                ->add('dateDebut',DateType::class,[
                    'widget' => 'single_text',
                ])
                ->add('dateFin',DateType::class, [
                    'widget' => 'single_text',
                ])
                ->add('etat',ChoiceType::class, [
                    'choices'  => [
                    'planifié' => 'planifié',
                    'retardé' => 'retardé',
                    'en cours' => 'en cours',
                    'annulé' => 'annulé',
                    'terminé' => 'terminé' ,
                    ],
                    'empty_data' => 'planifié'
                ] )
                ->add('formateur',EntityType::class,[
                    'class' => 'AdminBundle\Entity\Formateur',
                    'multiple' => false,
                    'expanded' => false,
                ] )
                /*->add('user',EntityType::class, [
                    'class' => 'AdminBundle\Entity\User',
                    'placeholder' => 'Choisir les utilisateurs',
                    'multiple' => true,
                    'expanded' => true
                ])*/
                ->add('valider',SubmitType::class);
    }
    /**
     * {@inheritdoc}
     */

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Session'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_session';
    }


}
