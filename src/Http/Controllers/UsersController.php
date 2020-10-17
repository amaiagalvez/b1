<?php

namespace Izt\Basics\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Izt\Basics\Http\DtGenerators\UserDataTablesGenerator;
use Izt\Basics\Http\Transformers\UserTransformer;
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

        $breadcrumbs = [
            [
                'title' => trans_choice('basics::basics.user', 2)
            ]
        ];

        $table_buttons = [
            'partial_route' => 'users',
            'list' => true,
            'create' => true,
            'nonactive' => true,
            'trash' => true,
            'languages' => getArray($this->repoVariable->getValueByName('lang'))
        ];

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

        $breadcrumbs = [
            [
                'title' => trans_choice('basics::basics.user', 2),
                'route' => route('users.index')
            ],
            [
                'title' => trans('helpers::action.nonactive')
            ]
        ];

        $table_buttons = [
            'partial_route' => 'users',
            'list' => true,
            'nonactive' => true
        ];

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

        $breadcrumbs = [
            [
                'title' => trans_choice('basics::basics.user', 2),
                'route' => route('users.index')
            ],
            [
                'title' => trans_choice('helpers::action.trash', 2)
            ],
        ];

        $table_buttons = [
            'partial_route' => 'users',
            'list' => true,
            'trash' => true
        ];

        return view('basics::Users.index', compact('breadcrumbs', 'table_buttons', 'list_type'));
    }

    public function create()
    {
        $user = $this->repoUser->getNew();

        $breadcrumbs = [
            [
                'title' => trans_choice('basics::basics.user', 2),
                'route' => route('users.index')
            ],
            [
                'title' => trans('helpers::action.create')
            ]
        ];

        $table_buttons = [
            'partial_route' => 'users',
            'list' => true
        ];

        $form = [
            'action' => route('users.store'),
            'method' => 'POST',
            'button' => trans('helpers::action.create')
        ];

        $roles = $this->repoRole->getList(true);

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

        $breadcrumbs = [
            [
                'title' => trans_choice('basics::basics.user', 2),
                'route' => route('users.index')
            ],
            [
                'title' => $user->name
            ]
        ];

        $table_buttons = [
            'partial_route' => 'users',
            'list' => true,
            'create' => true,
        ];

        $form = [
            'action' => route('users.update', $id),
            'method' => 'POST',
            'button' => trans('helpers::action.save')
        ];

        $roles = $this->repoRole->getList(true);

        return view('basics::Users.form',
            compact('user', 'breadcrumbs', 'form', 'table_buttons', 'roles'));
    }

    public function profile()
    {
        $id = Auth::id();

        $user = $this->repoUser->findById($id);

        $breadcrumbs = [
            [
                'title' => trans_choice('basics::basics.user', 2)
            ],
            [
                'title' => $user->name
            ]
        ];

        $table_buttons = [

        ];

        $form = [
            'action' => route('users.update', $id),
            'method' => 'POST',
            'button' => trans('helpers::action.save')
        ];

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
            return redirect()->route('basics.home');
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
                Cache::flush();
                auth()->login($real_user);
                session()->forget('real_user');

                return redirect()->route('users.index');
            }
        }

        return abort(403);
    }
}
