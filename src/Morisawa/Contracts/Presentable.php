<?php

namespace Morisawa\Contracts;

/**
 * Interface Presentable
 *
 * @author Morisawa Kana
 */
interface Presentable
{
    /**
     * @return mixed
     */
    public function setPresenter(PresenterInterface $presenter);

    /**
     * @return mixed
     */
    public function presenter();
}
