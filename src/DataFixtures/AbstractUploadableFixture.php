<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Filesystem\Filesystem;

abstract class AbstractUploadableFixture extends Fixture
{
    public function __construct(
        private readonly string $publicPath,
        private readonly string $projectDir,
    ) {
    }

    protected function copyImage(string $imagePath, string $imageName): void
    {
        $filesystem = new Filesystem();
        $filesystem->copy($imagePath, $this->projectDir.'/'.$this->publicPath.'/'.$imageName);
    }
}
