<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoftInfoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rgpd', CheckboxType::class, array('label' => 'Compatible RGPD?'))
            ->add('customers', TextType::class, array('label' => 'Pour qui ?'))
            ->add('hostingCountry', TextType::class, array('label' => 'Pays d\'hébergement des données ?'))
            ->add('creationDate', TextType::class, array('label' => 'Date de création'))
            ->add('subscriptionCost', TextType::class, array('label' => 'Coût Abonnement annuel'))
            ->add('trainingCost', TextType::class, array('label' => 'Coût de formation'))
            ->add('webSite', UrlType::class, array('label' => 'Siteweb'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SoftInfo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_softinfo';
    }


}
