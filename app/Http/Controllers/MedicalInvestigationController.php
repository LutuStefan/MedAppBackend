<?php

namespace App\Http\Controllers;

use App\Models\MedicalInvestigation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicalInvestigationController extends Controller
{
    public function __construct()
    {
    }

    public function getMedicalInvestigation(Request $request, $id): JsonResponse
    {
        $medicalInvestigation = MedicalInvestigation::with('user')->where('id', $id)->first();

        return response()->json([
            'medicalInvestigationInformation' => $medicalInvestigation
        ]);
    }

    public function saveInterpretation(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'id' => 'required|integer',
            'interpretation' => 'required|string'
        ]);

        $medicalInvestigation = MedicalInvestigation::where('id', $fields['id'])->first();
        if ($medicalInvestigation instanceof MedicalInvestigation === false) {
            return new JsonResponse('Medical investigation not found!', 404);
        }
        $medicalInvestigation->interpretation = $fields['interpretation'];
        $medicalInvestigation->save();

        return new JsonResponse('Interpretation saved successfully!', 200);
    }

    public function getUserMedicalHistory()
    {
        $user = auth()->user();
        return $user->medicalInvestigations()->select('id', 'type', 'date')
            ->get();
    }

    public function getMedicalInvestigations(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'type' => 'array',
            'date' => 'date',
            'user' => 'array'
        ]);


        $medicalInvestigationsQuery = MedicalInvestigation::with('user:id,firstname,lastname')->select('id', 'type', 'date', 'user_id');

        if (isset($fields['user'])) {
            $medicalInvestigationsQuery->where('user_id', $fields['user']['key']);
        }
        if (isset($fields['type'])) {
            $medicalInvestigationsQuery->whereIn('type', $fields['type']);
        }
        if (isset($fields['date'])) {
            $medicalInvestigationsQuery->whereDate('date', Carbon::parse($fields['date'])->format('Y-m-d'));
        }

        $medicalInvestigations = $medicalInvestigationsQuery->get()->map(function($investigation) {
            $investigation->username = $investigation->user->firstname . ' ' . $investigation->user->lastname;
            return $investigation;
        });

        return response()->json($medicalInvestigations);
    }

    public function getMedicalInvestigationsTypes(): array
    {
        return array_map(function($item) {
            $item['code'] = $item['type'];
            return $item;
        }, MedicalInvestigation::select('type')->distinct()->get()->toArray());
    }

    public function saveMedicalInvestigation(Request $request)
    {
        $input = $request->validate([
            'user' => 'required|json',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'symptoms' => 'required|json'
        ]);

        try {
            $avatarPath = $input['image']->store('investigationImages', 'public');
            $patientId = json_decode($input['user'], true)['key'];

            $medicalInvestigation = new MedicalInvestigation();
            $medicalInvestigation->user_id = $patientId;
            $medicalInvestigation->doctor_id = auth()->user()->id;
            $medicalInvestigation->type = 'X-ray';
            $medicalInvestigation->date = Carbon::now();
            $medicalInvestigation->interpretation = '';
            $medicalInvestigation->information = json_encode([
                'symptoms' => json_decode($input['symptoms']),
                'image' => $avatarPath
            ]);
            $medicalInvestigation->save();
        } catch (\Exception $e) {
            return new JsonResponse('An error occurred while saving the medical investigation!', 500);
        }
    }

    public function getBloodInvestigationOptions(): JsonResponse
    {
        return response()->json([
            ['id' => 1, 'name' => 'Hemoglobin', 'normalRange' => '12-16', 'unit' => 'g/dL'],
            ['id' => 2, 'name' => 'Hematocrit', 'normalRange' => '36-46', 'unit' => '%'],
            ['id' => 3, 'name' => 'White blood cell count', 'normalRange' => '4.5-11', 'unit' => 'x10^3/uL'],
            ['id' => 4, 'name' => 'Platelet count', 'normalRange' => '150-450', 'unit' => 'x10^3/uL'],
            ['id' => 5, 'name' => 'Red blood cell count', 'normalRange' => '4.5-6', 'unit' => 'x10^6/uL'],
            ['id' => 6, 'name' => 'Mean corpuscular volume', 'normalRange' => '80-100', 'unit' => 'fL'],
            ['id' => 7, 'name' => 'Mean corpuscular hemoglobin', 'normalRange' => '27-31', 'unit' => 'pg'],
            ['id' => 8, 'name' => 'Mean corpuscular hemoglobin concentration', 'normalRange' => '32-36', 'unit' => 'g/dL'],
            ['id' => 9, 'name' => 'Red cell distribution width', 'normalRange' => '11.5-14.5', 'unit' => '%'],
            ['id' => 10, 'name' => 'Neutrophils', 'normalRange' => '40-70', 'unit' => '%'],
            ['id' => 11, 'name' => 'Lymphocytes', 'normalRange' => '20-40', 'unit' => '%'],
            ['id' => 12, 'name' => 'Monocytes', 'normalRange' => '2-8', 'unit' => '%'],
            ['id' => 13, 'name' => 'Eosinophils', 'normalRange' => '1-4', 'unit' => '%'],
            ['id' => 14, 'name' => 'Basophils', 'normalRange' => '0-1', 'unit' => '%'],
            ['id' => 15, 'name' => 'Neutrophils', 'normalRange' => '1.8-7.7', 'unit' => 'x10^3/uL'],
            ['id' => 16, 'name' => 'Lymphocytes', 'normalRange' => '1-3', 'unit' => 'x10^3/uL'],
            ['id' => 17, 'name' => 'Monocytes', 'normalRange' => '0.2-1', 'unit' => 'x10^3/uL'],
            ['id' => 18, 'name' => 'Eosinophils', 'normalRange' => '0.1-0.4', 'unit' => 'x10^3/uL'],
            ['id' => 19, 'name' => 'Basophils', 'normalRange' => '0-0.2', 'unit' => 'x10^3/uL'],
        ]);
    }

    public function saveBloodInvestigation(Request $request): JsonResponse
    {
        $input = $request->validate([
            'user' => 'required|json',
            'results' => 'required|json'
        ]);

        try {
            $patientId = json_decode($input['user'], true)['key'];

            $medicalInvestigation = new MedicalInvestigation();
            $medicalInvestigation->user_id = $patientId;
            $medicalInvestigation->doctor_id = auth()->user()->id;
            $medicalInvestigation->type = 'Complete Blood Count';
            $medicalInvestigation->date = Carbon::now();
            $medicalInvestigation->interpretation = '';
            $medicalInvestigation->information = json_encode([
                'results' => json_decode($input['results'])
            ]);
            $medicalInvestigation->save();
        } catch (\Exception $e) {
            return new JsonResponse('An error occurred while saving the blood investigation!', 500);
        }

        return new JsonResponse('Blood investigation saved successfully!', 200);
    }
}
