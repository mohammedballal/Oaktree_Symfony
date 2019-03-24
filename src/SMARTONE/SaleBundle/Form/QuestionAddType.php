<?php

namespace SMARTONE\SaleBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionAddType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question','entity',array(
                    'class' => 'SMARTONESaleBundle:question',
                    'query_builder' => function(EntityRepository $er) use ($options) {
                        return $er->createQueryBuilder('g')
                            ->where('g.type = '.$options['q_type'])
                            ;
                    },
                    'label' => 'Question',
                    'attr' => array(
                        'class' => 'c-select'
                    )
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SMARTONE\SaleBundle\Entity\SaleQuestion',
            'q_type' => 1,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartone_salebundle_question';
    }
}
