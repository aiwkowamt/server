<?php

namespace App\Http\Controllers;

use App\Enums\RoleName;
use App\Models\Declaration;
use App\Enums\DeclarationStatus;
use Illuminate\Http\Request;

class DeclarationController extends Controller
{
    public function index()
    {
        $declarations = Declaration::all();

        return view('declarations.index', ['declarations' => $declarations]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Declaration $declaration)
    {
        $status = DeclarationStatus::cases();
        return view('declarations.edit', ['declaration' => $declaration, 'status' => $status]);
    }

    public function update(Request $request, Declaration $declaration)
    {
        $declaration->update([
            'status' => $request->input('status'),
        ]);

        $currentStatus = $declaration->status;
        if ($currentStatus->value === 'completed') {
            $user = $declaration->user;
            $user->update([
                'role_id' => RoleName::getId(RoleName::STORE),
            ]);
        }

        return redirect()->route('declarations.index');
    }

    public function destroy(string $id)
    {
        //
    }
}
