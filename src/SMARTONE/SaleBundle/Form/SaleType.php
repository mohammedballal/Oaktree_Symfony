<?php

namespace SMARTONE\SaleBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('saleOrderNo')
            ->add('customer','entity',array(
                    'class' => 'SMARTONESaleBundle:Customer',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                            //        ->
                            ->orderBy('g.sortOrder','ASC');
                    },
                    'label' => 'Customer',
                    'attr' => array(
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
            'data_class' => 'SMARTONE\SaleBundle\Entity\Sale'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_salebundle_sale';
    }
}
