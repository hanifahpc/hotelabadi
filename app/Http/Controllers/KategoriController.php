<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
   {
        $kategori = Kategori::all();
        return view('kategori.index')->with('kategori',$kategori);
   }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
   {
        return view('kategori.create');
   }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
   {
        $request->validate([
            'name' => ['required','string','unique:kategori'],
           ]);
  
          try{
               $kategori= new Kategori;
               $kategori->name = $request->name;
               $kategori->save();
         }
           catch(\Exception $e ){
               return redirect()->back()->with(['errors','kategori gagal
disimpan']);
           }
           return redirect('kategori')->with('sukses','kategori berhasil
disimpan');
   }
    /**
        * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
   {
        //
   }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
   {
        $kategori = Kategori::find($id);
        return view('kategori.edit')->with('kategori',$kategori);
   }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
   {
        $request->validate([
            'name' => ['required','string','unique:kategori,name,'.$id],
           ]);
  
          try{
               $kategori= Kategori::find($id);
               $kategori->name = $request->name;
               $kategori->save();
         }
           catch(\Exception $e ){
               return redirect()->back()->with(['errors','kategori gagal
disimpan']);
           }
           return redirect('kategori')->with('sukses','kategori berhasil
disimpan');
   }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
   {
        try{
            $kategori = Kategori::find($id);
            $kategori->delete();
         }
         catch(\Exception $e ){
            return redirect()->back()->with('errors','Kategori gagal
dihapus');
       }
        return redirect('kategori')->with('sukses','Kategori berhasil
dihapus');
 }
}