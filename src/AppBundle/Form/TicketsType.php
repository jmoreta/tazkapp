<?php

namespace AppBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TicketsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fecha', DateType::class, [
            'input' => 'datetime',
            'widget' => "single_text",
            'format' => 'dd-mm-yyyy'])
            ->add('usuarioId')
            ->add('subject')
            ->add('prioridad')
            ->add('descripcion')
            ->add('fechaCreado', DateType::class, [
                'input' => 'datetime',
                'widget' => "single_text",
                'format' => 'dd-mm-yyyy'])
            ->add('usuarioAsignadoId')->add('estado');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tickets',
            'csrf_protection' => false,
            'cascade_validation' => true,
            'allow_extra_fields' => true,

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_tickets';
    }


}
