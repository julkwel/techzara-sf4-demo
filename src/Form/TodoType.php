<?php
/**
 * @Author Rajerison Julien <julienrajerison5@gmail.com>
 * @Description Demo Todo Techzara du 27 - 04 - 2019
 */

namespace App\Form;

use App\Entity\Todo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('todo_name',TextType::class,[
                'attr'=>[
                    'class'=>'form-control col-md-6'
                ]
            ])
            ->add('todo_description',TextareaType::class,[
                'attr'=>[
                    'class'=>'form-control col-md-6'
                ]
            ])
            ->add('todo_date_deb', DateTimeType::class, [
                'widget'=>'single_text',
                'html5'=>false,
                'attr' => [
                    'class' => 'datetime form-control col-md-6'
                ]
            ])
            ->add('todo_date_fin', DateTimeType::class, [
                'widget'=>'single_text',
                'html5'=>false,
                'attr' => [
                    'class' => 'datetime form-control col-md-6'
                ]
            ])
            ->add('todoStatus', ChoiceType::class, [
                'choices' => [
                    'important' => 1,
                    'enhancement' => 2,
                    'features' => 3
                ],
                'attr'=>[
                    'class'=>'form-control col-md-6'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Todo::class,
        ]);
    }
}
