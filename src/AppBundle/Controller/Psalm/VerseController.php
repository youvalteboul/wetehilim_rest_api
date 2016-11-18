<?php
namespace AppBundle\Controller\Psalm;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Form\Type\VerseType;
use AppBundle\Entity\Verse;

class VerseController extends Controller
{

    /**
     * @Rest\View(serializerGroups={"verse"})
     * @Rest\Get("/psalms/{id}/verses")
     */
    public function getVersesAction(Request $request)
    {
        $psalm = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Psalm')
            ->find($request->get('id')); // L'identifiant en tant que paramétre n'est plus nécessaire
        /* @var $psalm Psalm */

        if (empty($psalm)) {
            return $this->psalmNotFound();
        }

        return $psalm->getVerses();
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"verse"})
     * @Rest\Post("/psalms/{id}/verses")
     */
    public function postVersesAction(Request $request)
    {
        $psalm = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Psalm')
            ->find($request->get('id'));
        /* @var $psalm Psalm */

        if (empty($psalm)) {
            return $this->psalmNotFound();
        }

        $verse = new Verse();
        $verse->setPsalm($psalm); // Ici, le lieu est associé au prix
        $form = $this->createForm(VerseType::class, $verse);

        // Le paramétre false dit à Symfony de garder les valeurs dans notre
        // entité si l'utilisateur n'en fournit pas une dans sa requête
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($verse);
            $em->flush();
            return $verse;
        } else {
            return $form;
        }
    }

    private function psalmNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Psalm not found'], Response::HTTP_NOT_FOUND);
    }
}
