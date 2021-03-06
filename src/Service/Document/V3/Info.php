<?php

namespace App\Service\Document\V3;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Info
{
    #[SerializedName('title')]
    private string $title;

    #[SerializedName('version')]
    private string $version;

    #[SerializedName('description')]
    private ?string $description = null;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}
