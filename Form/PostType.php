<?php

namespace Ephp\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', null, array(
                    'label' => 'form.title',
                    'translation_domain' => 'EphpBlogBundle',
                ))
                ->add('media', 'hidden', array(
                    'label' => 'form.media',
                    'translation_domain' => 'EphpBlogBundle',
                ))
                ->add('choice', 'choice', array(
                    'mapped' => false,
                    'label' => 'form.choice',
                    'translation_domain' => 'EphpBlogBundle',
                    'choices' => array(
                        '-' => 'form.choices.no',
                        'p' => 'form.choices.img',
                        'v' => 'form.choices.vid',
                    ),
                    'expanded' => true,
                    'attr' => array(
                        'class' => 'inline',
                    ),
                ))
                ->add('picture', 'hidden', array(
                    'required' => false,
                    'translation_domain' => 'EphpBlogBundle',
                ))
                ->add('video', 'text', array(
                    'mapped' => false,
                    'label' => 'form.video',
                    'required' => false,
                    'translation_domain' => 'EphpBlogBundle',
                ))
                ->add('body', null, array(
                    'label' => 'form.body',
                    'translation_domain' => 'EphpBlogBundle',
                ))
                ->add('url', null, array(
                    'label' => 'form.url',
                    'translation_domain' => 'EphpBlogBundle',
                ))
                ->add('categories', null, array(
                    'label' => 'form.categories',
                    'translation_domain' => 'EphpBlogBundle',
                    'expanded' => true,
                    'query_builder' => function(\Ephp\BlogBundle\Entity\CategoryRepository $er) {
                        return $er->createQueryBuilder('c')
                                ->where('c.show = :show')
                                ->setParameter('show', true)
                                ->orderBy('c.name', 'ASC');
                    },
                    'attr' => array(
                        'class' => 'inline',
                    ),
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ephp\BlogBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'post';
    }

}
