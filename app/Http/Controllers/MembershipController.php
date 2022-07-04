<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Models\Branch;
use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) return response(null, 404);
        $branch = Branch::where('id', $user->branch_id)->first();
        $companies = Company::where('user_id', $user->id)
            ->where('id', $branch->company_id)->get();
        $companyIds = [];
        foreach ($companies as $c) {
            array_push($companyIds, $c->id);
        }
        $memberships = Membership::whereIn('company_id', $companyIds)->paginate(10);

        $membershipRes = [];

        foreach ($memberships as $mem) {
            array_push($membershipRes, [
                'id' => $mem->id,
                'name' => $mem->name,
                'price' => $mem->price,
                'period' => $mem->period,
            ]);
        }
        return [
            'pagination' => [
                'total'        => $memberships->total(),
                'current_page' => $memberships->currentPage(),
                'per_page'     => $memberships->perPage(),
                'last_page'    => $memberships->lastPage(),
                'from'         => $memberships->firstItem(),
                'to'           => $memberships->lastItem(),
            ],
            'memberships' => $membershipRes
        ];
    }
    public function select(Request $request)
    {
        $user = Auth::user();
        if (!$user) return response(null, 404);
        $branch = Branch::where('id', $user->branch_id)->first();
        if (!$branch) return response('Branch not found, Maybe not selected', 404);
        $companies = Company::/* where('user_id', $user->id)
            -> */orWhere('id', $branch->company_id)->get();
        $companyIds = [];
        foreach ($companies as $c) {
            array_push($companyIds, $c->id);
        }
        $memberships = Membership::whereIn('company_id', $companyIds)->get();
        return $memberships;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMembershipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembershipRequest $request)
    {
        try {
            $newMembership = [];
            $branch = Branch::where('id', Auth::user()->branch_id)->first();
            if (!$branch) return response("Branch not found", 404);
            // $company =Company::Where()
            foreach ($request->all() as $key => $val) {
                $newMembership[$key] = $val;
            }
            if (!isset($newMembership['company_id'])) {
                $newMembership['company_id'] = $branch['company_id'];
            }
            Membership::create($newMembership);
            return response('Membership created', 201);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        return $membership;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMembershipRequest  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembershipRequest $request/* , Membership $membership */)
    {
        if (isset($request)) {
            $membership = Membership::where('id', $request->id)->first();
            foreach ($request->all() as $key => $val) {
                if ($membership->$key) {
                    $membership->$key = $val;
                }
            }
            $membership->save();
            return response()->json(200);
        }
        return 200;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $membership = Membership::where('id', $id)->first();
        $membership->delete();
        return 200;
    }
}
