<?php namespace Izt\Basics\Storage\Eloquent\Repositories;

use App;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class AbstractRepository
 * @package Izt\Basics\Storage\Eloquent\Repositories
 */
abstract class AbstractRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function getNew(array $attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * @param array|null $with
     * @param string[] $order
     * @param array $filters
     * @param false $onlyTrashed
     * @return mixed
     */
    public function allListed(
        array $with = null,
        $order = ['created_at' => 'desc'],
        array $filters = [],
        $onlyTrashed = false
    ) {
        $modelList = $this->model;

        $modelList = $this->applyFiltersAndOrder($modelList, $with, $onlyTrashed, $filters, $order);

        return $modelList->get();
    }

    /**
     * @param int $perPage
     * @param array|null $with
     * @param string[] $order
     * @param array $filters
     * @param false $onlyTrashed
     * @return mixed
     */
    public function allPaginated(
        $perPage = 20,
        array $with = null,
        $order = ['created_at' => 'desc'],
        array $filters = [],
        $onlyTrashed = false
    ) {
        $modelList = $this->model;

        $modelList = $this->applyFiltersAndOrder($modelList, $with, $onlyTrashed, $filters, $order);

        return $modelList->paginate($perPage);
    }

    /**
     * @param $modelList
     * @param $with
     * @param $onlyTrashed
     * @param $filters
     * @param $order
     * @return mixed
     */
    protected function applyFiltersAndOrder(
        $modelList,
        $with,
        $onlyTrashed,
        $filters,
        $order
    ) {
        if ($with !== null) {
            $modelList = $modelList->with($with);
        }

        if ($onlyTrashed) {
            $modelList = $modelList->onlyTrashed();
        }

        foreach ($filters as $key => $value) {
            $modelList = $modelList->{$key}($value);
        }

        foreach ($order as $key => $value) {
            $modelList = $modelList->orderBy($key, $value);
        }

        return $modelList;
    }

    /**
     * @param $query
     * @param $onlyTrashed
     * @param $filters
     * @param $order
     * @return mixed
     */
    public function applyFiltersAndOrderQuery(
        $query,
        $onlyTrashed,
        $filters,
        $order
    ) {

        if ($onlyTrashed) {
            $query->onlyTrashed();
        }

        foreach ($filters as $key => $value) {
            $query->{$key}($value);
        }

        foreach ($order as $key => $value) {
            $query->orderBy($key, $value);
        }

        return $query;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $field
     * @param $value
     * @return mixed
     */
    public function findByField($field, $value)
    {
        return $this->model->where($field, '=', $value)
            ->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findByIdInAll($id)
    {
        return $this->model->withTrashed()
            ->findOrFail($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findByIdInTrash($id)
    {
        return $this->model->onlyTrashed()
            ->findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function findFirst()
    {
        return $this->model->first();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @return bool
     */
    public function update(
        Model $model,
        array $data
    ) {
        return $model->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $toDelete = $this->findById($id);

        $toDelete->delete();

        return back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function restore($id)
    {
        $toRestore = $this->findByIdInTrash($id);

        $toRestore->restore();

        return back();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $toDestroy = $this->findByIdInTrash($id);

        $toDestroy->forceDelete();

        return back();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function activate($id)
    {
        $toActivate = $this->model
            ->findOrFail($id)
            ->update([
                'active' => 1,
                'updated_by' => Auth::id()
            ]);

        return back()->with('successMessage', trans('basics::action.activate_successfully'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deactivate($id)
    {
        $toDeactivate = $this->model
            ->findOrFail($id)
            ->update([
                'active' => 0,
                'updated_by' => Auth::id()
            ]);

        return back()->with('successMessage', trans('basics::action.deactivate_successfully'));
    }

    /**
     * @param Model $model
     * @param $relations
     * @return mixed
     */
    public function secureDelete(Model $model, $relations)
    {

        if ($model->secureDelete($relations)) {
            return $this->delete($model->id);
        }

        return back()->with('errorMessage', trans('basics::action.cannot_delete'));
    }

    /**
     * @param false $empty
     * @param array $filters
     * @param string $field
     * @return mixed
     */
    public function getList(
        $empty = false,
        array $filters = [],
        $field = 'name'
    ) {

        $query = $this->model->orderBy($field, 'asc');

        foreach ($filters as $key => $value) {
            $query->{$key}($value);
        }

        $query = $query->pluck($field, 'id');

        if ($empty) {
            $query = $query->prepend('--', '0');
        }

        return $query;
    }

    /**
     * @param $field
     * @return array
     */
    public function getYearsList($field)
    {
        if (env('APP_ENV') == 'testing') {
            $list = $this->getModel()
                ->select(DB::raw('strftime("%Y", ' . $field . ') AS year'))
                ->groupBy('year')
                ->orderBy('year', 'ASC')
                ->get();
        } else {
            $list = $this->getModel()
                ->select(DB::raw('year(' . $field . ') AS year'))
                ->groupBy('year')
                ->orderBy('year', 'ASC')
                ->get();
        }

        $year_list = [];
        foreach ($list as $element) {
            $year_list[] = $element->year;
        }

        return $year_list;
    }
}
