<?php

namespace App\Service\Builder\BuilderObject;

class ParameterBuilderObject
{
    private string $name;

    private string $location;

    private ?string $description = null;

    private bool $required;

    /**
     * @var array<mixed>
     */
    private array $schema = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

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

    public function getRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): self
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @return mixed[]
     */
    public function getSchema(): array
    {
        return $this->schema;
    }

    /**
     * @param array<mixed> $schema
     */
    public function setSchema(array $schema): self
    {
        $this->schema = $schema;

        return $this;
    }
}
