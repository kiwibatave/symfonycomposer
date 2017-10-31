<?php

namespace BC\PlatformBundle\Form;

use BC\PlatformBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;



class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class)
            ->add('title', TextType::class)
            ->add('author', TextType::class)
            ->add('content', TextareaType::class)
//            ->add('published', CheckboxType::class, array('required' => false))
            ->add('image', ImageType::class)
            ->add('categories', EntityType::class, array(
                'class' => 'BCPlatformBundle:Category',
                'choice_label' => 'name',
                'multiple' => true,
            ))
            ->add('save', SubmitType::class);

//        Ajout de la fonction qui va écouter un événement
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA, // 1er argument : l'événement qui nous intéresse.
            function (FormEvent $event) { // 2eme argument : la fonction a éxécuter lorsque que l'événement est déclenché.
//                On récupère notre objet Advert sous-jacent
                $advert = $event->getData();

//                Condition importante
                if(null === $advert) {
                    return; // On sort de la fonction
                }

//                Si l'ad n'est pas publiée ou si elle est n'existe pas encore en base (id = null)
                if (!$advert->getPublished() || null === $advert->getId()) {
//                    Alors on ajoute le champ published au form
                    $event->getForm()->add('published', CheckboxType::class, array('required' => false));
                } else {
                    // Sinon on le supprime
                    $event->getForm()->remove('published');
                }
            }
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BC\PlatformBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bc_platformbundle_advert';
    }


}
