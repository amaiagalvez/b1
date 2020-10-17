<?php

namespace Izt\Basics\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Izt\Basics\Http\DtGenerators\RoleDataTablesGenerator;
use Izt\Basics\Http\Transformers\RoleTransformer;
use Izt\Basics\Http\UIComponents\RolesComponents;
use Izt\Basics\Http\Validators\RoleValidator;
use Izt\Basics\Storage\Eloquent\Models\Role;
use Izt\Basics\Storage\Interfaces\RoleRepositoryInterface;

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
     * RolesController constructor.
     * @param Request $request
     * @param RoleRepositoryInterface $repoRole
     */
    public function __construct(
        Request $request,
        RoleRepositoryInterface $repoRole
    ) {

        $this->request = $request;
        $this->repoRole = $repoRole;
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

    public function nonactive()
    {
        $list_type = 'nonactive';

        $filters = [
            'active' => 0
        ];

        if ($this->request->wantsJson()) {
            $query = $this->repoRole->applyFiltersAndOrderQuery(
                Role::with(['updatedBy']), false, $filters, []);

            $roleDataTablesGenerator = new RoleDataTablesGenerator(
                $query,
                new RoleTransformer($list_type));

            return $roleDataTablesGenerator->get();
        }

        $buttonsGenerator = new RolesComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsNonActive();

        $table_buttons = $buttonsGenerator->prepareButtonsNonActive();

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

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsCreate();

        $table_buttons = $buttonsGenerator->prepareButtonsCreate();

        $form = $buttonsGenerator->prepareFormCreate();

        return view('basics::Roles.form',
            compact('role', 'breadcrumbs', 'form', 'table_buttons'));
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

        return view('basics::Roles.form',
            compact('role', 'breadcrumbs', 'form', 'table_buttons'));
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

    public function activate($id)
    {
        return $this->repoRole->activate($id);
    }

    public function deactivate($id)
    {
        return $this->repoRole->deactivate($id);
    }
}
