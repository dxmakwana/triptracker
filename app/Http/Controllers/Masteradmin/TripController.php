<?php

namespace App\Http\Controllers\Masteradmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Trip;
use App\Models\TripType;
use App\Models\TripTravelingMember;
class TripController extends Controller
{
    //
    public function index(): View
    {
        $user = Auth::guard('masteradmins')->user();
        $trip = Trip::where(['tr_status' => 1, 'id' => $user->id])->get();
        return view('masteradmin.trip.index', compact('trip'));
    }

    public function create(): View
    {
        $triptype = TripType::all();
        return view('masteradmin.trip.create',compact('triptype'));

    }

    public function store(Request $request): RedirectResponse
    {
        //  dd($request->all());
        $user = Auth::guard('masteradmins')->user();
        $dynamicId = $user->id; 
        $validatedData = $request->validate([
            'tr_name' => 'required|string',
            'tr_agent_id' => 'required|string',
            'tr_traveler_name' => 'required|string',
            'tr_dob' => 'nullable|string',
            'tr_age' => 'nullable|string',
            'tr_email' => 'nullable|email', 
            'tr_phone' => 'nullable|string', 
            'tr_num_people' => 'nullable|string',
            'tr_number' => 'nullable|string',
            'tr_start_date' => 'required', 
            'tr_end_date' => 'nullable|string',
            'tr_value_trip' => 'nullable|string',
            'tr_desc' => 'nullable|string',
            'items.*.trtm_name' => 'nullable|string',
            'items.*.trtm_dob' => 'nullable|string',
            'items.*.trtm_age' => 'nullable|string',
        ], [
            'tr_name.required' => 'Traveler name is required',
            'tr_agent_id.required' => 'Agent ID is required',
            'tr_traveler_name.required' => 'Traveler name is required',
            'tr_email.email' => 'Invalid email address',
            'tr_start_date.required' => 'Start date is required',
        ]);

            // Store data
            $traveler = new Trip();
            $tableName = $traveler->getTable();
            $uniqueId = $this->GenerateUniqueRandomString($table = $tableName, $column = "tr_id", $chars = 6);
            $traveler->tr_id = $uniqueId;
            $traveler->id = $dynamicId;
            $traveler->tr_name = $validatedData['tr_name'];
            $traveler->tr_agent_id = $validatedData['tr_agent_id'];
            $traveler->tr_traveler_name = $validatedData['tr_traveler_name'];
            $traveler->tr_dob = $validatedData['tr_dob'];
            $traveler->tr_age = $validatedData['tr_age'];
            $traveler->tr_number = $validatedData['tr_number'];
            $traveler->tr_email = $validatedData['tr_email'];
            $traveler->tr_phone = $validatedData['tr_phone'];
            $traveler->tr_num_people = $validatedData['tr_num_people'];
            $traveler->tr_start_date = $validatedData['tr_start_date'];
            $traveler->tr_end_date = $validatedData['tr_end_date'];
            $traveler->tr_value_trip = $validatedData['tr_value_trip'];
            $traveler->tr_type_trip = json_encode($request->input('tr_type_trip'));
            $traveler->tr_desc = $validatedData['tr_desc'];
            $traveler->status = 'Trip Request';
            $traveler->tr_status = 1;
            $traveler->save();


            $rawItems = $request->input('items');
            $groupedItems = [];
            if (is_array($rawItems) && count($rawItems) > 0) {
            for ($i = 0; $i < count($rawItems); $i += 3) {
                $groupedItems[] = [
                    'trtm_name' => $rawItems[$i]['trtm_name'] ?? null,
                    'trtm_dob' => $rawItems[$i + 1]['trtm_dob'] ?? null,
                    'trtm_age' => $rawItems[$i + 2]['trtm_age'] ?? null,
                ];
            }
            }else{
                $groupedItems = [];
            }

            foreach ($groupedItems as $item) {
                $travelerItem = new TripTravelingMember();
                $tableName = $travelerItem->getTable();
                $uniqueId1 = $this->GenerateUniqueRandomString($table = $tableName, $column = "trtm_id", $chars = 6);
                
                $travelerItem->fill($item);

                $travelerItem->tr_id = $traveler->tr_id;
                $travelerItem->id = $dynamicId;
                $travelerItem->trtm_status = 1;
                $travelerItem->trtm_id = $uniqueId1;

                $travelerItem->save();
            }

    
        return redirect()->route('trip.index')
        ->with('success','Trip created successfully.');

    }

