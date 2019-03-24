<?php

namespace SMARTONE\ProductionBundle\Form;

use Doctrine\ORM\EntityRepository;
use SMARTONE\ProductionBundle\Entity\Base;
use SMARTONE\ProductionBundle\Entity\BaseCategory;
use SMARTONE\ProductionBundle\Entity\FabricColour;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ProductionItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand','entity',array(
                    'class' => 'SMARTONE\ShippingBundle\Entity\Brand',
                    'required' => false,
                    'attr' => array(
                        'class' => 'c-select'
                    ))
            )
            ->add('baseCategory','entity',array(
                'label' => 'Base Type',
                    'class' => 'SMARTONE\ProductionBundle\Entity\BaseCategory',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                            //        ->
                            ->orderBy('g.sortOrder','ASC');
                    },
                    'required' => false,
                    'attr' => array(
                        'class' => 'c-select'
                    ))
            )
//            ->add('base',null,array(
//                    'attr' => array(
//                        'class' => 'c-select'
//                    )
//            ))
        ;

        $formModifier = function (FormInterface $form, BaseCategory $baseCategory = null) {

            $positions = null === $baseCategory ? array() : $baseCategory->getBase();

            $baseWidthsArr = array();

            if($baseCategory) {
                if (strpos($baseCategory->getBaseCategoryName(), 'Single') !== false) {
                    $baseWidthsArr = array(
                        '' => '',
                        '2ft3' => '2ft3',
                        '2ft6' => '2ft6',
                        '3ft' => '3ft',
                        '3ft6' => '3ft6',
                    );

                }

                if (strpos($baseCategory->getBaseCategoryName(), 'Double') !== false) {
                    $baseWidthsArr = array(
                        '' => '',
                        '4ft' => '4ft',
                        '4ft6' => '4ft6',
                    );
                }

                if (strpos($baseCategory->getBaseCategoryName(), 'Dual') !== false) {
                    $baseWidthsArr = array(
                        '' => '',
                        '4ft6' => '4ft6',
                        '5ft' => '5ft',
                        '6ft' => '6ft',
                    );

                }
            }

            $baseWidths = null === $baseCategory ? array() : $baseWidthsArr;

            $form->add('base', 'entity', array(
                'class' => 'SMARTONE\ProductionBundle\Entity\Base',
                'placeholder' => '',
                'choices' => $positions,
                'choices_as_values' => true,
                'attr' => array(
                    'class' => 'c-select'
                )
            ))

            ->add('baseWidth','choice',array(
                'choices' => $baseWidths,
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
                ;
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getBaseCategory());
            }
        );

//        $builder->addEventListener(
//            FormEvents::PRE_SET_DATA,
//            function (FormEvent $event) use ($formModifier) {
//                // this would be your entity, i.e. SportMeetup
//                $data = $event->getData();
//
//                $formModifier($event->getForm(), $data->getBase());
//            }
//        );

        $builder->get('baseCategory')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $sport = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $sport);
            }
        );

