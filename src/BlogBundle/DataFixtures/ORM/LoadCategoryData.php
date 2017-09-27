<?php
namespace BlogBundle\DataFixtures\ORM;

use BlogBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $generalCategory = new Category();
        $generalCategory->setName('General');
        $manager->persist($generalCategory);
        $this->addReference('general-category', $generalCategory);

        $streetPhotoCategory = new Category();
        $streetPhotoCategory->setName('Street photo');
        $manager->persist($streetPhotoCategory);
        $this->addReference('street-photo', $streetPhotoCategory);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}