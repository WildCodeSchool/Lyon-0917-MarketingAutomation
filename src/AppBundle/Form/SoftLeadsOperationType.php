<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoftLeadsOperationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isContactObject', CheckboxType::class, array('label' => 'Object contact ?'))
            ->add('isCompanyObject', CheckboxType::class, array('label' => 'Object société ?'))
            ->add('isDefinedFields', CheckboxType::class, array('label' => 'Champs personnalisés ?'))
            ->add('isIllimitedFields', CheckboxType::class, array('label' => 'Champs illimités ?'))
            ->add('isImportCsv', CheckboxType::class, array('label' => 'Imports CSV ?'))
            ->add('isAutoDuplicate', CheckboxType::class, array('label' => 'Déduplication automatique ?'))
            ->add('isLeadStages', CheckboxType::class, array('label' => 'Lead Stages ?'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SoftLeadsOperation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_softleadsoperation';
    }


}
