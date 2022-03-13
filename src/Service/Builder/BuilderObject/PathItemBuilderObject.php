<?php

namespace App\Service\Builder\BuilderObject;

class PathItemBuilderObject
{
    private string $httpMethod;

    /**
     * @var iterable<TagBuilderObject>
     */
    private iterable $tags = [];

    private ?string $summary = null;

    private ?string $description = null;

    /**
     * @var iterable<ResponseBuilderObject>
     */
    private iterable $responses = [];

    private ?RequestBodyBuilderObject $requestBody = null;

    /**
     * @var iterable<ParameterBuilderObject>
     */
    private iterable $parameters = [];

    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    public function setHttpMethod(string $httpMethod): self
    {
        $this->httpMethod = $httpMethod;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return iterable<ResponseBuilderObject>
     */
    public function getResponses(): iterable
    {
        return $this->responses;
    }

    public function addResponse(ResponseBuilderObject $response): self
    {
        $this->responses[] = $response;

        return $this;
    }

    public function getRequestBody(): ?RequestBodyBuilderObject
    {
        return $this->requestBody;
    }

    public function setRequestBody(?RequestBodyBuilderObject $requestBody): self
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    /**
     * @return iterable<TagBuilderObject>
     */
    public function getTags(): iterable
    {
        return $this->tags;
    }

    public function addTag(string $tag): self
    {
        /* @phpstan-ignore-next-line */
        if (null === $this->tags) {
            $this->tags = [];
        }

        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @return iterable<ParameterBuilderObject>
     */
    public function getParameters(): iterable
    {
        return $this->parameters;
    }

    public function addParameter(ParameterBuilderObject $parameter): self
    {
        $this->parameters[] = $parameter;

        return $this;
    }
}
