<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Halaman Tambah Buku') }}
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
                  
               <form method="POST" action="{{ route('buku.store') }}"
enctype="multipart/form-data">
                   @csrf
                   <!-- judul -->
                   <div class="mt-4">
                       <x-input-label for="judul" :value="__('Judul Buku')"
/>
                       <x-text-input id="judul" class="block mt-1 w-full"
type="text" name="judul" :value="old('judul')" required autofocus />
                       <x-input-error :messages="$errors->get('judul')"
class="mt-2" />
                   </div>
                   <!-- deskripsi -->
                   <div class="mt-4">
                       <x-input-label for="deskripsi" :value="__('Deskripsi
Buku')" />
                       <x-text-area id="deskripsi" class="block mt-1 w-full"
name="deskripsi" required autofocus >deskripsi buku</x-text-area>
                       <x-input-error :messages="$errors->get('deskripsi')"
class="mt-2" />
                </div>
                   <div class="mt-4">
                       <x-input-label for="status" :value="__('Status')" />
                       <select class=" block mt-1 w-full rounded-md shadowsm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
focus:ring-opacity-50'" name="status">
                           <option value="draft">Draft</option>
                           <option value="publish">Publish</option>
                       </select>
                       <x-input-error :messages="$errors->get('kategori')"
class="mt-2" />
                   </div>
                   <!-- foto-->
                   <div class="mt-4">
                       <x-input-label for="foto" :value="__('Foto')" />
                       <x-text-input id="foto" class="block mt-1 w-full"
type="file" name="foto[]" :value="old('foto')" required autofocus multiple/>
                       <x-input-error :messages="$errors->get('foto')"
class="mt-2" />
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