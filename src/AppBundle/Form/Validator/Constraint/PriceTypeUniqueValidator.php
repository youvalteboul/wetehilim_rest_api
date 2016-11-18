<?php
# src/AppBundle/Form/Validator/Constraints/PriceTypeUniqueValidator.php

namespace AppBundle\Form\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PriceTypeUniqueValidator extends ConstraintValidator
{
    public function validate($prices, Constraint $constraint)
    {
        if (!($prices instanceof \Doctrine\Common\Collections\ArrayCollection)) {
            return;
        }

        $pricesType = [];

        foreach ($prices as $price) {
            if (in_array($price->getType(), $pricesType)) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
                return; // Si il y a un doublon, on arrête la recherche
            } else {
                // Sauvegarde des types de prix déjà présents
                $pricesType[] = $price->getType();
            }
        }
    }
}