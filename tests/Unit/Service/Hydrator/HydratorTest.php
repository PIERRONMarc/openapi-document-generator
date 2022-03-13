<?php

namespace App\Tests\Unit\Service\Hydrator;

use App\Service\Hydrator\Hydrator;
use PHPUnit\Framework\TestCase;

class HydratorTest extends TestCase
{
    private Hydrator $hydrator;

    protected function setUp(): void
    {
        $this->hydrator = new Hydrator();
    }

    private function getObjectToHydrate(): object
    {
        return new class() {
            private ?string $title = null;

            public function getTitle(): ?string
            {
                return $this->title;
            }

            public function setTitle(?string $title): self
            {
                $this->title = $title;

                return $this;
            }
        };
    }

    public function testHydrationFromObject(): void
    {
        $hydrator = new Hydrator();
        $object = new class() {
            private ?string $title = 'Pet Store';

            public function getTitle(): ?string
            {
                return $this->title;
            }

            public function setTitle(?string $title): self
            {
                $this->title = $title;

                return $this;
            }
        };

        $objectToHydrate = $hydrator->hydrateFromObject($object, $this->getObjectToHydrate());
        $this->assertEquals('Pet Store', $objectToHydrate->getTitle());
    }

    /**
     * Hydrator must do nothing when a TypeError exception is triggered.
     */
    public function testWrongType(): void
    {
        $object = new class() {
            private array $title = [0, 1];

            public function getTitle(): array
            {
                return $this->title;
            }

            public function setTitle(int $title): self
            {
                $this->title = $title;

                return $this;
            }
        };

        $objectToHydrate = $this->hydrator->hydrateFromObject($object, $this->getObjectToHydrate());
        $this->assertNotEquals([0, 1], $objectToHydrate->getTitle());
    }

    /**
     * Test that no exception is thrown.
     */
    public function testUndefinedGetter(): void
    {
        $this->expectNotToPerformAssertions();
        $object = new class() {
            private string $title = 'lorem';

            public function setTitle(string $title): self
            {
                $this->title = $title;

                return $this;
            }
        };
        $this->hydrator->hydrateFromObject($object, $this->getObjectToHydrate());
    }

    protected function tearDown(): void
    {
        unset($this->hydrator);
    }
}
