<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 12/4/2018
 * Time: 12:12 PM
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TypesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class)
            ->add('textarea',TextareaType::class)
            ->add('percent',PercentType::class)
            ->add('color',ColorType::class)
            ->add('countries',CountryType::class)
            ->add('range',RangeType::class)
            ->add('embed_form',FormType::class)
        ;
    }
}