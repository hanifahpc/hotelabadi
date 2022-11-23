<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\FotoBuku;
use Illuminate\Support\Facades\Validator;
use File;
class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
   {
      $buku = Buku::all();
      return view('buku.index')->with('buku',$buku);
   }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
   {
        $kategori = Kategori::distinct('name')->get();
        return view('buku.create')->with('kategori',$kategori);
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
            'judul' => 'required|unique:buku',
            'deskripsi' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'harga'     => 'required|numeric',
             'stok'     => 'required|numeric',
             'status'   => 'required',
             'kategori' =>  'required',
             'foto.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
           ]);
      
       try{
          
               $buku = new Buku;
               $buku->judul = $request->judul;
               $buku->deskripsi= $request->deskripsi;
               $buku->penulis= $request->penulis;
               $buku->penerbit = $request->penerbit;
               $buku->harga = $request->harga;
               $buku->stok = $request->stok;
               $buku->status = $request->status;
               $buku->view = 0;
               $buku->kategori_id = $request->kategori;
               $buku->user_id = \Auth::user()->id;
               $buku->save();
               if($request->hasfile('foto'))
               {
                   foreach($request->file('foto') as $filegambar){
                       $fileasli = $filegambar->getClientOriginalName();
                       $uploadgambar =$filegambar-
>move(public_path().'/foto_buku/',$fileasli);
              
                       $foto= new FotoBuku;
                       $foto->buku_id = $buku->id;
                       $foto->foto = $fileasli;
                       $foto->save();
                   }
             }
       }
        catch(\Exception $e){
           return redirect()->back()->withErrors(['buku gagal disimpan'])-
>withInput();
       }
       return redirect('buku')->with('sukses','buku berhasil di simpan.');
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
        $kategori = Kategori::distinct('name')->get();
        $buku = Buku::find($id);
        return view('buku.edit')->with('buku',$buku)-
>withkategori($kategori);
   }
    /**
     * Update the specified resource in storage.
     *      *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
             'judul' => 'required|unique:buku,judul,'.$id,
             'deskripsi' => 'required',
             'penulis' => 'required',
             'penerbit' => 'required',
             'harga'     => 'required|numeric',
              'stok'     => 'required|numeric',
              'status'   => 'required',
              'kategori' =>  'required',
              'foto.*' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);
       
       try{
           
                $buku =  Buku::find($id);
                $buku->judul = $request->judul;
                $buku->deskripsi= $request->deskripsi;
                $buku->penulis= $request->penulis;
                $buku->penerbit = $request->penerbit;
                $buku->harga = $request->harga;
                $buku->stok = $request->stok;
                $buku->status = $request->status;
                $buku->view = 0;
                $buku->kategori_id = $request->kategori;
                $buku->save();
                if($request->hasfile('foto'))
                {
                    foreach($request->file('foto') as $filegambar){
                        $fileasli = $filegambar->getClientOriginalName();
                        $uploadgambar =$filegambar-
 >move(public_path().'/foto_buku/',$fileasli);
               
                        $foto= new FotoBuku;
                        $foto->buku_id = $buku->id;
                        $foto->foto = $fileasli;
                        $foto->save();
                    }
              }
        }
         catch(\Exception $e){
            return redirect()->back()->withErrors(['buku gagal diperbarui'])-
 >withInput();
        }
        return redirect('buku')->with('sukses','buku berhasil diperbarui.');
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
               $buku= Buku::findOrFail($id);
               $buku->delete();
          }
           catch(\Exception $e ){
               return redirect()->back()->withErrors(['Buku gagal dihapus']);
          }
            return redirect()->back()->with('sukses','Buku berhasil dihapus');
      }
       public function hapus($id)
      {
           try{
               $foto = FotoBuku::findOrFail($id);
                 File::delete(asset('foto_buku/'.$foto->foto));
               $foto->delete();
          }
           catch(\Exception $e ){
               return redirect()->back()->withErrors(['Foto gagal dihapus']);
          }
            return redirect()->back()->with('sukses','Foto Berhasil dihapus');
      }
   }
   