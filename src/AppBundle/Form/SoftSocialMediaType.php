<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoftSocialMediaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isTwitterMonitoring', CheckboxType::class, array('label' => 'Monitoring Twitter ?'))
            ->add('isTwitterAutoPublication', CheckboxType::class, array('label' => 'Autopublication Twitter ?'))
            ->add('isFacebookMonitoring', CheckboxType::class, array('label' => 'Monitoring Facebook ?'))
            ->add('isFacebookAutoPublication', CheckboxType::class, array('label' => 'Autopublication Facebook ?'))
            ->add('isLinkedinMonitoring', CheckboxType::class, array('label' => 'Monitoring Linkedin ?'))
            ->add('isLinkedinAutoPublication', CheckboxType::class, array('label' => 'Autopublication Linkedin ?'))
            ->add('isInstagramMonitoring', CheckboxType::class, array('label' => 'Monitoring Instagram ?'))
            ->add('isInstagramAutoPublication', CheckboxType::class, array('label' => 'Autopublication Instagram ?'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SoftSocialMedia'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_softsocialmedia';
    }


}
