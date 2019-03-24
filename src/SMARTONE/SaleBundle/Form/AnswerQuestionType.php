<?php

namespace SMARTONE\SaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class AnswerQuestionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer',null,array(
                'attr' => array(
                    'class' => 'c-select'
                ),
                'constraints' => array(
                    new Assert\NotBlank()
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SMARTONE\SaleBundle\Entity\SaleQuestion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_salebundle_answer';
    }
}
