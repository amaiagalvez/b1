<?php

namespace Izt\Basics\Http\Transformers;

use Izt\Basics\Storage\Eloquent\Models\Session;
use League\Fractal\TransformerAbstract;

class SessionTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['user'];

    /**
     * @var null
     */
    private $list_type;

    /**
     * SessionTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {
        $this->list_type = $list_type;
    }

    public function transform(Session $session = null)
    {
        if ($session === null) {
            return [];
        }

        return [
            'id' => $session->id,
            'login_at' => getDataTime($session->login_at),
            'logout_at' => getDataTime($session->logout_at),
            'total' => $session->total,
            'ip_address' => $session->ip_address,
            'user_agent' => $session->user_agent,
            'actions' => ''
        ];

    }

    public function includeUser(Session $session = null)
    {
        if ($session === null) {
            $user = null;
        } else {
            $user = $session->user;
        }

        return $this->item($user, new UserTransformer());
    }
}
