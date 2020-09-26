<?php

namespace Izt\Basics\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Izt\Basics\Http\DtGenerators\RoleDataTablesGenerator;
use Izt\Basics\Http\Transformers\RoleTransformer;
use Izt\Basics\Http\Validators\RoleValidator;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Interfaces\ModuleRepositoryInterface;
use Izt\Basics\Storage\Interfaces\RoleRepositoryInterface;
use Izt\Basics\Storage\Interfaces\VariableRepositoryInterface;

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
                'title' => trans_choice('basics.role', 2)
            ]
        ];

        $table_buttons = [
            'partial_route' => 'roles',
            'list' => true,
            'create' => true,
            'trash' => true
        ];

        return view('basics::Roles.index', compact('breadcrumbs', 'table_buttons', 'list_type'));
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
                'title' => trans_choice('basics.role', 2),
                'route' => route('roles.index')
            ],
            [
                'title' => trans_choice('basics.trash', 2)
            ],
        ];

        $table_buttons = [
            'partial_route' => 'roles',
            'list' => true,
            'trash' => true
        ];

        return view('basics::Roles.index', compact('breadcrumbs', 'table_buttons', 'list_type'));
    }


    public function create()
    {
        $role = $this->repoRole->getNew();

        $breadcrumbs = [
            [
                'title' => trans_choice('basics.role', 2),
                'route' => route('roles.index')
            ],
            [
                'title' => trans('basics::basics.new')
            ]
        ];

        $table_buttons = [
            'partial_route' => 'roles',
            'list' => true
        ];

        $form = [
            'action' => route('roles.store'),
            'method' => 'POST',
            'button' => trans('basics::basics.new')
        ];

        $role_modules = [];
        $modules = $this->repoModule->allListed([], ['name' => 'ASC']);

        $languages = getArray($this->repoVariable->getValueByName('lang'));

        return view('basics::Roles.form',
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

        return redirect()->route('roles.edit', $role->id);
    }

    public function edit($id)
    {

        $role = $this->repoRole->findById($id);

        if ($role->isAdmin()) {
            return abort(403);
        }

        $breadcrumbs = [
            [
                'title' => trans_choice('basics.role', 2),
                'route' => route('roles.index')
            ],
            [
                'title' => $role->name
            ]
        ];

        $table_buttons = [
            'partial_route' => 'roles',
            'list' => true,
            'create' => true,
        ];

        $form = [
            'action' => route('roles.update', $id),
            'method' => 'POST',
            'button' => trans('basics::basics.save')
        ];

        $role_modules = $this->repoRole->getRoleModules($role);

        $modules = $this->repoModule->allListed([], ['name' => 'ASC']);

        $languages = getArray($this->repoVariable->getValueByName('lang'));

        return view('basics::Roles.form',
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

        return redirect()->route('roles.edit', $role->id);
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
