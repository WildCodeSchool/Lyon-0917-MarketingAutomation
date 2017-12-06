<?php


namespace AppBundle\Controller;


use AppBundle\Entity\SoftMain;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class AjaxSoftController extends Controller
{
    /**
     * @param Request $request
     * @param $SoftMain
     * @return JsonResponse
     * @Route("/comparatifs/{SoftMain}", name="list-softmain")
     */

    public function autocompleteAction(Request $request, $SoftMain)
    {
        if($request->isXmlHttpRequest()) {

            $repository = $this->getDoctrine()->getRepository('AppBundle:SoftMain');
            $data = $repository->findAll();
            return new JsonResponse(array("data" => json_encode($data)));
        }else{
            throw new HttpException('500', 'Invalid call');
        }

    }
}

