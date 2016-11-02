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
     * @Assert\Type("integer")
     */
    private $price;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Equipment")
     * @ORM\JoinTable(name="carEquipment",
     *      joinColumns={@ORM\JoinColumn(name="carId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="equipmentId", referencedColumnName="id")}
     * )
     */
    private $equipments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Option")
     * @ORM\JoinTable(name="carOption",
     *      joinColumns={@ORM\JoinColumn(name="carId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="optionId", referencedColumnName="id")}
     * )
     */
    private $options;

    public function __construct() {
        $this->equipments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->options = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMaker()
    {
        return $this->maker;
    }

    /**
     * @param mixed $maker
     */
    public function setMaker($maker)
    {
        $this->maker = $maker;
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
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipments()
    {
        return $this->equipments;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $equipments
     */
    public function setEquipments($equipments)
    {
        $this->equipments = $equipments;
    }

    /**
     * @param Equipment|null $equipment
     */
    public function addEquipment(Equipment $equipment = null)
    {
        $this->equipments->add($equipment);
    }

    /**
     * @param Equipment $equipment
     */
    public function removeEquipment(Equipment $equipment)
    {
        $this->equipments->removeElement($equipment) ;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @param Option|null $option
     */
    public function addOption(Option $option = null)
    {
        $this->equipments->add($option);
    }

    /**
     * @param Option $option
     */
    public function removeOption(Option $option)
    {
        $this->equipments->removeElement($option);
    }
}
