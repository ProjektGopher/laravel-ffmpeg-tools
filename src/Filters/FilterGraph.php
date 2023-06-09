<?php

namespace ProjektGopher\FFMpegTools\Filters;

final class FilterGraph
{
    protected array $filters = [];

    public static function make(): static
    {
        return new static();
    }

    public function addFilter(
        string $in,
        string|array|Filter $filters,
        string|null $out = null,
    ): self {
        $this->filters[] = [
            'in' => $this->validateStreams($in),
            'filters' => $this->validateFilters($filters),
            'out' => $out ? $this->validateStreams($out) : null,
        ];

        return $this;
    }

    public function validateStreams(string $streams): string
    {
        if (! preg_match('/^(\[[a-zA-Z0-9-_:]+\])+$/', $streams)) {
            throw new \Exception("Could not parse stream {$streams}");
        }

        return $streams;
    }

    public function validateFilters(string|array|Filter $filters): array
    {
        if ($filters instanceof Filter) {
            return [(string) $filters];
        }

        if (is_string($filters)) {
            return [$filters];
        }

        $thing = [];
        foreach ($filters as $filter) {
            $thing[] = $this->validateFilters($filter)[0];
        }

        return $thing;
    }

    public function buildFilterString(array $filter): string
    {
        $filterString = "{$filter['in']} ";
        $filterString .= implode(', ', $filter['filters']);
        if ($filter['out']) {
            $filterString .= " {$filter['out']}";
        }

        return $filterString;
    }

    public function build(): string
    {
        $filters = [];
        foreach ($this->filters as $filter) {
            $filters[] = $this->buildFilterString($filter);
        }
        $filters = implode(';', $filters);

        return "-filter_complex \"{$filters}\"";
    }

    public function __toString(): string
    {
        return $this->build();
    }
}
