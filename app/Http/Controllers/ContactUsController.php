<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Contracts\Foundation\Application as ContractsApplicationAlias;
use Illuminate\Contracts\View\Factory as ContractsFactoryAlias;
use Illuminate\Contracts\View\View as ContractsViewAlias;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactUsController extends Controller
{
    public function create(): View
    {
        return view('contact-us.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if ($request->isMethod('post')) {

            $request->validate((new StoreMessageRequest())->rules());

            /** @var Message $message */
            $message = Message::create($request->all());
            $message->save();

            return redirect()->action([self::class, 'success']);
        }

        return redirect()->action([self::class, 'create']);
    }

    public function success(): ContractsViewAlias|Application|ContractsFactoryAlias|ContractsApplicationAlias
    {
        return view('contact-us.success');
    }

}
