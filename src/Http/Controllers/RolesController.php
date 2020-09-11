<?php

namespace Izt\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Izt\Users\Http\DtGenerators\RoleDataTablesGenerator;
use Izt\Users\Http\Transformers\RoleTransformer;
use Izt\Users\Http\Validators\RoleValidator;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Storage\Interfaces\ModuleRepositoryInterface;
use Izt\Users\Storage\Interfaces\RoleRepositoryInterface;
use Izt\Users\Storage\Interfaces\VariableRepositoryInterface;

class RolesController extends Controller
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var RoleRepositoryInterface
     */
    private $repoRole;
    /**
     * @var ModuleRepositoryInterface
     */
    private $repoModule;
    /**
     * @var VariableRepositoryInterface
     */
    private $repoVariable;

    /**
     * RolesController constructor.
     * @param Request $request
     * @param RoleRepositoryInterface $repoRole
     * @param ModuleRepositoryInterface $repoModule
     * @param VariableRepositoryInterface $repoVariable
     */
    public function __construct(
        Request $request,
        RoleRepositoryInterface $repoRole,
        ModuleRepositoryInterface $repoModule,
        VariableRepositoryInterface $repoVariable
    ) {

        $this->request = $request;
        $this->repoRole = $repoRole;
        $this->repoModule = $repoModule;
        $this->repoVariable = $repoVariable;
    }

    public function index()
    {
        $list_type = 'index';

        if ($this->request->wantsJson()) {
            $query = $this->repoRole->applyFiltersAndOrderQuery(
                Role::with('users'), false, [], []);

            $roleDataTablesGenerator = new RoleDataTablesGenerator(
                $query,
                new RoleTransformer($list_type));

            return $roleDataTablesGenerator->get();
        }

        $breadcrumbs = [
            [
                'title' => trans_choice('admin.role', 2)
            ]
        ];

        $table_buttons = [
            'partial_route' => 'admin.roles',
            'list' => true,
            'create' => true,
            'trash' => true
        ];

        return view('admin.App.Roles.index', compact('breadcrumbs', 'table_buttons', 'list_type'));
    }


    public function trash()
    {
        $list_type = 'trash';

        if ($this->request->wantsJson()) {
            $query = $this->repoRole->applyFiltersAndOrderQuery(
                Role::with('deletedBy'), true, [], []);

            $roleDataTablesGenerator = new RoleDataTablesGenerator(
                $query,
                new RoleTransformer($list_type));

            return $roleDataTablesGenerator->get();
        }

        $breadcrumbs = [
            [
                'title' => trans_choice('admin.role', 2),
                'route' => route('admin.roles.index')
            ],
            [
                'title' => trans_choice('admin.trash', 2)
            ],
        ];

        $table_buttons = [
            'partial_route' => 'admin.roles',
            'list' => true,
            'trash' => true
        ];

        return view('admin.App.Roles.index', compact('breadcrumbs', 'table_buttons', 'list_type'));
    }


    public function create()
    {
        $role = $this->repoRole->getNew();

        $breadcrumbs = [
            [
                'title' => trans_choice('admin.role', 2),
                'route' => route('admin.roles.index')
            ],
            [
                'title' => trans('admin.new')
            ]
        ];

        $table_buttons = [
            'partial_route' => 'admin.roles',
            'list' => true
        ];

        $form = [
            'action' => route('admin.roles.store'),
            'method' => 'POST',
            'button' => trans('admin.new')
        ];

        $role_modules = [];
        $modules = $this->repoModule->allListed([], ['name' => 'ASC']);

        $languages = getArray($this->repoVariable->getValueByName('lang'));

        return view('admin.App.Roles.form',
            compact('role', 'breadcrumbs', 'form', 'table_buttons', 'role_modules', 'modules', 'languages'));
    }

    public function store()
    {
        $validator = new RoleValidator();
        if (!$validator->isValid('store')) {
            return back()
                ->withInput()
                ->withErrors($validator->getErrors());
        }

        $role = $this->repoRole->create($this->request->all());

        $this->repoRole->syncModules($role, $this->request->get('modules') ?? []);

        return redirect()->route('admin.roles.edit', $role->id);
    }

    public function edit($id)
    {

        $role = $this->repoRole->findById($id);

        if ($role->isAdmin()) {
            return abort(403);
        }

        $breadcrumbs = [
            [
                'title' => trans_choice('admin.role', 2),
                'route' => route('admin.roles.index')
            ],
            [
                'title' => $role->name
            ]
        ];

        $table_buttons = [
            'partial_route' => 'admin.roles',
            'list' => true,
            'create' => true,
        ];

        $form = [
            'action' => route('admin.roles.update', $id),
            'method' => 'POST',
            'button' => trans('admin.save')
        ];

        $role_modules = $this->repoRole->getRoleModules($role);

        $modules = $this->repoModule->allListed([], ['name' => 'ASC']);

        $languages = getArray($this->repoVariable->getValueByName('lang'));

        return view('admin.App.Roles.form',
            compact('role', 'breadcrumbs', 'form', 'table_buttons', 'role_modules', 'modules', 'languages'));
    }

    public function update($id)
    {
        $role = $this->repoRole->findById($id);

        if ($role->isAdmin()) {
            return abort(403);
        }

        $validator = new RoleValidator();
        $validator->setId($id);

        if (!$validator->isValid('update')) {
            return back()
                ->withInput()
                ->withErrors($validator->getErrors());
        }

        $input = $this->request->all();

        DB::beginTransaction();

        try {
            if ($input['name'] !== $role->name) {
                foreach ($role->users as $user) {
                    $user->update(['role_name' => $input['name']]);
                }
            }

            $this->repoRole->syncModules($role, $input['modules'] ?? []);

            $this->repoRole->update($role, $input);

            DB::commit();
        } catch (Exception $exception) {

            DB::rollback();

            throw $exception;
        }

        return redirect()->route('admin.roles.edit', $role->id);
    }

    public function restore($id)
    {
        return $this->repoRole->restore($id);
    }

    public function delete($id)
    {
        $role = $this->repoRole->findById($id);

        if ($role->isAdmin()) {
            return abort(403);
        }

        return $this->repoRole->secureDelete($role, ['users']);
    }

    public function destroy($id)
    {
        return $this->repoRole->destroy($id);
    }

}
