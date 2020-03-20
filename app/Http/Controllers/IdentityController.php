<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdentityValidation;
use App\Models\Identity;
use Illuminate\Support\Facades\Gate;

class IdentityController extends Controller
{
    public function edit(Identity $identity)
    {
        $this->authorize('update', $identity);

        return view('identities.edit', compact('identity'));
    }

    public function update(IdentityValidation $request, Identity $identity)
    {
        $this->authorize('update', $identity);

        $input = $request->validated();

        $identity->update($input);

        return redirect("/users/$identity->user_id")
            ->with(['success' => 'User Info updated successfully.']);
    }
}
