<?php

namespace SMARTONE\ProductionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BaseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('baseCategory', null, array(
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('baseType')
            ->add('baseDepth','choice',array(
                'choices' => array(
                    'standard' => array(
                        '13 inch' => '13 inch'
                    ),
                    'Specials' => array(
                        '7 inch' => '7 inch',
                        '8 inch' => '8 inch',
                        '9 inch' => '9 inch',
                        '10 inch' => '10 inch',
                        '11 inch' => '11 inch',
                        '12 inch' => '12 inch',
                        '13 inch' => '13 inch',
                        '14 inch' => '14 inch',
                        '15 inch' => '15 inch',
                        '16 inch' => '16 inch',
                        '17 inch' => '17 inch',
                        '18 inch' => '18 inch',
                    )
                ),
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('baseConfig', 'choice', array(
                'choices' => array(
                    'Std' => 'Std',
                    'Std N/S' => 'Std N/S',
                    'Split E/W' => 'Split E/W',
                   // 'Split N/S/E/W - 4P' => 'Split N/S/E/W - 4P',

                ),
                'expanded' => true
            ))
            ->add('noBases', null, array(
                'label' => 'Number of bases'
            ))
            ->add('isDrawer', null, array(
                'label' => 'Can have drawers'
            ))
            ->add('maxDrawers', 'choice', array(
                'label' => 'Max number of drawers',
                'choices' => array(
                    0 => 'No drawers',
                    1 => '1 Drawer',
                    2 => '2 Drawers',
                    4 => '4 Drawers',
                ),
                'expanded' => true
            ))

            ->add('actionIncluded', null, array(
                'label' => 'Are the actions included in the surround'
            ))
            ->add('noAction', 'choice',array(
                'label' => 'Number of actions',
                'choices' => array(
                    0 => 'No Actions',
                    1 => '1 Action',
                    2 => '2 Actions'
                ),
                'expanded' => true
            ))
            ->add('mattressInPack', null,array(
                'required' => false,
                'label' => 'Mattress packed with the base'
            ))
            ->add('sortOrder')
            ->add('feet',null,array(
                'expanded' => true,
                'multiple' => true,
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SMARTONE\ProductionBundle\Entity\Base'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_productionbundle_base';
    }
}
