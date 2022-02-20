<?php

namespace App\Form;

use App\Entity\Property;
use App\Entity\Option;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('title')
      ->add('description')
      ->add('surface')
      ->add('rooms')
      ->add('bedrooms')
      ->add('floor')
      ->add('price')
      ->add('heat', ChoiceType::class, ['choices' => array_flip(Property::HEAT)])
      # select from other entity - Class Option, base on column 'name', multiple choice possible
      ->add('options', EntityType::class,[
        'class' => Option::class,
        'choice_label' => 'name',
        'multiple' => true
      ])
      ->add('city', null, [
        'label' => 'ville'
      ])
      ->add('address')
      ->add('postal_code')
      ->add('sold')
      #->add('created_at')

    ;
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Property::class,
      'translation_domain' => 'forms'
    ]);
  }
}
