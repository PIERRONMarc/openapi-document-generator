<?php

namespace App\Service\Builder;

use App\Service\Builder\BuilderObject\OpenApiBuilderObject;
use App\Service\Builder\BuilderObject\PathBuilderObject;
use App\Service\Builder\BuilderObject\PathItemBuilderObject;
use App\Service\Document\AbstractDocument;
use App\Service\Document\V3\Info;
use App\Service\Document\V3\OpenApi;
use App\Service\Document\V3\Parameter;
use App\Service\Document\V3\Path;
use App\Service\Document\V3\PathItem;
use App\Service\Document\V3\RequestBody;
use App\Service\Document\V3\Response;
use App\Service\Document\V3\Tag;
use App\Service\Hydrator\HydratorInterface;

class DocumentV3Builder implements BuilderInterface
{
    private OpenApi $document;

    private HydratorInterface $hydrator;

    public function __construct(HydratorInterface $hydrator)
    {
        $this->document = new OpenApi();
        $this->hydrator = $hydrator;
    }

    /**
     * {@inheritDoc}
     */
    public function buildDocument(OpenApiBuilderObject $openApiBuilderObject): AbstractDocument
    {
        /**
         * @var Info
         */
        $info = $this->hydrator->hydrateFromObject($openApiBuilderObject->getInfo(), new Info());
        $this->document->setInfo($info);

        foreach ($openApiBuilderObject->getPaths() as $pathBuilderObject) {
            $this->buildPath($pathBuilderObject);
        }

        foreach ($openApiBuilderObject->getTags() as $tagBuilderObject) {
            $tag = $this->hydrator->hydrateFromObject($tagBuilderObject, new Tag());
            $this->document->addTag($tag);
        }

        return $this->document;
    }

    private function buildPath(PathBuilderObject $pathBuilderObject): void
    {
        $path = $this->hydrator->hydrateFromObject($pathBuilderObject, new Path());

        foreach ($pathBuilderObject->getPathItems() as $pathItemBuilderObject) {
            $pathItem = $this->buildPathItem($pathItemBuilderObject);
            $path->addPathItem($pathItem);
        }

        foreach ($pathBuilderObject->getParameters() as $parameterBuilderObject) {
            $parameter = $this->hydrator->hydrateFromObject($parameterBuilderObject, new Parameter());
            $path->addParameter($parameter);
        }

        $this->document->addPath($path);
    }

    private function buildPathItem(PathItemBuilderObject $pathItemBuilderObject): PathItem
    {
        /**
         * @var PathItem
         */
        $pathItem = $this->hydrator->hydrateFromObject($pathItemBuilderObject, new PathItem());
        foreach ($pathItemBuilderObject->getTags() as $tag) {
            /* @phpstan-ignore-next-line */
            $pathItem->addTag($tag);
        }

        if ($pathItemBuilderObject->getRequestBody()) {
            $requestBody = $this->hydrator->hydrateFromObject($pathItemBuilderObject->getRequestBody(), new RequestBody());
            $pathItem->setRequestBody($requestBody);
        }

        foreach ($pathItemBuilderObject->getResponses() as $responseBuilderObject) {
            $response = $this->hydrator->hydrateFromObject($responseBuilderObject, new Response());
            $pathItem->addResponse($response);
        }

        foreach ($pathItemBuilderObject->getParameters() as $parameterBuilderObject) {
            $parameter = $this->hydrator->hydrateFromObject($parameterBuilderObject, new Parameter());
            $pathItem->addParameter($parameter);
        }

        return $pathItem;
    }
}
