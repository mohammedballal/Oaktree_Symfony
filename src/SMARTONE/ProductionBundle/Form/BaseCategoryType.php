<?php

namespace SMARTONE\ProductionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BaseCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('baseCategoryName')
            ->add('baseCategoryType', 'choice' ,array(
                'choices' => array(
                    'Base' => 'Base',
                    'Bedstead' => 'Bedstead'
                ),
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('sortOrder')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SMARTONE\ProductionBundle\Entity\BaseCategory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_productionbundle_basecategory';
    }
}
