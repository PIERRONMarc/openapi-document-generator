<?php

namespace App\Service\Document\V3;

use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Response
{
    #[Ignore]
    private int $httpStatusCode;

    #[SerializedName('description')]
    private ?string $description;

    /**
     * @var array<mixed>
     */
    #[SerializedName('content')]
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
        $this->content['application/json']['schema'] = $content;

        return $this;
    }
}
