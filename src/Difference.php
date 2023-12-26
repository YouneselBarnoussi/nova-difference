<?php

namespace Youbar\Difference;

use Laravel\Nova\Fields\Field;

class Difference extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'difference';

    /**
     * The field's component.
     *
     * @var string
     */
    protected $oldAttribute;

    /**
     * The field's component.
     *
     * @var string
     */
    protected $newAttribute;

    /**
     * Create a new field.
     */
    public function __construct($name, $oldAttribute = null, $newAttribute = null, ?callable $resolveCallback = null)
    {
        parent::__construct($name, $oldAttribute, $resolveCallback);

        $this->newAttribute = $newAttribute;
        $this->oldAttribute = $oldAttribute;
    }

    /**
     * Resolve the field's value.
     *
     * @param  null|string  $attribute
     * @return void
     */
    public function resolve($resource, $attribute = null)
    {
        $oldValue = $resource->{$this->oldAttribute};
        $newValue = $resource->{$this->newAttribute};

        $this->withMeta([
            'oldValue' => $oldValue,
            'newValue' => $newValue,
        ]);
    }
}
