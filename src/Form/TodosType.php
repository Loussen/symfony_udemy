<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 12/4/2018
 * Time: 12:12 PM
 */

namespace App\Form;

use App\Entity\Todos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class)
            ->add('endDate',DateType::class)
            ->add('privacyPolicy', CheckboxType::class,[
                'mapped' => false
            ])
            ->add('save',SubmitType::class, [
                'label' => 'Save todo'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Todos::class
        ]);
    }
}