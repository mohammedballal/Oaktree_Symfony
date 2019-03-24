<?php
namespace SMARTONE\ShippingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ShipmentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand',null,array(
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('docNo')
            ->add('cusOrderNo')
            ->add('orderReceiveDate')
            ->add('inProduction')
            ->add('shippedDate')
//            ->add('orderReceived')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SMARTONE\ShippingBundle\Entity\Shipment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_shippingbundle_shipment';
    }
}