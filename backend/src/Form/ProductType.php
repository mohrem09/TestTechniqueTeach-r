<?php
// src/Form/ProductType.php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;  // Make sure to include Category
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;  // Import EntityType from Doctrine
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Product Name',
                'attr' => ['placeholder' => 'Enter product name']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['placeholder' => 'Enter product description']
            ])
            ->add('price', NumberType::class, [
                'label' => 'Price',
                'attr' => ['placeholder' => 'Enter product price']
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,  // Set the class to the Category entity
                'choices' => $options['categories'],  // Use the categories passed from the controller
                'choice_label' => 'name',  // Use the 'name' property of the Category object for the select options
                'expanded' => false, // Single select
                'multiple' => false, // Do not allow multiple selections
                'placeholder' => 'Select a category',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save Product'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'categories' => [],  // This will hold the categories array passed from the controller
        ]);
    }
}
