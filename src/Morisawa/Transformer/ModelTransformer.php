<?php

namespace Morisawa\Transformer;

use Morisawa\TransformerAbstract;
use Morisawa\Contracts\Transformable;

/**
 * Class ModelTransformer
 *
 * @author Morisawa Kana
 */
class ModelTransformer extends TransformerAbstract
{
    public function transform(Transformable $model)
    {
        return $model->transform();
    }
}