//        $builder->get('base')->addEventListener(
//            FormEvents::POST_SUBMIT,
//            function (FormEvent $event) use ($formModifier) {
//                // It's important here to fetch $event->getForm()->getData(), as
//                // $event->getData() will get you the client data (that is, the ID)
//                $sport = $event->getForm()->getData();
//
//                // since we've added the listener to the child, we'll have to pass on
//                // the parent to the callback functions!
//                $formModifier($event->getForm()->getParent(), $sport);
//            }
//        );


            $builder
                ->add('qty')
            ->add('baseLength','choice',array(
                'choices' => array(
                    'standard' => array(
                        '6ft6' => '6ft6'
                    ),
                    'Specials' => array(
                        '5ft9' => '5ft9',
                        '6ft' => '6ft',
                        '6ft3' => '6ft3',
                        '6ft9' => '6ft9',
                        '7ft' => '7ft',
                    )
                ),
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('baseDepth','choice',array(
                'choices' => array(
                    'standard' => array(
                        '13 inch' => '13 inch'
                    ),
                    'Specials' => array(
                        '7 inch' => '7 inch',
                        '8 inch' => '8 inch',
                        '9 inch' => '9 inch',
                        '10 inch' => '10 inch',
                        '11 inch' => '11 inch',
                        '12 inch' => '12 inch',
                        '13 inch' => '13 inch',
                        '14 inch' => '14 inch',
                        '15 inch' => '15 inch',
                        '16 inch' => '16 inch',
                        '17 inch' => '17 inch',
                        '18 inch' => '18 inch',
                    )
                ),
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('baseConfig', 'choice', array(
                'label' => 'Base orientation',
                'choices' => array(
                    '' => '',
                    'Split N/S/E/W - 4P' => 'Split N/S/E/W - 4P',
                ),
                'expanded' => true
            ))
                ->add('customComment',null,array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Customise comments',
                        'rows' => 3
                    )
                ))
            ->add('noDrawers', 'choice', array(
                'choices' => array(
                    '' => '',
                    '1D' => '1D',
                    '2D' => '2D',
                    '4D' => '4D',
                    '4D Dual' => '4D Dual',
                    '1D End' => '1D End',

                ),
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
                ->add('mattressCustomise')
                ->add('mattressComment')
                ->add('mattress',null,array(
                    'attr' => array(
                        'class' => 'c-select'
                    )
                ))
                ->add('mattressFilling',null,array(
                    'attr' => array(
                        'class' => 'c-select'
                    )
                ))
                ->add('isMassage','choice',array(
                    'label' => 'Massage System',
                    'choices' => array(
                        '' => '',
                        0 => 'No',
                        1 => 'Yes'
                    )
                ))
                ->add('mattressFabricColour','entity',array(
                        'class' => 'SMARTONE\ProductionBundle\Entity\FabricColour',
                        'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('g')
                                ->where('g.fabricFor = :m')
                                ->orWhere('g.fabricFor = :n')
                                ->orWhere('g.fabricFor = :o')
                                ->setParameter('m', FabricColour::mattress)
                                ->setParameter('n', FabricColour::baseMattress)
                                ->setParameter('o', FabricColour::all)
                                ->orderBy('g.sortOrder','ASC');
                        },
                        'required' => false,
                        'attr' => array(
                            'class' => 'c-select'
                        ))
                )
            ->add('drawerConfig', 'choice', array(
                'choices' => array(
                    '' => '',
                    'LHS F.E.' => 'LHS F.E',
                    'RHS F.E.' => 'RHS F.E',
                    'LHS.' => 'LHS',
                    'RHS' => 'LHS',
                    'F.E.' => 'F.E',
                    'H.E. LHS.' => 'H.E LHS',
                    'H.E. RHS' => 'H.E. RHS',

                ),
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('fabricColour',null,array(
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
                ->add('singleMattress')
                ->add('mattressFirmness','choice',array(
                    'choices' => array(
                        'Soft' => 'Soft',
                        'Medium' => 'Medium',
                        'Firm' => 'Firm',
                    ),
                    'attr' => array(
                        'class' => 'c-select'
                    )
                ))
            ->add('badge',null,array(
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('feet',null,array(
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
                ->add('endBar',null,array(
                    'attr' => array(
                        'class' => 'c-select'
                    )
                ))

            ->add('bedAction',null,array(
                'constraints' => array(
                    new Assert\NotBlank()
                ),
                'required' => true,
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('splitBedAction')
            ->add('handset',null,array(
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank()
                ),
                'attr' => array(
                    'class' => 'c-select'
                )
            ))
            ->add('comment',null,array(
                'label' => false,
                'attr' => array(
                    'rows' => 5
                )
            ))

//            ->add('qty')
//            ->add('mattress')
//
            ->add('headboard',null,array(
                'attr' => array(
                    'class' => 'c-select'
                )
                ))

                ->add('headboardType','choice',array(
                    'choices' => array(
                        'One Piece' => 'One Piece',
                        'Split Headboard' => 'Split Headboard'
                    ),
                    'attr' => array(
                        'class' => 'c-select'
                    )
                ))
                ->add('headboardComment',null,array(
                ))

                ->add('accessoryQty')
                ->add('accessoryDescription')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SMARTONE\ProductionBundle\Entity\ProductionItem'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_productionbundle_productionitem';
    }
}
