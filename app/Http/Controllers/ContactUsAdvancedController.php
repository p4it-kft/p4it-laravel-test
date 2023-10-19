<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageFormRequest;
use App\Models\MessageForm;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application as ContractsApplicationAlias;
use Illuminate\Contracts\View\Factory as ContractsFactoryAlias;
use Illuminate\Contracts\View\View as ContractsViewAlias;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ContactUsAdvancedController extends Controller
{
    public function create(): View
    {
        $messageForm = new MessageForm();
        return $this->getFormTemplate($messageForm);
    }

    public function update($id): View
    {
        $messageForm = MessageForm::whereKey($id)->get()->first();
        return $this->getFormTemplate($messageForm);
    }

    public function store(Request $request, $id = null): ContractsApplicationAlias|ContractsFactoryAlias|ContractsViewAlias|Application|RedirectResponse
    {
        if ($request->isMethod('post')) {

            $request->validate((new StoreMessageFormRequest())->rules());

            if ($id) {
                /** @var MessageForm $messageForm */
                $messageForm = MessageForm::whereKey($id)->first();
                $messageId = $messageForm->updateAll($request);
            } else {
                $messageForm = new MessageForm($request->all());
                $messageId = $messageForm->insertAll();
            }

            Session::flash('message', 'Message and its related fields are successfully saved!');
            return redirect()->action([self::class, 'update'], ['id' => $messageId]);
        }

        return view('contact-us.success');
    }

    public function list(Request $request): View
    {
        $messageForms = MessageForm::all();

        return view('contact-us.list-advanced', compact('messageForms'));
    }

    private function getFormTemplate(MessageForm $messageForm): ContractsViewAlias|Application|ContractsFactoryAlias|ContractsApplicationAlias
    {
        $messageForm->refresh();

        $tags = Tag::getAllLabelsById();

        return view('contact-us.form-advanced', compact('messageForm', 'tags'));
    }

}