    public function edit($id)
    {
        // dd($id);
        $trip = Trip::where('tr_id', $id)->firstOrFail();
        $tripmember = TripTravelingMember::where('tr_id', $trip->tr_id)->get();
        // dd($tripmember);
        $triptype = TripType::all();
        return view('masteradmin.trip.edit',compact('trip','triptype', 'tripmember'));

    }

    public function update(Request $request, $id): RedirectResponse
    {

        // dd($request->all());
        $user = Auth::guard('masteradmins')->user();

        $trip = Trip::where(['tr_id' => $id])->firstOrFail();

        $request->validate([
            'tr_name' => 'required|string',
            'tr_agent_id' => 'required|string',
            'tr_traveler_name' => 'required|string',
            'tr_dob' => 'nullable|string',
            'tr_age' => 'nullable|string',
            'tr_email' => 'nullable|email', 
            'tr_phone' => 'nullable|string', 
            'tr_num_people' => 'nullable|string',
            'tr_number' => 'nullable|string',
            'tr_start_date' => 'required', 
            'tr_end_date' => 'nullable|string',
            'tr_value_trip' => 'nullable|string',
            'tr_desc' => 'nullable|string',
            'items.*.trtm_name' => 'nullable|string',
            'items.*.trtm_dob' => 'nullable|string',
            'items.*.trtm_age' => 'nullable|string',
        ], [
            'tr_name.required' => 'Traveler name is required',
            'tr_agent_id.required' => 'Agent ID is required',
            'tr_traveler_name.required' => 'Traveler name is required',
            'tr_email.email' => 'Invalid email address',
            'tr_start_date.required' => 'Start date is required',
        ]);

    
        $trip->update($request->all());

        TripTravelingMember::where('tr_id', $id)->delete();

            $rawItems = $request->input('items');
            $groupedItems = [];
            if (is_array($rawItems) && count($rawItems) > 0) {
            for ($i = 0; $i < count($rawItems); $i += 3) {
                $groupedItems[] = [
                    'trtm_name' => $rawItems[$i]['trtm_name'] ?? null,
                    'trtm_dob' => $rawItems[$i + 1]['trtm_dob'] ?? null,
                    'trtm_age' => $rawItems[$i + 2]['trtm_age'] ?? null,
                ];
            }
            }else{
                $groupedItems = [];
            }

            foreach ($groupedItems as $item) {
                $travelerItem = new TripTravelingMember();
                $tableName = $travelerItem->getTable();
                $uniqueId1 = $this->GenerateUniqueRandomString($table = $tableName, $column = "trtm_id", $chars = 6);
                
                $travelerItem->fill($item);

                $travelerItem->tr_id = $id;
                $travelerItem->id = $user->id;
                $travelerItem->trtm_status = 1;
                $travelerItem->trtm_id = $uniqueId1;

                $travelerItem->save();
            }

        return redirect()->route('trip.index')

                        ->with('success','Trip updated successfully');

    }

    public function destroy($id): RedirectResponse
    {
        // dd($id);

        $trip = Trip::where('tr_id', $id)->first();

        if ($trip) {
            $tripmember = TripTravelingMember::where('tr_id', $id)->delete();
            $trip->where('tr_id', $id)->delete();

            return redirect()->route('trip.index')

            ->with('success','Trip deleted successfully');

        }

    }

}