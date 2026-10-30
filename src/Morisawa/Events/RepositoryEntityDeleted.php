<?php

namespace Morisawa\Events;

/**
 * Class RepositoryEntityDeleted
 *
 * @author Morisawa Kana
 */
class RepositoryEntityDeleted extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = 'deleted';
}
