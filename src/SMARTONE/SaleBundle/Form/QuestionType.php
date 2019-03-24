<?php

namespace SMARTONE\SaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('type','choice',array(
                'attr' => array(
                    'class' => 'c-select'
                ),
                'label' => 'Select heading',
                'choices' => array(
                    1   => 'Sales Order No',
                    2   => 'Customer Name',
                    3   => 'In Production',
                    4   => 'To Be Completed By',
                    5   => 'Production Complete',
                    6   => 'Sales Paperwork',
                    7   => 'Vehicle Assigned',
                    8   => 'Loaded',
                    9   => 'Mark As Complete',
                    10  => 'Delivery Day',
                    11  => 'Other'
                )
            ))
            ->add('text')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SMARTONE\SaleBundle\Entity\Question'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_salebundle_question';
    }
}
