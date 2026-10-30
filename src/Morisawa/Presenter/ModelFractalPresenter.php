<?php

namespace Morisawa\Presenter;

use Exception;
use Morisawa\Transformer\ModelTransformer;

/**
 * Class ModelFractalPresenter
 *
 * @author Morisawa Kana
 */
class ModelFractalPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return ModelTransformer
     *
     * @throws Exception
     */
    public function getTransformer()
    {
        if (! class_exists('Morisawa\Manager')) {
            throw new Exception("Package required. Please install: 'composer require Morisawa/fractal' (0.12.*)");
        }

        return new ModelTransformer;
    }
}
