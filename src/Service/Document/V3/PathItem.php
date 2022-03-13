<?php

namespace App\Service\Document\V3;

use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\SerializedName;

class PathItem
{
    #[Ignore]
    private string $httpMethod;

    /**
     * @var iterable<Tag>|null
     */
    #[SerializedName('tags')]
    private ?iterable $tags = null;

    #[SerializedName('summary')]
    private ?string $summary = null;

    #[SerializedName('description')]
    private ?string $description = null;

    /**
     * @var iterable<Response>
     */
    #[SerializedName('responses')]
    private iterable $responses = [];

    /**
     * @var iterable<Parameter>
     */
    #[SerializedName('parameters')]
    private ?iterable $parameters = null;

    private ?RequestBody $requestBody = null;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    public function setHttpMethod(string $httpMethod): self
    {
        $this->httpMethod = $httpMethod;

        return $this;
    }

    /**
     * @return iterable<Response>
     */
    public function getResponses(): iterable
    {
        return $this->responses;
    }

    public function addResponse(Response $response): self
    {
        $this->responses[] = $response;

        return $this;
    }

    public function getRequestBody(): ?RequestBody
    {
        return $this->requestBody;
    }

    public function setRequestBody(?RequestBody $requestBody): self
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    /**
     * @return iterable<Tag>|null
     */
    public function getTags(): ?iterable
    {
        return $this->tags;
    }

    public function addTag(string $tag): self
    {
        if (null === $this->tags) {
            $this->tags = [];
        }

        $this->tags[] = $tag;

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
