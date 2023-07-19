<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionCategory;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =[
            'title' => "Manajemen Pertanyaan Umum",
            'questions' => Question::get(),
            'content' => "admin/question/index"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data =[
            'title' => "Tambah Pertanyaan Umum",
            'content' => "admin/question/add"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'index' => 'numeric',
            'is_published' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        Question::create($data);
        Alert::success('Sukses', 'Data berhasil ditambah.');

        return redirect("/admin/web/question");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =[
            'title' => "Ubah Pertanyaan Umum",
            'question' => Question::find($id),
            'content' => "admin/question/add"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        $data = $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'index' => 'numeric',
            'is_published' => 'required',
        ]);
        $data['user_id'] = auth()->user()->id;

        $question->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/admin/web/question");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $question = Question::find($id);

            $question->delete();
            Alert::success('Sukses', 'Data berhasil dihapus.');
        } catch(\Throwable $e) {
            Alert::error('Error', $e->getMessage());
        } finally {
            return redirect("/admin/web/question");
        }
    }
}
