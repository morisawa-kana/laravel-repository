<?php

namespace Morisawa\Contracts;

/**
 * Interface PresenterInterface
 *
 * @author Morisawa Kana
 */
interface PresenterInterface
{
    /**
     * Prepare data to present
     *
     *
     * @return mixed
     */
    public function present($data);
}
