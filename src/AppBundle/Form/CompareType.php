<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CompareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('software1', TextType::class, array('label' => 'Choisir le premier logiciel :', 'attr' => array('autocomplete' => 'off'), 'constraints' => array(new NotBlank())))
            ->add('software2', TextType::class, array('label' => 'Choisir le deuxième logiciel :', 'attr' => array('autocomplete' => 'off'), 'constraints' => array(new NotBlank())))
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }



}