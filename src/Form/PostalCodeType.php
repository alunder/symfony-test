<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostalCodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postal_code', TextType::class, [ 'label' => false, 'required' => true, 'attr' => ['placeholder' => 'Postal Code', 'autocomplete' => 'off']])
            ->add('serachbutton', SubmitType::class, ['label' => 'CHECK']);
    }
}
