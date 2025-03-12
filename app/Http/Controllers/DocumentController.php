<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120'
        ]);

        $filePath = $request->file('file')->store('documents', 'public');

        Document::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filePath,
        ]);

        return redirect()->route('documents.index')->with('success', 'Tài liệu đã được upload thành công.');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);

        if (Storage::disk('public')->exists($document->file)) {
            return response()->download(storage_path('app/public/' . $document->file));
        }

        return redirect()->back()->with('error', 'File không tồn tại.');
    }

    /**
     * Hiển thị form chỉnh sửa tài liệu
     */
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.edit', compact('document'));
    }

    /**
     * Cập nhật tài liệu
     */
    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
        ]);

        if ($request->hasFile('file')) {
            // Xóa file cũ nếu có
            if (Storage::disk('public')->exists($document->file)) {
                Storage::disk('public')->delete($document->file);
            }

            // Lưu file mới
            $filePath = $request->file('file')->store('documents', 'public');
            $document->file = $filePath;
        }

        // Cập nhật dữ liệu
        $document->title = $request->title;
        $document->description = $request->description;
        $document->save();

        return redirect()->route('documents.index')->with('success', 'Tài liệu đã được cập nhật thành công.');
    }
}
