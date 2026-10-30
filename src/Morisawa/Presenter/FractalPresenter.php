<?php

namespace Morisawa\Presenter;

use Exception;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Morisawa\Manager;
use Morisawa\Pagination\IlluminatePaginatorAdapter;
use Morisawa\Resource\Collection;
use Morisawa\Resource\Item;
use Morisawa\Serializer\SerializerAbstract;
use Morisawa\TransformerAbstract;
use Morisawa\Contracts\PresenterInterface;

/**
 * Class FractalPresenter
 *
 * @author Morisawa Kana
 */
abstract class FractalPresenter implements PresenterInterface
{
    /**
     * @var string
     */
    protected $resourceKeyItem = null;

    /**
     * @var string
     */
    protected $resourceKeyCollection = null;

    /**
     * @var Manager
     */
    protected $fractal = null;

    /**
     * @var Collection
     */
    protected $resource = null;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (! class_exists('Morisawa\Manager')) {
            throw new Exception(trans('repository::packages.Morisawa_fractal_required'));
        }

        $this->fractal = new Manager;
        $this->parseIncludes();
        $this->setupSerializer();
    }

    /**
     * @return $this
     */
    protected function setupSerializer()
    {
        $serializer = $this->serializer();

        if ($serializer instanceof SerializerAbstract) {
            $this->fractal->setSerializer(new $serializer);
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function parseIncludes()
    {

        $request = app('Illuminate\Http\Request');
        $paramIncludes = config('repository.fractal.params.include', 'include');

        if ($request->has($paramIncludes)) {
            $this->fractal->parseIncludes($request->get($paramIncludes));
        }

        return $this;
    }

    /**
     * Get Serializer
     *
     * @return SerializerAbstract
     */
    public function serializer()
    {
        $serializer = config('repository.fractal.serializer', 'Morisawa\\Serializer\\DataArraySerializer');

        return new $serializer;
    }

    /**
     * Transformer
     *
     * @return TransformerAbstract
     */
    abstract public function getTransformer();

    /**
     * Prepare data to present
     *
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function present($data)
    {
        if (! class_exists('Morisawa\Manager')) {
            throw new Exception(trans('repository::packages.Morisawa_fractal_required'));
        }

        if ($data instanceof EloquentCollection) {
            $this->resource = $this->transformCollection($data);
        } elseif ($data instanceof AbstractPaginator) {
            $this->resource = $this->transformPaginator($data);
        } else {
            $this->resource = $this->transformItem($data);
        }

        return $this->fractal->createData($this->resource)->toArray();
    }

    /**
     * @return Item
     */
    protected function transformItem($data)
    {
        return new Item($data, $this->getTransformer(), $this->resourceKeyItem);
    }

    /**
     * @return Collection
     */
    protected function transformCollection($data)
    {
        return new Collection($data, $this->getTransformer(), $this->resourceKeyCollection);
    }

    /**
     * @param  AbstractPaginator|LengthAwarePaginator|Paginator  $paginator
     * @return Collection
     */
    protected function transformPaginator($paginator)
    {
        $collection = $paginator->getCollection();
        $resource = new Collection($collection, $this->getTransformer(), $this->resourceKeyCollection);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        return $resource;
    }
}
