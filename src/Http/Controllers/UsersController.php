<?php

namespace Izt\Basics\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Izt\Basics\Http\DtGenerators\UserDataTablesGenerator;
use Izt\Basics\Http\Transformers\UserTransformer;
use Izt\Basics\Http\UIComponents\UserComponents;
use Izt\Basics\Http\Validators\UserValidator;
use Izt\Basics\Storage\Eloquent\Models\User;
use Izt\Basics\Storage\Interfaces\RoleRepositoryInterface;
use Izt\Basics\Storage\Interfaces\UserRepositoryInterface;
use Izt\Basics\Storage\Interfaces\VariableRepositoryInterface;

class UsersController extends Controller
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var UserRepositoryInterface
     */
    private $repoUser;
    /**
     * @var RoleRepositoryInterface
     */
    private $repoRole;
    /**
     * @var VariableRepositoryInterface
     */
    private $repoVariable;

    /**
     * UsersController constructor.
     * @param Request $request
     * @param UserRepositoryInterface $repoUser
     * @param RoleRepositoryInterface $repoRole
     * @param VariableRepositoryInterface $repoVariable
     */
    public function __construct(
        Request $request,
        UserRepositoryInterface $repoUser,
        RoleRepositoryInterface $repoRole,
        VariableRepositoryInterface $repoVariable
    ) {

        $this->request = $request;
        $this->repoUser = $repoUser;
        $this->repoRole = $repoRole;
        $this->repoVariable = $repoVariable;
    }

    public function index()
    {
        $list_type = 'index';

        $filters = [
            'lang' => $this->request->get('search_lang'),
            'roleName' => $this->request->get('search_role_name'),
            'active' => 1,
            'onlyUsers' => true
        ];

        if ($this->request->wantsJson()) {
            $query = $this->repoUser->applyFiltersAndOrderQuery(
                User::with(['sessions', 'role', 'updatedBy'])->withCount(['sessions']), false, $filters, []);

            $userDataTablesGenerator = new UserDataTablesGenerator(
                $query,
                new UserTransformer($list_type));

            return $userDataTablesGenerator->get();
        }

        $buttonsGenerator = new UserComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsIndex();

        $languages = getArray($this->repoVariable->getValueByName('lang'));
        $table_buttons = $buttonsGenerator->prepareButtonsIndex($languages);

        return view('basics::Users.index', compact('breadcrumbs', 'table_buttons', 'list_type'));
    }

    public function nonactive()
    {
        $list_type = 'nonactive';

        $filters = [
            'lang' => $this->request->get('search_lang'),
            'roleName' => $this->request->get('search_role_name'),
            'active' => 0,
            'onlyUsers' => true
        ];

        if ($this->request->wantsJson()) {
            $query = $this->repoUser->applyFiltersAndOrderQuery(
                User::with(['sessions', 'role', 'updatedBy'])->withCount(['sessions']), false, $filters, []);

            $userDataTablesGenerator = new UserDataTablesGenerator(
                $query,
                new UserTransformer($list_type));

            return $userDataTablesGenerator->get();
        }

        $buttonsGenerator = new UserComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsNonActive();

        $table_buttons = $buttonsGenerator->prepareButtonsNonActive();

        return view('basics::Users.index', compact('breadcrumbs', 'table_buttons', 'list_type'));
    }

    public function trash()
    {
        $list_type = 'trash';

        $filters = [
            'lang' => $this->request->get('search_lang'),
            'roleName' => $this->request->get('search_role_name'),
            'onlyUsers' => true
        ];

        if ($this->request->wantsJson()) {
            $query = $this->repoUser->applyFiltersAndOrderQuery(
                User::with(['sessions', 'role', 'deletedBy']), true, $filters, []);

            $userDataTablesGenerator = new UserDataTablesGenerator(
                $query,
                new UserTransformer($list_type));

            return $userDataTablesGenerator->get();
        }

        $buttonsGenerator = new UserComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsTrash();

        $table_buttons = $buttonsGenerator->prepareButtonsTrash();

        return view('basics::Users.index', compact('breadcrumbs', 'table_buttons', 'list_type'));
    }

    public function create()
    {
        $user = $this->repoUser->getNew();

        $buttonsGenerator = new UserComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsCreate();

        $table_buttons = $buttonsGenerator->prepareButtonsCreate();

        $form = $buttonsGenerator->prepareFormCreate();

        $roles = $this->repoRole->getList(true, ['active' => 1]);

        return view('basics::Users.form',
            compact('user', 'breadcrumbs', 'form', 'table_buttons', 'roles'));
    }

    public function store()
    {
        $validator = new UserValidator();
        if (!$validator->isValid('store')) {
            return back()->withInput()->withErrors($validator->getErrors());
        }

        $user = $this->repoUser->create($this->request->all());

        return redirect()->route('users.edit', $user->id);
    }

    public function edit($id)
    {

        $user = $this->repoUser->findById($id);

        if ($user->isDeveloper() && $user->id !== Auth::id()) {
            return abort(403);
        }

        $buttonsGenerator = new UserComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsEdit($user->name);

        $table_buttons = $buttonsGenerator->prepareButtonsEdit();

        $form = $buttonsGenerator->prepareFormEdit($id);

        $roles = $this->repoRole->getList(true, ['active' => 1]);

        return view('basics::Users.form',
            compact('user', 'breadcrumbs', 'form', 'table_buttons', 'roles'));
    }

    public function profile()
    {
        $id = Auth::id();

        $user = $this->repoUser->findById($id);

        $buttonsGenerator = new UserComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsProfile($user->name);

        $table_buttons = $buttonsGenerator->prepareButtonsProfile();

        $form = $buttonsGenerator->prepareFormProfile($id);

        return view('basics::Users.profile', compact('user', 'breadcrumbs', 'form', 'table_buttons'));
    }

    public function update($id)
    {
        $user = $this->repoUser->findById($id);

        if ($user->isDeveloper() && $user->id !== Auth::id()) {
            return abort(403);
        }

        $validator = new UserValidator();
        $validator->setId($id);

        if (!$validator->isValid('update')) {
            return back()->withInput()->withErrors($validator->getErrors());
        }

        $input = $this->request->all();

        if (str_contains(getPreviousRoute(), 'profile')) {
            unset($input['role_name'], $input['notes']);
            $this->repoUser->update($user, $input);
            return redirect()->route('home');
        }

        $this->repoUser->update($user, $input);
        return redirect()->route('users.edit', $user->id);
    }

    public function restore($id)
    {
        return $this->repoUser->restore($id);
    }

    public function delete($id)
    {
        $user = $this->repoUser->findById($id);

        return $this->repoUser->secureDelete($user, ['sessions']);
    }

    public function activate($id)
    {
        return $this->repoUser->activate($id);
    }

    public function deactivate($id)
    {
        return $this->repoUser->deactivate($id);
    }

    public function destroy($id)
    {
        return $this->repoUser->destroy($id);
    }

    public function loginAs($id)
    {
        if (Auth::user()->isDeveloper()) {
            session()->put('real_user', Auth::id());

            $user = $this->repoUser->findById($id);
            Cache::flush();
            auth()->login($user);

            if (auth()->user()->isAdmin()) {
                return redirect()->route('home');
            }

            return redirect()->route('front.home');
        }

        return abort(403);
    }

    public function logoutAs()
    {
        if (session()->has('real_user')) {
            $real_user_id = session()->get('real_user');
            $real_user = $this->repoUser->findById($real_user_id);

            if ($real_user->isDeveloper()) {
                auth()->login($real_user);
                session()->forget('real_user');

                return redirect()->route('users.index');
            }
        }

        return abort(403);
    }
}
