<?php

namespace SMARTONE\OrderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocOrderEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('docNo')
            ->add('time')
            ->add('vehicleReg')
            ->add('bookingRef')
            ->add('viewManifest')
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
