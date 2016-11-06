<?php

/**
 * Created by IntelliJ IDEA.
 * User: riad
 * Date: 25/10/2016
 * Time: 22:10
 */
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarRepository")
 * @ORM\Table(name="car")
 */
class Car
{
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * Encapsulation (private field)
     */
    private $id;
    /**
     * @ORM\Column(name="maker", type="string", nullable=false, length=255)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $maker;
    /**
     * @ORM\Column(name="model", type="string", nullable=false, length=255)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $model;
    /**
     * @ORM\Column(name="price", type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    private $price;

    /**
     * @var array
     *
     * @ORM\Column(name="equipments", type="array", nullable=true)
     */
    private $equipments;

    /**
     * @var array
     *
     * @ORM\Column(name="options", type="array", nullable=true)
     */
    private $options;

    public function __construct() {
        $this->equipments = [];
        $this->options = [];
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMaker()
    {
        return $this->maker;
    }

    /**
     * @param string $maker
     */
    public function setMaker($maker)
    {
        $this->maker = $maker;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return array
     */
    public function getEquipments()
    {
        return $this->equipments;
    }

    /**
     * @param array $equipments
     */
    public function setEquipments($equipments)
    {
        $this->equipments = $equipments;
        return $this;
    }

    /**
     * @param string|null $equipment
     */
    public function addEquipment($equipment = null)
    {
        $this->equipments[] = $equipment;
    }

    /**
     * @param string $equipment
     */
    public function removeEquipment($equipment)
    {
        if(($key = array_search($equipment, $this->equipments)) !== false) {
            unset($this->equipments[$key]);
        }
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @param string|null $option
     */
    public function addOption($option = null)
    {
        $this->equipments[] = $option;
    }

    /**
     * @param string $option
     */
    public function removeOption($option)
    {
        if(($key = array_search($option, $this->options)) !== false) {
            unset($this->options[$key]);
        }
    }
}
