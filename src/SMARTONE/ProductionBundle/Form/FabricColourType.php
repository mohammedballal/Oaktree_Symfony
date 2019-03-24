<?php

namespace SMARTONE\ProductionBundle\Form;

use SMARTONE\ProductionBundle\Entity\FabricColour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FabricColourType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('colourName')
            ->add('colourCategory','choice',array(
                'attr' => array(
                    'class' => 'c-select'
                ),
                'choices' => array(
                    'Damask' => 'Damask',
                    'Chenille' => 'Chenille',
                    'Suede' => 'Suede',
                    'PU Leather' => 'PU Leather',
                    'Swatch Book' => 'Swatch Book',
                    'Stretch' => 'Stretch',
                    'Stitch Bond' => 'Stitch Bond',
                    'Waterproof' => 'Waterproof',
                    'Bespoke' => 'Bespoke',
                    'Other' => 'Other',
                    'Custom' => 'Custom',
                )
            ))
            ->add('fabricFor','choice',array(
                'attr' => array(
                    'class' => 'c-select'
                ),
                'choices' => array(
                    FabricColour::base => 'Base Only',
                    FabricColour::mattress => 'Mattress Only',
                    FabricColour::baseMattress => 'Base + Mattress Only',
                    FabricColour::headboard => 'Headboard Only ',
                    FabricColour::bedstead => 'Bedstead Only',
                    FabricColour::notMattress => 'Base + Headboard + Bedstead',
                    FabricColour::all => 'All',
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
            'data_class' => 'SMARTONE\ProductionBundle\Entity\FabricColour'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_productionbundle_fabriccolour';
    }
}
