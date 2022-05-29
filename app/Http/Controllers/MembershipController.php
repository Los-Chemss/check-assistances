<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Models\Branch;
use App\Models\Company;
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

        return [
            'pagination' => [
                'total'        => $memberships->total(),
                'current_page' => $memberships->currentPage(),
                'per_page'     => $memberships->perPage(),
                'last_page'    => $memberships->lastPage(),
                'from'         => $memberships->firstItem(),
                'to'           => $memberships->lastItem(),
            ],
            'memberships' => $memberships
        ];
    }
    public function select(Request $request)
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
    public function store(Request $request)
    {
        return Membership::create($request->all());
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
    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        $membership->update($request->all());
        return $membership;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        return $membership->delete();
    }
}
