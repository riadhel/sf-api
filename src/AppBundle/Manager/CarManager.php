<?php

namespace AppBundle\Manager;
use AppBundle\Entity\Car;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Created by IntelliJ IDEA.
 * User: riad
 * Date: 06/11/2016
 * Time: 21:36
 */
class CarManager
{
    /**
     * Doctrine entity manager
     * @var EntityManager
     */
    private $manager;

    /**
     * ManageChannel constructor.
     *
     * @param EntityManager       $manager   Symfony entity manager
     */
    public function __construct(
        EntityManager $manager
    ) {
        $this->manager = $manager;
    } // __construct

    /**
     * The cars list
     *
     * @param Request $request Action request
     * @return array
     */
    public function getList(Request $request)
    {
        // ==== Initialisation ====
        $cars = $this->manager->getRepository('AppBundle:Car')
            ->findAll();
        $data = [
            'cars' => [],
            '_links' => [
                'new_car'      => '/v1/creates/cars',
            ],
        ];

        /** @var Car $car */
        foreach ($cars as $car) {
            $data['cars'][] = [
                'id'          => $car->getId(),
                'maker'        => $car->getMaker(),
                'model'     => $car->getModel(),
                'price'     => $car->getPrice(),
                'options'   => $car->getOptions(),
                'equipments'   => $car->getEquipments(),
            ];
        }

        return $data;
    }
}