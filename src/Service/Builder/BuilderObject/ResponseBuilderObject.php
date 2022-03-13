<?php

namespace App\Service\Builder\BuilderObject;

class ResponseBuilderObject
{
    private int $httpStatusCode;

    private ?string $description = null;

    /**
     * @var array<mixed>
     */
    private ?array $content = null;

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    public function setHttpStatusCode(int $httpStatusCode): self
    {
        $this->httpStatusCode = $httpStatusCode;

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
     * @return mixed[]|null
     */
    public function getContent(): ?array
    {
        return $this->content;
    }

    /**
     * @param mixed[]|null $content
     */
    public function setContent(?array $content): self
    {
        $this->content = $content;

        return $this;
    }
}
