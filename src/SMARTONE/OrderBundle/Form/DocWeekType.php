<?php

namespace SMARTONE\OrderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocWeekType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('deliveryScheduleDate',null,array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'class' => 'datetimepicker has-value',
                    'data-date-format' => 'DD/MM/YYYY'
                )
            ))
            ->add('deliveryScheduleDay',null,array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'class' => 'datetimepicker has-value',
                    'data-date-format' => 'DD/MM/YYYY'
                ),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SMARTONE\OrderBundle\Entity\DocOrder'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_orderbundle_docorder';
    }
}
