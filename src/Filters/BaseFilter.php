<?php

namespace ProjektGopher\FFMpegTools\Filters;

abstract class BaseFilter
{
    protected string $filter_name;

    protected array $properties = [];

    final public function __construct()
    {
    }

    public static function make(): self
    {
        return new static();
    }

    public function build(): string
    {
        $properties = [];

        foreach ($this->properties as $key => $value) {
            $properties[] = "{$key}={$value}";
        }

        $properties = implode(':', $this->properties);

        return "{$this->filter_name}={$properties}";
    }

    public function __toString(): string
    {
        return $this->build();
    }

    public function __call(string $name, array $arguments): self
    {
        $this->properties[$name] = (string) $arguments[0];

        return $this;
    }
}
