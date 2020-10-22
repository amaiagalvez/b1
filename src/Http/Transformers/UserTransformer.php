<?php

namespace Izt\Basics\Http\Transformers;

use Illuminate\Support\Facades\View;
use Izt\Basics\Storage\Eloquent\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['updatedBy', 'deletedBy'];

    /**
     * @var null
     */
    private $list_type;

    /**
     * UserTransformer constructor.
     * @param null $list_type
     */
    public function __construct($list_type = null)
    {
        $this->list_type = $list_type;
    }

    public function transform(User $user = null)
    {
        if ($user === null) {
            return [];
        }

        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => email($user->email),
            'lang' => '<a href="?search_lang=' . $user->lang . '">' . label(mb_strtoupper($user->lang)) . '</a>',
            'role_name' => '<a href="?search_role_name=' . $user->role_name . '">' . label($user->role->present()->name) . '</a>',
            'sessions_count' => $user->sessions_count,
            'notes' => $user->notes,
        ];

        switch ($this->list_type) {
            case 'index':
                $data['actions'] = View::make('basics::Users.partials._row_buttons_index', compact('user'))->render();
                break;

            case 'trash':
                $data['deleted_at'] = getDataTime($user->deleted_at);
                $data['actions'] = View::make('basics::Users.partials._row_buttons_trash', compact('user'))->render();
                break;

            case 'nonactive':
                $data['updated_at'] = getDataTime($user->updated_at);
                $data['actions'] = View::make('basics::Users.partials._row_buttons_nonactive',
                    compact('user'))->render();
                break;

            default:
                $data['actions'] = '';
                break;
        }

        return $data;
    }

    public function includeUpdatedBy(User $user = null)
    {
        if ($user === null) {
            $updatedBy = null;
        } else {
            $updatedBy = $user->updatedBy;
        }

        return $this->item($updatedBy, new BaseTransformer());
    }

    public function includeDeletedBy(User $user = null)
    {
        if ($user === null) {
            $deletedBy = null;
        } else {
            $deletedBy = $user->deletedBy;
        }

        return $this->item($deletedBy, new BaseTransformer());
    }
}
