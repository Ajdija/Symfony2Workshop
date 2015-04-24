<?php

namespace Acme\ImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Image
 * @ORM\Entity
 * @ORM\Table(name="image")
 * @UniqueEntity("name", groups={"registration", "edit"})
 */
class Image
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @Assert\NotBlank(groups={"registration", "edit"})
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="image")
     */
    protected $comments;

    /**
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Your description must be at least {{ limit }} characters long",
     *      maxMessage = "Your description cannot be longer than {{ limit }} characters",
     *      groups={"registration", "edit"}
     * )
     * @Assert\NotBlank(groups={"registration", "edit"})
     * @var string
     */
    private $description;

    /**
     * @Assert\NotBlank(groups={"registration", "edit"})
     * @Assert\Url(groups={"registration", "edit"})
     * @var string
     */
    private $imageUrl;

    /**
     * @ORM\Column(name="active", options={"default":"false"})
     * @var boolean
     */
    private $active;

    /**
     * @Assert\True(message="Name cannot contain 'Coder's Lab'", groups={"registration"})
     * @return bool
     */
    public function isNameValid(){
        return strpos($this->name, "Coder's Lab") === false;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Image
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Image
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     * @return Image
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string 
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Image
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comments
     *
     * @param \Acme\ImageBundle\Entity\Comment $comments
     * @return Image
     */
    public function addComment(\Acme\ImageBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Acme\ImageBundle\Entity\Comment $comments
     */
    public function removeComment(\Acme\ImageBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
