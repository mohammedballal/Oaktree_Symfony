<?php

namespace SMARTONE\ShippingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CourierType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('courierName')
            ->add('courierNumber')
            ->add('file',null,array(
                'label' => 'Image'
            ))
            ->add('color', null,array(
                'label' => 'Colour',
                'attr' => array(
                    'class' => 'jscolor'
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
            'data_class' => 'SMARTONE\ShippingBundle\Entity\Courier'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_shippingbundle_courier';
    }
}
