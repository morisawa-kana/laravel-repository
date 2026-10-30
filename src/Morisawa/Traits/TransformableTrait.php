<?php

namespace Morisawa\Traits;

/**
 * Class TransformableTrait
 *
 * @author Morisawa Kana
 */
trait TransformableTrait
{
    /**
     * @return array
     */
    public function transform()
    {
        return $this->toArray();
    }
}
