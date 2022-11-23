<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Halaman Edit User') }}
       </h2>
   </x-slot>
   <div class="py-8">
        
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               @if (session('sukses'))
                   <div class="flex flex-col p-2 bg-green-500 shadow-md mb-2
text-xl font-bold">
                       {{ session('sukses')}}
                   </div>
               @endif
               @if (session('errors'))
                   <div class="flex flex-col p-2 bg-red-500 shadow-md mb-2
text-xl font-bold">
                       {{session('errors')}}
                       </div>
               @endif
               <div class="p-6 bg-white border-b border-gray-200">
                  
                   <form method="POST" action="{{ route('buku.update',$buku-
>id) }}" enctype="multipart/form-data">
                       @csrf
                       @method('PUT')
                       <!-- judul -->
                       <div class="mt-4">
                           <x-input-label for="judul" :value="__('Judul
Buku')" />
                           <x-text-input id="judul" class="block mt-1 wfull" type="text" name="judul" :value="$buku->judul" required autofocus />
                           <x-input-error :messages="$errors->get('judul')"
class="mt-2" />
                       </div>
    
                       <!-- deskripsi -->
                       <div class="mt-4">
                           <x-input-label for="deskripsi"
:value="__('Deskripsi Buku')" />
                           <x-text-area id="deskripsi" class="block mt-1 wfull" name="deskripsi" required autofocus >{{$buku->deskripsi}}</x-textarea>
                           <x-input-error :messages="$errors-
>get('deskripsi')" class="mt-2" />
                       </div>
    
                       <!-- penulis-->
                       <div class="mt-4">
                           <x-input-label for="penulis"
:value="__('Penulis')" />
                           <x-text-input id="penulis" class="block mt-1 wfull" type="text" name="penulis" :value="$buku->penulis" required autofocus
/>
<x-input-error :messages="$errors-
>get('penulis')" class="mt-2" />
                       </div>           
                       <!-- penerbit-->
                       <div class="mt-4">
                           <x-input-label for="penerbit"
:value="__('Penerbit')" />
                           <x-text-input id="penerbit" class="block mt-1 wfull" type="text" name="penerbit" :value="$buku->penerbit" required autofocus
/>
                           <x-input-error :messages="$errors-
>get('penerbit')" class="mt-2" />
                       </div>
                       <!-- harga-->
                       <div class="mt-4">
                           <x-input-label for="harga" :value="__('Harga')"
/>
                           <x-text-input id="harga" class="block mt-1 wfull" type="number" name="harga" :value="$buku->harga" required autofocus />
                           <x-input-error :messages="$errors->get('harga')"
class="mt-2" />
                       </div>
                       <!-- stok-->
                       <div class="mt-4">
                           <x-input-label for="stok" :value="__('Stok')" />
                           <x-text-input id="stok" class="block mt-1 w-full"
type="number" name="stok" :value="$buku->stok" required autofocus />  
                           <x-input-error :messages="$errors->get('stok')"
class="mt-2" />
                       </div>
                        
    
                       <div class="mt-4">
                           <x-input-label for="kategori"
:value="__('Kategori')" />
                           <select class=" block mt-1 w-full rounded-md
shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ringindigo-200 focus:ring-opacity-50'" name="kategori">
                               <option value="{{$buku->kategori_id}}">
{{$buku->kategori->name}}</option>
                               @foreach($kategori as $kategori)
                               <option value="{{$kategori->id}}">
{{$kategori->name}}</option>
                               @endforeach
                           </select>
                           <x-input-error :messages="$errors-
>get('kategori')" class="mt-2" />
                       </div>
    
                       <div class="mt-4">
                           <x-input-label for="status" :value="__('Status')"
/>
<select class=" block mt-1 w-full rounded-md
shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ringindigo-200 focus:ring-opacity-50'" name="status">
                               <option value="{{$buku->status}}">{{$buku-
>status}}</option>
                               <option value="draft">Draft</option>
                               <option value="publish">Publish</option>
                           </select>
                           <x-input-error :messages="$errors-
>get('kategori')" class="mt-2" />
                       </div>
    
    
                       <!-- foto-->
                       <div class="mt-4">
                           <x-input-label for="foto" :value="__('Foto')" />
                           <x-text-input id="foto" class="block mt-1 w-full"
type="file" name="foto[]" :value="old('foto')" multiple/>
                           <x-input-error :messages="$errors->get('foto')"
class="mt-2" />
                           <br/>
                           @if($buku->fotobuku)
                           <table>
                           @foreach($buku->fotobuku as $foto)
                               <tr>
                                   <td>
                                       <img src="{{asset('foto_buku/'.$foto-
>foto)}}" width="200px" height="180px">
                                   </td>
                                   <td>
                                       <x-nav-button
:href="route('buku.hapus',$foto->id)" class="inline-flex items-center px-4
py-2 bg-red-500 border border-transparent rounded-md hover:bg-gray-700
active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ringgray-300 disabled:opacity-25 transition ease-in-out duration-150 pl-2 pr-2"
                                           label="" icon="fas fa-trash"
id="edit_buku"/>
                                   </td>
                                   </tr>
                           @endforeach
                               </table>
                           @endif
                       </div>
                       <div class="flex items-center justify-end mt-4">
                           <x-primary-button class="ml-4">
                               {{ __('Tambah Data') }}
                           </x-primary-button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
</x-app-layout>