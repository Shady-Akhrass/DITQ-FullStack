<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompetitionApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|in:ذكر,أنثى',
            'mobile_number' => 'required|string|max:20',
            'whatsapp_number' => 'required|string|max:20',
            'governorate' => 'required|string',
            'address' => 'required|string',
            'memorizer_name' => 'required|string|max:255',
            'participation_field' => 'required|string',
            'video_path' => 'nullable|string|required_without:video_link',
            'video_link' => 'nullable|url|max:255|required_without:video_path'
        ], [
            'student_name.required' => 'الاسم الرباعي مطلوب.',
            'student_name.max' => 'الاسم الرباعي يجب ألا يتجاوز 255 حرفاً.',
            'age.required' => 'حساب العمر فشل، يرجى إدخال تاريخ الميلاد.',
            'gender.required' => 'يرجى تحديد الجنس.',
            'mobile_number.required' => 'رقم الجوال مطلوب.',
            'whatsapp_number.required' => 'رقم الواتساب مطلوب.',
            'governorate.required' => 'يرجى تحديد المحافظة.',
            'address.required' => 'العنوان الحالي مطلوب.',
            'memorizer_name.required' => 'اسم المحفظ مطلوب.',
            'participation_field.required' => 'يرجى اختيار مجال المشاركة.',
            'video_path.required_without' => 'يجب رفع فيديو للمشاركة أو إرفاق رابط خارجي له.',
            'video_link.required_without' => 'يجب إرفاق رابط فيديو أو رفعه كملف.',
            'video_link.url' => 'رابط الفيديو غير صالح.',
        ]);

        // Add custom validation for female age
        if ($validatedData['gender'] === 'أنثى' && $validatedData['age'] >= 11) {
            return response()->json([
                'message' => 'عذراً، يجب أن يكون عمر الإناث أقل من 11 سنة للمشاركة في المسابقة.',
                'errors' => ['age' => ['يجب أن يكون عمر الإناث أقل من 11 سنة.']]
            ], 422);
        }

        // Add custom validation for Poetry (female only)
        if ($validatedData['participation_field'] === 'الشعر' && $validatedData['gender'] !== 'أنثى') {
            return response()->json([
                'message' => 'عذراً، مجال الشعر مخصص للأناث فقط.',
                'errors' => ['participation_field' => ['مجال الشعر مخصص للأناث فقط.']]
            ], 422);
        }

        $application = \App\Models\CompetitionApplication::create($validatedData);

        return response()->json(['message' => 'تم استلام المشاركة بنجاح', 'data' => $application], 201);
    }

    public function uploadVideoChunk(Request $request)
    {
        // Log incoming request to debug 422
        Log::info('Chunk Upload Request:', $request->except('file'));

        try {
            $request->validate([
                'file' => 'required|file',
                'uuid' => 'required|string',
                'chunkIndex' => 'required|integer',
                'totalChunks' => 'required|integer',
                'fileName' => 'required|string'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Chunk Validation Errors:', $e->errors());
            throw $e;
        }

        $file = $request->file('file');
        $uuid = $request->input('uuid');
        $chunkIndex = $request->input('chunkIndex');
        $totalChunks = $request->input('totalChunks');
        $fileName = $request->input('fileName');

        $tempDir = storage_path('app/public/temp_chunks/' . $uuid);
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $file->move($tempDir, $chunkIndex . '.part');

        // Check if all chunks are uploaded
        $uploadedChunks = count(glob($tempDir . '/*.part'));
        if ($uploadedChunks == $totalChunks) {
            // Combine chunks using the same method as NewsController
            $fileNamePattern = date("Y-M-d H-i", time()) . " - " . rand(00000, 9999) . " - " . $fileName;
            $url = 'competition_videos\\' . $fileNamePattern;
            $finalFile = public_path('storage/competition_videos/' . $fileNamePattern);

            if (!file_exists(public_path('storage/competition_videos'))) {
                mkdir(public_path('storage/competition_videos'), 0777, true);
            }

            $out = fopen($finalFile, 'wb');
            for ($i = 0; $i < $totalChunks; $i++) {
                $in = fopen($tempDir . '/' . $i . '.part', 'rb');
                while ($buff = fread($in, 4096)) {
                    fwrite($out, $buff);
                }
                fclose($in);
                unlink($tempDir . '/' . $i . '.part'); // Delete chunk
            }
            fclose($out);
            rmdir($tempDir); // Remove temp directory

            return response()->json(['path' => $url, 'status' => 'completed']);
        }

        return response()->json(['status' => 'chunk_uploaded', 'progress' => round(($uploadedChunks / $totalChunks) * 100)]);
    }
    public function index()
    {
        $applications = \App\Models\CompetitionApplication::latest()->get();
        $applications->each(function ($app) {
            if ($app->video_path) {
                $app->video_path = str_replace('\\', '/', $app->video_path);
            }
        });
        return response()->json($applications);
    }

    public function destroy($id)
    {
        $application = \App\Models\CompetitionApplication::findOrFail($id);

        // Delete video if exists locally
        if ($application->video_path) {
            $path = public_path('storage/' . $application->video_path);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $application->delete();
        return response()->json(['message' => 'تم حذف المشاركة بنجاح']);
    }
}
