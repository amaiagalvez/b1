<?php

namespace Izt\Basics\Http\Controllers;

use Illuminate\Http\Request;
use Izt\Basics\Http\DtGenerators\SessionDataTablesGenerator;
use Izt\Basics\Http\Transformers\SessionTransformer;
use Izt\Basics\Storage\Eloquent\Models\Session;
use Izt\Basics\Storage\Interfaces\SessionRepositoryInterface;
use Izt\Basics\Storage\Interfaces\UserRepositoryInterface;

class SessionsController extends Controller
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var SessionRepositoryInterface
     */
    private $repoSession;
    /**
     * @var UserRepositoryInterface
     */
    private $repoUser;

    /**
     * UsersController constructor.
     * @param Request $request
     * @param SessionRepositoryInterface $repoSession
     * @param UserRepositoryInterface $repoUser
     */
    public function __construct(
        Request $request,
        SessionRepositoryInterface $repoSession,
        UserRepositoryInterface $repoUser
    ) {

        $this->request = $request;
        $this->repoSession = $repoSession;
        $this->repoUser = $repoUser;
    }

    public function index()
    {
        $list_type = 'index';

        $filters = [
            'userId' => $this->request->get('search_user'),
            'year' => $this->request->get('search_year'),
        ];

        if ($this->request->wantsJson()) {
            $query = $this->repoSession->applyFiltersAndOrderQuery(
                Session::with('user'), false, $filters, []);

            $sessionDataTablesGenerator = new SessionDataTablesGenerator(
                $query,
                new SessionTransformer($list_type));

            return $sessionDataTablesGenerator->get();
        }

        $breadcrumbs = [
            [
                'title' => trans_choice('basics.session', 2)
            ]
        ];

        $table_buttons = [
            'partial_route' => 'sessions',
            'years' => $this->repoSession->getYearsList('login_at'),
            'selects' => [
                [
                    'name' => 'user',
                    'options' => $this->repoUser->getList(),
                    'value' => $filters['userId']
                ]
            ]
        ];

        return view('basics::Sessions.index', compact('breadcrumbs', 'table_buttons', 'list_type'));
    }

}
