<?php

namespace App\Service\Document\V3;

use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Path
{
    #[Ignore]
    private string $endpoint;

    /**
     * @var iterable<Parameter>
     */
    #[SerializedName('parameters')]
    private ?iterable $parameters = null;

    /**
     * @var iterable<PathItem>
     */
    private iterable $pathItems = [];

    /**
     * @return iterable<PathItem>
     */
    public function getPathItems(): iterable
    {
        return $this->pathItems;
    }

    public function addPathItem(PathItem $pathItem): self
    {
        $this->pathItems[] = $pathItem;

        return $this;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return iterable<Parameter>|null
     */
    public function getParameters(): ?iterable
    {
        return $this->parameters;
    }

    public function addParameter(Parameter $parameter): self
    {
        if (null === $this->parameters) {
            $this->parameters = [];
        }

        $this->parameters[] = $parameter;

        return $this;
    }
}
