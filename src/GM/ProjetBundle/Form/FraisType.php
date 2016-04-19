<?php

namespace GM\ProjetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FraisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('montant', NumberType::class)
            ->add('piece', FileType::class, array('label' => 'Pièce Brochure (PDF file)', 'data_class' => null))
            ->add('date', DateTimeType::class)
//            ->add('mission')
////      ->add('mission', "entity", array("class"=>"GM\ProjetBundle\Entity\Mission", "property"=>"mission_id"))
            ->add('infoCom', TextareaType::class)
      ->add('Enregistrer', SubmitType::class, array('label' => 'Enregistrer Frais'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GM\ProjetBundle\Entity\Frais'
        ));
    }
}
