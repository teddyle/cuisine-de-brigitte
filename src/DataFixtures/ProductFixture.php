<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductFixture extends AbstractUploadableFixture
{
    private const string IMAGE_DIRECTORY = __DIR__.'/images/';

    public function load(ObjectManager $manager): void
    {
        $appleProduct = new Product();
        $appleProduct->setName('Pomme');
        $this->addImageToProduct($appleProduct, 'apple.jpeg');
        $manager->persist($appleProduct);

        $manager->flush();
    }

    private function addImageToProduct(Product &$product, string $imageName): void
    {
        $filesystem = new Filesystem();

        $product->setThumbnailName($imageName);

        $imagePath = self::IMAGE_DIRECTORY.$product->getThumbnailName();

        if ($filesystem->exists($imagePath)) {
            $file = new UploadedFile($imagePath, 'example.jpg', null, null, true);
            $product->updateThumbnail($file);

            if (null !== $product->getThumbnailName()) {
                $this->copyImage($imagePath, $product->getThumbnailName());
            }
        }
    }
}
