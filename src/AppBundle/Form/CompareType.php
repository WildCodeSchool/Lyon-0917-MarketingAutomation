<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\Session\Session;


class CompareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $session = new Session();
        if ($session->get('versus1') != null){

            $placeholder1 = $session->get('versus1');
        }else{
            $placeholder1 = '';
        }
        if ($session->get('versus2') != null){
            $placeholder2 = $session->get('versus2');
        }else{
            $placeholder2 = '';
        }
        $session->invalidate();
        $builder
            ->add('software1', TextType::class, array(
                'label' => 'Choisir le premier logiciel :',
                'attr' => array('autocomplete' => 'off', 'placeholder' => $placeholder1),
                'constraints' => array(new NotBlank()),

            ))
            ->add('software2', TextType::class, array(
                'label' => 'Choisir le deuxième logiciel :',
                'attr' => array('autocomplete' => 'off','placeholder' => $placeholder2),
                'constraints' => array(new NotBlank()),

            ))
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }



}