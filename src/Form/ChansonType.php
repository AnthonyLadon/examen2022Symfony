<?php

namespace App\Form;

use App\Entity\Chanson;
use App\Entity\Genre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ChansonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('nomAlbum')
            ->add('paroles')
            ->add('auteur')
            ->add('votes')
            // permet de lister les genres présents dans la base de données
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => function ($genre) {
                    return $genre->getNom();
                }
            ])
            ->add('ajouter', SubmitType::class, ['label' => 'Ajouter']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chanson::class,
        ]);
    }
}
