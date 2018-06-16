<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoftOtherFunctionnalitiesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isProviderEmailChoice', CheckboxType::class, array('label' => 'Choix du provider Email?'))
            ->add('isBlogEdition', CheckboxType::class, array('label' => 'Edition de blog ?'))
            ->add('isTouchPad', CheckboxType::class, array('label' => 'Tablette en magasin	 ?'))
            ->add('isSmtpRelay', CheckboxType::class, array('label' => 'SMTP relais ?'))
            ->add('isRssToEmail', CheckboxType::class, array('label' => 'RSS to Email ?  ?'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SoftOtherFunctionnalities'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_softotherfunctionnalities';
    }


}
