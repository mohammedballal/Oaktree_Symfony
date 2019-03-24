<?php

namespace SMARTONE\ProductionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductionItemBaseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('baseCode')
            ->add('width')
            ->add('length')
            ->add('depth')
//            ->add('headboard')
//            ->add('headboardSize')
//            ->add('headboardStyle')
//            ->add('headboardComment')
//            ->add('headboardColour')
//            ->add('headboardFixing')

            ->add('baseUpgrade')
            ->add('baseType')
            ->add('baseComment')
            ->add('noOfDrawers')
            ->add('drawerConfig')
            ->add('isDrawer')
            ->add('isBedstead')


//            ->add('action')
//            ->add('actionType')
//            ->add('actionUpgrade')
//            ->add('actionHandset')
            ->add('fabricColour')
            ->add('endBar')
            ->add('feet')
            ->add('badge')

            ->add('qty')
            ->add('baseName')
//            ->add('sortOrder')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SMARTONE\ProductionBundle\Entity\ProductionItemBase'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_productionbundle_productionitembase';
    }
}
