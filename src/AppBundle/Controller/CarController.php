<?php
/**
 * Created by IntelliJ IDEA.
 * User: riad
 * Date: 25/10/2016
 * Time: 22:10
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Car;
use AppBundle\Form\CarType;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/car/")
 */
class CarController extends FOSRestController
{
    /**
     * @Route("/", name="apiCarList")
     * @Method({"GET"})
     *
     * @throws \InvalidArgumentException
     * @throws \LogicException
     * @ApiDoc(
     *  section="/car",
     *  description="Car list action. This request path return JSON list of Cars saved in the database",
     *  statusCodes={
     *     200="Returned when successful",
     *  }
     * )
     */
    public function getListCarsAction(Request $request)
    {
        $carManager = $this->get('api.manager.car');
        $data = $carManager->getList($request);
        $response = new JsonResponse($data);

        return $response;
    }

    /**
     * @Route("/", name="apiCarNew")
     * @Method({"POST"})
     *
     * @ApiDoc(
     *  section="/car",
     *  description="Add new Car. This request path can add new Car",
     *  input="AppBundle\Entity\Car",
     *  statusCodes={
     *      200="Returned when successful",
     *  },
     *  requirements={
     *     {
     *          "name"="_format",
     *          "dataType"="json",
     *          "description"="JSON entity to add. Returns JSON message after validation or save new car to database",
     *          "requirement"="json",
     *          "required"="true"
     *      }
     *  }
     * )
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \LogicException
     */
    public function postCreateCarAction(Request $request)
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        $response = new JsonResponse('no-data');
        if ($request->getMethod() === 'POST') {
            $form->submit($request->request->all(), true);
            $form->handleRequest($request);

            $validator = $this->get('validator');
            $errors = $validator->validate($car);

            if (count($errors) > 0) {
                $responseObject = array(
                    'message' => (string) $errors
                );
            } else  {
                $em = $this->getDoctrine()->getManager();
                $car = $form->getData();
                $em->persist($car);
                $em->flush($car);
                $responseObject = array(
                    'message' => 'Car data saved correctly!'
                );
            }
            $response = new JsonResponse($responseObject);
        }
        return $response;
    }

    /**
     * @Route("/{id}", name="apiCarEdit")
     * @Method({"PUT"})
     *
     * @ApiDoc(
     *  section="/car",
     *  description="Edit Car",
     *  input="AppBundle\Entity\Car",
     *  statusCodes={
     *      200="Returned when successful",
     *  },
     *  requirements={
     *     {
     *          "name"="_format",
     *          "dataType"="json",
     *          "description"="JSON entity to edit. Returns JSON message after validation or save car to database",
     *          "requirement"="json",
     *          "required"="true"
     *      }
     *  },
     * )
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LogicException
     * @throws \InvalidArgumentException
     */
    public function putEditCarAction(Request $request, $id)
    {
        $car = $this->getDoctrine()->getRepository('AppBundle:Car')->find($id);
        $responseObject = array(
            'message' => 'no-data'
        );
        if($car !== null) {
            $form = $this->createForm(CarType::class, $car);
            if ($request->getMethod() === 'PUT') {
                $form->submit($request->request->all(), true);
                $form->handleRequest($request);

                $validator = $this->get('validator');
                $errors = $validator->validate($car);

                if (count($errors) > 0) {
                    $responseObject = array(
                        'message' => (string) $errors
                    );
                } else  {
                    $em = $this->getDoctrine()->getManager();
                    $car = $form->getData();
                    $em->persist($car);
                    $em->flush($car);
                    $responseObject = array(
                        'message' => 'Car data modified correctly!'
                    );
                }
            }
        } else {
            $responseObject = array(
                'message' => 'Object not found!'
            );
        }
        $response = new JsonResponse($responseObject);
        return $response;
    }

    /**
     * @Route("/{id}", name="apiCarDelete")
     * @Method({"DELETE"})
     *
     * @throws \InvalidArgumentException
     * @throws \LogicException
     * @ApiDoc(
     *  section="/car",
     *  description="Delete Car. This request path return JSON confirmation if deleted",
     *  statusCodes={
     *     200="Returned when successful",
     *  }
     * )
     */
    public function deleteRemoveCarAction($id)
    {
        $message = $this->getDoctrine()->getRepository('AppBundle:Car')->delete($id);
        $responseObject = array( 'message' => $message );
        $response = new JsonResponse($responseObject);
        return $response;
    }

    /**
     * @Route("/{id}", name="apiCarPatch")
     * @Method({"PATCH"})
     *
     * @throws \InvalidArgumentException
     * @throws \LogicException
     * @ApiDoc(
     *  section="/car",
     *  description="Complete Car setting new price",
     *  statusCodes={
     *     200="Returned when successful",
     *  }
     * )
     */
    public function updateCarPriceAction($id, $price)
    {
        $message = $this->getDoctrine()->getRepository('AppBundle:Car')->complete($id, $price);
        $responseObject = array(
            'message' => $message
        );
        $response = new JsonResponse(json_encode($responseObject));
        return $response;
    }
}