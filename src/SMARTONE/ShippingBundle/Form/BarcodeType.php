<?php

namespace SMARTONE\ShippingBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class BarcodeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('barcode',null,array(
                'constraints' => array(
                    new Assert\Length(array(
                        'min' => 12,
                    ))
                )
            ))
            ->add('size','entity',array(
                    'class' => 'SMARTONEShippingBundle:Size',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                            //        ->
                            ->orderBy('g.sortOrder','ASC');
                    },
                    'label' => 'Size',
                    'attr' => array(
                        'style' => 'display:none;',
                        'class' => 'c-select'
                    ))
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SMARTONE\ShippingBundle\Entity\Barcode'
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
