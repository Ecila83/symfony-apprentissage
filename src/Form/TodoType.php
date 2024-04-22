<?php

namespace App\Form;

use App\Controller\Todo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class TodoType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('content', TextType::class, [
        'label' => 'Un super label',
        'attr' => [
          'placeholder' => 'Contenu de la todo'
        ],
        'help' => 'Indiquez ce que vous avez à faire',
        'constraints' => [
          new NotBlank(message: 'Le contenu ne doit pas être vide'),
          new Length([
            'min' => 10,
            'max' => 50,
            'minMessage' => 'Le contenu doit faire au moins {{ limit }} caractères',
            'maxMessage' => 'Le contenu doit faire au plus {{ limit }} caractères',
          ])
        ],
      ])
      ->add('pays', CountryType::class);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Todo::class,
    ]);
  }
}
