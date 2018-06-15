<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoftCommSupportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isLandingPage', CheckboxType::class, array('label' => 'Page d\'atterrissage ?'))
            ->add('isForm', CheckboxType::class, array('label' => 'Formulaire?'))
            ->add('isTracking', CheckboxType::class, array('label' => 'Code de suivi?'))
            ->add('isLiveChat', CheckboxType::class, array('label' => 'Live tchat ?'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SoftCommSupport'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_softcommsupport';
    }


}
