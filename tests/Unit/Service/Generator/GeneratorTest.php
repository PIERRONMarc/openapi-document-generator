<?php

namespace App\Tests\Unit\Service\Generator;

use App\Entity\OpenApiDocument;
use App\Repository\OpenApiDocumentRepository;
use App\Service\Builder\BuilderInterface;
use App\Service\Document\AbstractDocument;
use App\Service\Generator\Generator;
use App\Service\Generator\GeneratorInterface;
use App\Service\Hydrator\Hydrator;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    private GeneratorInterface $generator;

    protected function setUp(): void
    {
        $openApiDocument = new OpenApiDocument();
        $openApiDocument->setId('b842cac0-cbe1-401e-b4bc-97b39c97cc1d');
        $openApiDocument->setTitle('Pet Store');

        $openApiDocumentRepository = $this->createMock(OpenApiDocumentRepository::class);
        $openApiDocumentRepository->method('findOneBy')
            ->willReturn($openApiDocument);
        $builder = $this->createMock(BuilderInterface::class);
        $this->generator = new Generator($openApiDocumentRepository, $builder, new Hydrator());
    }

    public function testGenerationFromDatabase(): void
    {
        $openApi = $this->generator->generate('b842cac0-cbe1-401e-b4bc-97b39c97cc1d');
        $this->assertInstanceOf(AbstractDocument::class, $openApi);
    }

    protected function tearDown(): void
    {
        unset($this->fromDatabaseGenerator);
    }
}
