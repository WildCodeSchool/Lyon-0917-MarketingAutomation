<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class SoftSupportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isEmailSupport', CheckboxType::class, array('data' => false, 'label' => 'Support E-mail? '))
            ->add('isPhoneSupport', CheckboxType::class, array('data' => false, 'label' => 'Support téléphonique ? '))
            ->add('isChatSupport', CheckboxType::class, array('data' => false, 'label' => 'Support par chat ? '))
            ->add('isKnowledgeBase', CheckboxType::class, array('data' => false, 'label' => 'Base de connaissance ? '))
            ->add('knowledgeBaseLanguage', TextType::class, array('data' => false, 'label' => 'Langues dispos pour la base de connaissance ? '))
            ->add('isTechnicalDocument', CheckboxType::class, array('data' => false, 'label' => 'Documentation ? '));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SoftSupport'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_softsupport';
    }


}
