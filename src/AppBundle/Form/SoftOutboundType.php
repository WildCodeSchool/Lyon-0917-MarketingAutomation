<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoftOutboundType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isEmail', CheckboxType::class, array('label' => 'Email ?'))
            ->add('isSms', CheckboxType::class, array('label' => 'SMS ?'))
            ->add('isPopin', CheckboxType::class, array('label' => 'Popin sur le site ?'))
            ->add('isMailPostal', CheckboxType::class, array('label' => 'Courrier postal'))
            ->add('isCallCenter', CheckboxType::class, array('label' => 'Centre d\'appel ?'))
            ->add('isPushMobile', CheckboxType::class, array('label' => 'Notification mobile ?'))
            ->add('isApi', CheckboxType::class, array('label' => 'Appel API ?'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SoftOutbound'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_softoutbound';
    }


}
