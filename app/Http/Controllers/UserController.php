<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $users = User::paginate(6);
        return view('users.index', compact(['users',]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:1', 'max:255', 'string',],
//            'given_name' => ['required', 'min:1', 'max:255', 'string',],
//            'family_name' => ['sometimes', 'nullable', 'max:255', 'string',],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class,],
            'password' => ['required', 'confirmed', 'min:4', 'max:255', Rules\Password::defaults(),],
        ]);

        $validated['id'] = auth()->id();
        $user = User::create($validated);

        return redirect(route('users.index'))
            ->with('success', 'User created');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::whereId($id)->get()->first();
        if (!$user || (!Auth::user()->can('user read') && $user->id != Auth::id() && !Auth::user()->hasRole('superuser'))) {
            abort(403, 'You do not have permission to show this user details');
        }

        return view('users.show', compact(['user',]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::whereId($id)->get()->first();
        if (!$user || (!Auth::user()->can('user edit') && $user->id != Auth::id() && !Auth::user()->hasRole('superuser'))) {
            abort(403, 'You do not have permission to edit this user');
        }
        return view('users.update', compact(['user',]));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!$request->password) {
            unset($request['password'], $request['password_confirmation']);
        }

        $validated = $request->validate([
            'name' => ['required', 'min:1', 'max:255', 'string',],
//            'given_name' => ['required', 'min:1', 'max:255', 'string',],
//            'family_name' => ['sometimes', 'nullable', 'min:1', 'max:255', 'string',],
            'email' => ['required', 'min:5', 'max:255', 'email', Rule::unique(User::class)->ignore($id),],
            'password' => ['sometimes', 'required', 'min:4', 'max:255', 'string', 'confirmed',],
            'password_confirmation' => ['sometimes', 'required_with:password', 'min:4', 'max:255', 'string',],
        ]);

        $user = User::where('id', '=', $id)->get()->first();

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect(route('users.show', compact(['user'])))
            ->with('success', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', '=', $id)->get()->first();
        if (!$user || (!Auth::user()->can('user delete') && $user->id != Auth::id() && !Auth::user()->hasRole('superuser'))) {
            abort(403, 'You do not have permission to delete this user');
        }

        if (auth()->user()->id !== $user->id) {

            $user->delete();

            return redirect(route('users.index'))
                ->with('success', 'User deleted');

        }

        return back()
            ->with('error', 'Cannot delete yourself');
    }

    /**
     * Show the form for editing a user's permissions.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function editPermissions(User $user)
    {
        // Get all the permissions
        $permissions = Permission::all();

        // return all the permission and the user instance
        return view('users.permissions', compact(['user', 'permissions']));

    }

    /**
     * Update a user's permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePermissions(Request $request, User $user) {
        $validateData = $request->validate(['permissions' => 'array']);

        if (Auth::user()->hasRole('superuser')){
            $user->syncPermissions($validateData['permissions']);
            return redirect()->route('users.index')->with('success', 'User permission updated successfully');
        }

        return redirect()->to('/')->with("error", "You dont have the role to Update the User Permissions");
    }



    /**
     * Restore a soft-deleted user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id) {
        $user = User::onlyTrashed()->findOrFail($id);

        if ($user->trashed()) {
            $user->restore();
            return redirect()->route('users.index')->with('success', 'User restored successfully');
        }

        return redirect()->route('jokes.trash')->with('error', 'Joke is not in the trash');
    }

    /**
     * Permanently delete a user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id) {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
//        if ((!Auth::user()->can('user force delete') && $user->id != Auth::id() && !Auth::user()->hasRole('superuser'))) {
//            abort(403, 'You do not have permission to force delete this user');
//        }

        return redirect()->route('users.trash')->with('success', 'User deleted successfully');
    }

    /**
     * Display a list of soft-deleted users.
     *
     * @return \Illuminate\View\View
     */
    public function trash() {

        $users = User::onlyTrashed()->paginate(5);

        return view('users.trash', compact('users'));
    }
}
