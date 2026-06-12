<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:book-list|book-create|book-edit|book-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:book-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:book-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:book-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Book::query()->orderBy('sort_order')->orderBy('id');

            if ($request['search'] != '') {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%'.$request['search'].'%')
                        ->orWhere('category', 'like', '%'.$request['search'].'%');
                });
            }

            if ($request['status'] != 'All') {
                $status = $request['status'] == 2 ? 0 : $request['status'];
                $query->where('status', $status);
            }

            $models = $query->paginate(10);

            return (string) view('admin.books.search', compact('models'));
        }

        $totalBooks = Book::count();
        $activeBooks = Book::where('status', 1)->count();
        $inactiveBooks = Book::where('status', 0)->count();
        $models = Book::orderBy('sort_order')->orderBy('id')->paginate(10);
        $page_title = 'All Books';

        return view('admin.books.index', compact('models', 'page_title', 'totalBooks', 'activeBooks', 'inactiveBooks'));
    }

    public function create()
    {
        $page_title = 'Add Book';

        return view('admin.books.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'price' => 'required|numeric|min:0',
            'cover' => 'nullable|image|max:5120',
            'file' => 'nullable|file|mimes:pdf,epub|max:51200',
        ]);

        $model = new Book();
        $this->fillBook($model, $request);
        $model->slug = Book::uniqueSlug($request->title);
        $model->save();

        return redirect()->route('book.index')->with('message', 'Book added successfully.');
    }

    public function edit($id)
    {
        $page_title = 'Edit Book';
        $model = Book::findOrFail($id);

        return view('admin.books.edit', compact('model', 'page_title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:200',
            'price' => 'required|numeric|min:0',
            'cover' => 'nullable|image|max:5120',
            'file' => 'nullable|file|mimes:pdf,epub|max:51200',
        ]);

        $model = Book::findOrFail($id);
        $this->fillBook($model, $request, true);
        $model->save();

        return redirect()->route('book.index')->with('message', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        $model = Book::find($id);

        if (! $model) {
            return response()->json(['message' => 'Failed'], 404);
        }

        if ($model->cover) {
            $coverPath = public_path('assets/website/images/'.$model->cover);
            if (File::exists($coverPath)) {
                File::delete($coverPath);
            }
        }

        if ($model->file_path) {
            $filePath = storage_path('app/books/'.$model->file_path);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $model->delete();

        return true;
    }

    private function fillBook(Book $model, Request $request, bool $isUpdate = false): void
    {
        $model->title = $request->title;
        $model->subtitle = $request->subtitle;
        $model->category = $request->category;
        $model->year = $request->year;
        $model->description = $request->description;
        $model->excerpt = $request->excerpt ?: $request->description;
        $model->price = $request->price;
        $model->sort_order = (int) ($request->sort_order ?? 0);
        $model->featured = in_array((string) $request->input('featured'), ['0', '1'], true) ? (bool) $request->input('featured') : false;
        $model->status = in_array((string) $request->input('status'), ['0', '1'], true) ? (bool) $request->input('status') : true;

        if ($request->hasFile('cover')) {
            $coverDir = public_path('assets/website/images');
            if (! File::isDirectory($coverDir)) {
                File::makeDirectory($coverDir, 0755, true);
            }

            if ($isUpdate && $model->cover) {
                $oldCover = $coverDir.DIRECTORY_SEPARATOR.$model->cover;
                if (File::exists($oldCover)) {
                    File::delete($oldCover);
                }
            }

            $coverName = 'book-'.Str::slug($request->title).'-'.time().'.'.$request->file('cover')->getClientOriginalExtension();
            $request->file('cover')->move($coverDir, $coverName);
            $model->cover = $coverName;
        }

        if ($request->hasFile('file')) {
            $bookDir = storage_path('app/books');
            if (! File::isDirectory($bookDir)) {
                File::makeDirectory($bookDir, 0755, true);
            }

            if ($isUpdate && $model->file_path) {
                $oldFile = $bookDir.DIRECTORY_SEPARATOR.$model->file_path;
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $extension = strtolower($request->file('file')->getClientOriginalExtension());
            $fileName = date('YmdHis').'_'.Str::slug($request->title).'.'.$extension;
            $request->file('file')->move($bookDir, $fileName);
            $model->file_path = $fileName;
            $model->file_type = $extension === 'epub' ? 'epub' : 'pdf';
        }
    }
}
