<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactUsController extends Controller
{
    public function create(Request $request): View
    {
        return view('contact-us.create');
    }

    public function store(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if ($request->isMethod('post')) {

            $request->validate((new StoreMessageRequest())->rules());

            /** @var Message $message */
            $message = Message::create($request->all());
            $message->save();
        }

        return view('contact-us.success');
    }
}
