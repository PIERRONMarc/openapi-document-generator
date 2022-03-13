<?php

namespace App\Service\Builder\BuilderObject;

class OpenApiBuilderObject
{
    private InfoBuilderObject $info;

    /**
     * @var iterable<TagBuilderObject>|null
     */
    private ?iterable $tags = null;

    /**
     * @var iterable<PathBuilderObject>
     */
    private iterable $paths = [];

    public function getInfo(): InfoBuilderObject
    {
        return $this->info;
    }

    public function setInfo(InfoBuilderObject $info): self
    {
        $this->info = $info;

        return $this;
    }

    /**
     * @return iterable<TagBuilderObject>|null
     */
    public function getTags(): iterable|null
    {
        return $this->tags;
    }

    public function addTag(TagBuilderObject $tag): self
    {
        if (null === $this->tags) {
            $this->tags = [];
        }

        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @return iterable<PathBuilderObject>
     */
    public function getPaths(): iterable
    {
        return $this->paths;
    }

    public function addPath(PathBuilderObject $path): self
    {
        $this->paths[] = $path;

        return $this;
    }
}
