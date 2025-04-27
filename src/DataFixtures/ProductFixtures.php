<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Money\Money;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category1 = new Category();
        $category1->setCode('category1');

        $category2 = new Category();
        $category2->setCode('category2');

        $manager->persist($category1);
        $manager->persist($category2);

        $product1 = new Product();
        $product1->setName('Product 1')
            ->setPrice(Money::USD(1000))
            ->addCategory($category1)
            ->addCategory($category2);

        $product2 = new Product();
        $product2->setName('Product 2')
            ->setPrice(Money::EUR(5000))
            ->addCategory($category1);

        $product3 = new Product();
        $product3->setName('Product 3')
            ->setPrice(Money::CHF(3000))
            ->addCategory($category2);

        $manager->persist($product1);
        $manager->persist($product2);
        $manager->persist($product3);

        $manager->flush();
    }
}