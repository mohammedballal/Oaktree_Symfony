<?php

namespace SMARTONE\ProductionBundle\Form;

use Doctrine\ORM\EntityRepository;
use SMARTONE\ProductionBundle\Entity\FabricColour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MattressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', null, array(
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('mattressModel')
            ->add('mattesDepth')
            ->add('mattressType', 'choice', array(
                'choices' => array(
                    'Foam' => 'Foam',
                    'Pocket Sprung' => 'Pocket Sprung',
                    'Open Coil' => 'Open Coil',
                    'Hand Stitched' => 'Hand Stitched',
                    'Contract' => 'Contract',
                    'Toppers' => 'Toppers',
                    'Other' => 'Other'
                ),
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('mattressFilling', null, array(
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('mattressStyle', 'choice', array(
                'choices' => array(
                    'Tufted' => 'Tufted',
                    'Quilted' => 'Quilted',
                ),
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('mattressQuiltDesign', null, array(
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('mattressFinish', 'choice', array(
                'choices' => array(
                    'Tape Edge Both Side' => 'Tape Edge Both Side',
                    'Tape Edge One Side' => 'Tape Edge One Side',
                    'Zip Cover' => 'Zip Cover',
                    'Other' => 'Other'

                ),
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('massageAvailable')
            ->add('coverType', null, array(
                'label' => 'Fabric colour',
                    'attr' => array(
                        'class' => 'c-select'
                    ))
            )
            ->add('mattressLabel',null,array(
                'attr' => array(
                    'class' => 'c-select'
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
            'data_class' => 'SMARTONE\ProductionBundle\Entity\Mattress'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_productionbundle_mattress';
    }
}
