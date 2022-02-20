<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('maxPrice', IntegerType::class, [
        'required' => false,
        'label' => false,
        'attr' => [
          'placeholder' => 'Budget max'
        ]
      ])
      ->add('minSurface', IntegerType::class, [
        'required' => false,
        'label' => false,
        'attr' => [
          'placeholder' => 'Surface minimale'
        ]
      ]);
  }

  # ici pour que ce form ne se POST pas par defautl on lui précise get, 
  #et on désactive la method csrf pas besoin de token pour faire une recherche
  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => PropertySearch::class,
      'method' => 'get',
      'csrf_protection' => false
    ]);
  }


  /**
   * 
   */
  public function getBlockPrefix()
  {
    return '';
  }
}

# http://localhost:8000/properties?property_search%5BmaxPrice%5D=150000&property_search%5BminSurface%5D=40&property_search%5Bsubmit%5D=