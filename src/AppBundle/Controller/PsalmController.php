<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Entity\Psalm;
use AppBundle\Form\Type\PsalmType;


class PsalmController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"psalm"})
     * @Rest\Get("/psalms")
     */
    public function getPsalmsAction(Request $request)
    {
        $psalms = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Psalm')
            ->findAll();
        /* @var $psalms Psalm[] */

        return $psalms;
    }

    /**
     * @Rest\View(serializerGroups={"psalm"})
     * @Rest\Get("/psalms/{id}")
     */
    public function getPsalmAction(Request $request)
    {
        $psalm = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Psalm')
            ->find($request->get('id')); // L'identifiant est utilisé directement
        /* @var $psalm Psalm */

        if (empty($psalm)) {
            return \FOS\RestBundle\View\View::create(['message' => 'Psalm not found'], Response::HTTP_NOT_FOUND);
        }

        return $psalm;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"psalm"})
     * @Rest\Post("/psalms")
     */
    public function postPsalmsAction(Request $request)
    {
        $psalm = new Psalm();
        $form = $this->createForm(PsalmType::class, $psalm);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            foreach ($psalm->getVerses() as $verse) {
                $verse->setPsalm($psalm);
                $em->persist($verse);
            }
            $em->persist($psalm);
            $em->flush();
            return $psalm;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"psalm"})
     * @Rest\Delete("/psalms/{id}")
     */
    public function removePsalmAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $psalm = $em->getRepository('AppBundle:Psalm')
            ->find($request->get('id'));
        /* @var $psalm Psalm */

        if (!$psalm) {
            return;
        }

        foreach ($psalm->getVerses() as $verse) {
            $em->remove($verse);
        }
        $em->remove($psalm);
        $em->flush();
    }

    /**
     * @Rest\View(serializerGroups={"psalm"})
     * @Rest\Put("/psalms/{id}")
     */
    public function updatePsalmAction(Request $request)
    {
        return $this->updatePsalm($request, true);
    }

    /**
     * @Rest\View(serializerGroups={"psalms"})
     * @Rest\Patch("/psalm/{id}")
     */
    public function patchPsalmAction(Request $request)
    {
        return $this->updatePsalm($request, false);
    }

    private function updatePsalm(Request $request, $clearMissing)
    {
        $psalm = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Psalm')
            ->find($request->get('id')); // L'identifiant en tant que paramètre n'est plus nécessaire
        /* @var $psalm Psalm */

        if (empty($psalm)) {
            return \FOS\RestBundle\View\View::create(['message' => 'Psalm not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(PsalmType::class, $psalm);

        // Le paramètre false dit à Symfony de garder les valeurs dans notre
        // entité si l'utilisateur n'en fournit pas une dans sa requête
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($psalm);
            $em->flush();
            return $psalm;
        } else {
            return $form;
        }
    }
}
