<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Exception;

class UserController extends Controller
{
    public function profile()
    {
        return view('users.index');
    }


    public function index(Request $request)
    {
        try {
            $buscar = $request->buscar;
            $criterio = $request->criterio;
            $users = User::when($criterio && $buscar, function ($q) use ($criterio, $buscar) {
                if ($criterio === 'name' || $criterio === 'last_name' && $buscar != null) {
                    $q->where($criterio, 'LIKE', "%$buscar%");
                }
            })
                ->join('branches', function ($j) use ($criterio, $buscar) {
                    $j->on('branches.id', 'users.branch_id')
                        ->when($criterio && $buscar, function ($q) use ($criterio, $buscar) {
                            if ($criterio === 'branch'  && $buscar != null) {
                                $q->where('division', 'LIKE', "%$buscar%")
                                    ->orWhere('location', 'LIKE', "%$buscar%");
                            }
                        });
                })
                ->select(
                    // "users.avatar",
                    "users.id",
                    "users.user_name",
                    "users.email",
                    "users.name",
                    "users.last_name",
                    // "branches.id",
                    "branches.division as branch"
                )
                ->paginate();

            return [
                'pagination' => [
                    'total'        => $users->total(),
                    'current_page' => $users->currentPage(),
                    'per_page'     => $users->perPage(),
                    'last_page'    => $users->lastPage(),
                    'from'         => $users->firstItem(),
                    'to'           => $users->lastItem(),
                ],
                'users' => $users
            ];
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
    }

    public function account()
    {
        $user = Auth::user();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $user = User::Where('id', Auth::user()->id)->firstOrFail();
            if ($request->name) {
                $user->name = $request->name;
            }
            if ($request->last_name) {
                $user->last_name = $request->last_name;
            }
            if ($request->branch) {
                $user->branch_id = $request->branch;
            }
            $user->save();
            return 200;
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['UserController' => 'update']);
        }
    }



    public function newPassword(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        if ($request->new_password !== $request->confirm_password) {
            return 403;
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return 200;
    }

    public function getThemme()
    {
        $user = Auth::user();
        return $user->themme_layout;
        if ($user) {
        }
    }
    public function setThemme(Request $request)
    {
        $newTheme = $request->themme_layout;
        $user = User::where('id', Auth::user()->id)->firstOrFail();

        if ($user) {
            $user->themme_layout = $newTheme;
            $user->save();
        }
    }

    public function changeThemme(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $newTheme = $request->themme_layout;
        if ($user) {
            $newTheme = $user->themme_layout;
            $user->themme_layout = $newTheme;
            $user->save();
        }
    }

    public function newUser(Request $request)
    {
        try {
            // return $request;
            $newUser = [];
            foreach ($request->all() as $key => $val) {
                if ($key === 'password') {
                    $newUser[$key] = Hash::make($val);
                } else {
                    $newUser[$key] = $val;
                }
            }
            User::create($newUser);
            return response()->json('User created', 201);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__);
        }
    }

    public function updateUser(Request $request, User $user)
    {
        try {
            if (isset($request)) {
                foreach ($request->all() as $key => $val) {
                    if ($user->$key) {
                        $newRole[$key] = $val;
                        // $this->newUpdate('users', $user->id, $key, $user[$key], $val, Auth::user()->id);
                    }
                }
                $user->save();
                return response()->json('User updated', 200);
            }
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
    }
    public function destroy($user)
    {
        try {
            $user = User::where('id', $user)->first();
            if (!$user) return response('user not found', 404);
            $user->delete();
            return response('user deleted', 200);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
    }
}
