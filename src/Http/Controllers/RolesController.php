<?php

namespace Izt\Basics\Http\Controllers;

use App\UiComponents\Module_Cc\FeeTrashComponents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Izt\Basics\Http\DtGenerators\RoleDataTablesGenerator;
use Izt\Basics\Http\Transformers\RoleTransformer;
use Izt\Basics\Http\UiComponents\RolesComponents;
use Izt\Basics\Http\Validators\RoleValidator;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Interfaces\ApplicationRepositoryInterface;
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
     * @var ApplicationRepositoryInterface
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
     * @param ApplicationRepositoryInterface $repoModule
     * @param VariableRepositoryInterface $repoVariable
     */
    public function __construct(
        Request $request,
        RoleRepositoryInterface $repoRole,
        ApplicationRepositoryInterface $repoModule,
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

        $buttonsGenerator = new RolesComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsIndex();

        $table_buttons = $buttonsGenerator->prepareButtonsIndex();

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

        $buttonsGenerator = new RolesComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsTrash();

        $table_buttons = $buttonsGenerator->prepareButtonsTrash();

        return view('basics::Roles.index', compact('breadcrumbs', 'table_buttons', 'list_type'));
    }


    public function create()
    {
        $role = $this->repoRole->getNew();

        $buttonsGenerator = new RolesComponents();

        $breadcrumbs = $buttonsGenerator->prepareFormCreate();

        $table_buttons = $buttonsGenerator->prepareFormCreate();

        $form = $buttonsGenerator->prepareFormCreate();

        $modules = $this->repoModule->allListed([], ['name' => 'ASC']);

        $languages = getArray($this->repoVariable->getValueByName('lang'));

        return view('basics::Roles.form',
            compact('role', 'breadcrumbs', 'form', 'table_buttons', 'modules', 'languages'));
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

        return redirect()->route('roles.edit', $role->id);
    }

    public function edit($id)
    {

        $role = $this->repoRole->findById($id);

        if ($role->isAdmin()) {
            return abort(403);
        }

        $buttonsGenerator = new RolesComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsEdit($role->name);

        $table_buttons = $buttonsGenerator->prepareButtonsEdit();

        $form = $buttonsGenerator->prepareFormEdit($id);

        $modules = $this->repoModule->allListed([], ['name' => 'ASC']);

        $languages = getArray($this->repoVariable->getValueByName('lang'));

        return view('basics::Roles.form',
            compact('role', 'breadcrumbs', 'form', 'table_buttons', 'modules', 'languages'));
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
