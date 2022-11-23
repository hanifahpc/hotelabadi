<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Halaman User') }}
       </h2>
   </x-slot>
   <div class="py-12">
      
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
           <x-nav-button :href="route('user.create')"
           class="inline-flex items-center px-4 py-2 bg-green-800 border
border-transparent rounded-md font-semibold text-xs text-white uppercase
tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none
focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition
ease-in-out duration-150 mb-2"
           label="Tambah User" icon="fas fa-user-plus" id="tambah_user"/>
           <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 bg-white border-b border-gray-200">
                   @if (session('sukses'))
                       <div class="flex flex-col p-2 bg-green-500 shadow-md
mb-2 text-xl font-bold">
                           {{ session('sukses')}}
                       </div>
                   @endif
                   @if (session('errors'))
                     <div class="flex flex-col p-2 bg-red-500 shadow-md mb-2
text-xl font-bold">
                         {{session('errors')}}
                       </div>
                   @endif
                 <x-table id="tabel_user">
                   <x-slot name="header">
                           <x-table-column>No</x-table-column>
                           <x-table-column>Username</x-table-column>
                           <x-table-column>Nama</x-table-column>
                           <x-table-column>Email</x-table-column>
                           <x-table-column>Role</x-table-column>
                           <x-table-column>Aksi</x-table-column>
                   </x-slot>
                   @foreach ($user as $user)
                   <tr>
                       <x-table-column>{{$loop->iteration}}</x-table-column>
                       <x-table-column>{{$user->username}}</x-table-column>
                       <x-table-column>{{$user->name}}</x-table-column>
                       <x-table-column>{{$user->email}}</x-table-column>
                       <x-table-column>{{$user->role}}</x-table-column>
                       <x-table-column>  
                           <x-nav-button :href="route('user.edit',$user->id)"
class="inline-flex items-center px-4 py-2 bg-blue-500 border bordertransparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none
focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition
ease-in-out duration-150 pl-2 pr-2"
                           label="" icon="fas fa-pencil" id="edit_user"/>
                           <x-nav-button :href="route('user.show',$user->id)"
class="inline-flex items-center px-4 py-2 bg-orange-400 border bordertransparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition
ease-in-out duration-150 pl-2 pr-2"
                               label="" icon="fas fa-eye" id="show_user"/>
                            
                              
                                 <x-button type="button" class="items-center
px-4 py-2 bg-red-600 border border-transparent rounded-md hover:bg-gray-700
active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ringgray-300 disabled:opacity-25 transition ease-in-out duration-150 pl-3 pr-3"
onclick="toggleModal('hapus_user{{$loop->iteration}}')"
                                 label="" icon="fas fa-trash"/>
                                
                                     <x-modals id="hapus_user{{$loop-
>iteration}}" title="Konfirmasi Hapus User" form="true">
                                       <form action="
{{route('user.delete',$user->id)}}" method="POST" class="inline-flex">
                                         @csrf
                                       @method('DELETE')
                                         Apakah anda yakin akan menghapus
user ini?
                                     </x-modals>
                      
                       </x-table-column>
                   </tr>
                   @endforeach
               </x-table>
               </div>
           </div>
       </div>
   </div>
  
     <script type="text/javascript">
       function toggleModal(modalID){
         document.getElementById(modalID).classList.toggle("hidden");
         document.getElementById(modalID + "-
backdrop").classList.toggle("hidden");
         document.getElementById(modalID).classList.toggle("flex");
         document.getElementById(modalID + "-
backdrop").classList.toggle("flex");
       }
     </script>
</x-app-layout>
