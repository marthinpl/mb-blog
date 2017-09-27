<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="BlogBundle\Entity\BlogEntry", mappedBy="categories")
     */
    private $blogEntry;

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
     *
     * @return Category
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
     * Constructor
     */
    public function __construct()
    {
        $this->blogEntry = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add blogEntry
     *
     * @param \BlogBundle\Entity\BlogEntry $blogEntry
     *
     * @return Category
     */
    public function addBlogEntry(\BlogBundle\Entity\BlogEntry $blogEntry)
    {
        $this->blogEntry[] = $blogEntry;

        return $this;
    }

    /**
     * Remove blogEntry
     *
     * @param \BlogBundle\Entity\BlogEntry $blogEntry
     */
    public function removeBlogEntry(\BlogBundle\Entity\BlogEntry $blogEntry)
    {
        $this->blogEntry->removeElement($blogEntry);
    }

    /**
     * Get blogEntry
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlogEntry()
    {
        return $this->blogEntry;
    }
}
