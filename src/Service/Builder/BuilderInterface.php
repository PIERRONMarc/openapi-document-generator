<?php

namespace App\Service\Builder;

use App\Service\Builder\BuilderObject\OpenApiBuilderObject;
use App\Service\Document\AbstractDocument;

/**
 * OpenAPI document builder.
 *
 * It builds an OpenAPI document in a specific format from builders objects.
 */
interface BuilderInterface
{
    /**
     * Build an OpenAPI document from a builder object.
     *
     * @return AbstractDocument the builded document
     */
    public function buildDocument(OpenApiBuilderObject $openApiBuilderObject): AbstractDocument;
}
