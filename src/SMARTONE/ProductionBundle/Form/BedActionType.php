<?php

namespace SMARTONE\ProductionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BedActionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('actionName')
            ->add('actionType')
            ->add('isMassage',null,array(
                'label' => 'Can you have a Dual Massage'
            ))
            ->add('isSplittable',null,array(
                'label' => 'Can you Split the Action'
            ))
            ->add('isHandsetUpgradable',null,array(
                'label' => 'Can you upgrade the handset'
            ))
            ->add('handsetType',null, array(
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
            'data_class' => 'SMARTONE\ProductionBundle\Entity\BedAction'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_productionbundle_bedaction';
    }
}
