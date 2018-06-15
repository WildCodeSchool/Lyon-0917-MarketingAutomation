<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoftMarketingCampaignType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isAutoResponder', CheckboxType::class, array('label' => 'Auto-répondeur ?'))
            ->add('isLeadScoring', CheckboxType::class, array('label' => 'Lead Scoring ?'))
            ->add('isCreationCampaign', CheckboxType::class, array('label' => 'Création de campagne ?'))
            ->add('isDripMarketingCampaign', CheckboxType::class, array('label' => 'Campagnes drip marketing ?'))
            ->add('isDragAndDrop', CheckboxType::class, array('label' => 'Editeur en drag and drop ?'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SoftMarketingCampaign'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_softmarketingcampaign';
    }


}
