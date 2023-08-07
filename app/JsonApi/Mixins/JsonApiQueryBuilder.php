<?php


namespace App\JsonApi\Mixins;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class JsonApiQueryBuilder{

    public function allowedIncludes(): Closure
    {
        return function($allowedIncludes){
            /** @var Builder $this */
            if (request()->isNotFilled('include')) {
                return $this;
            }

            $includes = explode(',', request()->input('include'));


            foreach ($includes as $include) {
                if (! in_array($include, $allowedIncludes)) {
                    throw new BadRequestHttpException("The included relationship '{$include}' is not allowed in the '{$this->getResourceType()}' resource");
                }
                 $this->with($include);
            }
            return $this;
        };
    }

    public function jsonPaginate(): Closure
    {
        return function () {
            /** @var Builder $this */
            $perPage = request('page.size', 4);

            return $this->paginate(
                $perPage,
                $columns = ['*'],
                $pageName = 'page[number]',
                $page = request('page.number', 1)
            )->appends(request()->only('page.size'));
        };
    }

    public function getResourceType(){
        return function () {
            /** @var Builder $this */
            if (property_exists($this->model, 'resourceType')) {
                return $this->model->resourceType;
            }

            return $this->model->getTable();
        };
    }

}

?>
