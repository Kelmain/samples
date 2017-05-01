<?php
/**
 * Created by PhpStorm.
 * User: Armin
 * Date: 17/04/2017
 * Time: 23:40
 */

namespace EXCO\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertEditType extends AbstractType
{

    public function getParent()
    {
        return AdvertType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->remove('date');
    }


}