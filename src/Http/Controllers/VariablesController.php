<?php

namespace Izt\Basics\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Izt\Basics\Http\DtGenerators\VariableDataTablesGenerator;
use Izt\Basics\Http\Transformers\VariableTransformer;
use Izt\Basics\Http\UIComponents\VariableComponents;
use Izt\Basics\Http\Validators\VariableValidator;
use Izt\Basics\Storage\Eloquent\Models\Variable;
use Izt\Basics\Storage\Interfaces\VariableRepositoryInterface;

class VariablesController extends Controller
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var VariableRepositoryInterface
     */
    private $repoVariable;

    /**
     * VariablesController constructor.
     * @param Request $request
     * @param VariableRepositoryInterface $repoVariable
     */
    public function __construct(
        Request $request,
        VariableRepositoryInterface $repoVariable
    ) {

        $this->request = $request;
        $this->repoVariable = $repoVariable;
    }

    public function index()
    {
        $list_type = 'index';

        if ($this->request->wantsJson()) {
            $query = $this->repoVariable->applyFiltersAndOrderQuery(
                Variable::query(), false, ['show' => 1], []);

            $variableDataTablesGenerator = new VariableDataTablesGenerator(
                $query,
                new VariableTransformer($list_type));

            return $variableDataTablesGenerator->get();
        }

        $buttonsGenerator = new VariableComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsIndex();

        $table_buttons = $buttonsGenerator->prepareButtonsIndex();

        return view('basics::Variables.index', compact('breadcrumbs', 'table_buttons', 'list_type'));
    }

    public function edit($id)
    {
        $variable = $this->repoVariable->findById($id);

        $field_title = $variable->present()->FieldName('title');

        if (!$variable->canEdit()) {
            return abort(403);
        }

        $buttonsGenerator = new VariableComponents();

        $breadcrumbs = $buttonsGenerator->prepareBreadcrumbsEdit($variable->present()->title);

        $table_buttons = $buttonsGenerator->prepareButtonsEdit();

        $form = $buttonsGenerator->prepareFormEdit($id);

        return view('basics::Variables.form',
            compact('variable', 'breadcrumbs', 'form', 'table_buttons', 'field_title'));

    }

    public function update($id)
    {
        $variable = $this->repoVariable->findById($id);

        if (!$variable->canEdit()) {
            return abort(403);
        }

        $validator = new VariableValidator();
        $validator->setId($id);
        if (!$validator->isValid('update')) {
            return back()->withInput()->withErrors($validator->getErrors());
        }

        $input = $this->request->only('value');

        $image = $this->request->file('value');

        $custom_file_name = '';

        if (!empty($image)) {
            $extension_error = false;

            switch ($variable->name) {
                case 'favicon':
                    if ($image->extension() === 'ico') {
                        $custom_file_name = 'favicon.ico';
                        $image->move(public_path('images'), $custom_file_name);
                    } else {
                        $extension_error = true;
                    }
                    break;

                case 'logo':
                    if ($image->extension() === 'png') {
                        $custom_file_name = 'logo.png';
                        $image->move(public_path('images'), $custom_file_name);
                    } else {
                        $extension_error = true;
                    }
                    break;

                case 'logo_small':
                    if ($image->extension() === 'png') {
                        $custom_file_name = 'logo_small.png';
                        $image->move(public_path('images'), $custom_file_name);
                    } else {
                        $extension_error = true;
                    }
                    break;
            }

            if ($extension_error) {
                return redirect()->back()->with('errorMessage', trans('basics::action.extension_error'));
            }

            $input['value'] = $custom_file_name;
            $input['updated_by'] = Auth::id();

        }

        $this->repoVariable->update($variable, $input);

        Cache::flush();

        return redirect()->route('variables.edit', $variable->id);
    }

}
