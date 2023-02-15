<?php

namespace src\Form\Type;

use src\Form\Type\CommentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
        ->add('content', TextareaType::class, [
            'label' => 'Votre Message'
        ]);
    }
}