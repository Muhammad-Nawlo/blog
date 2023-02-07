@if(session()->has('success'))
    <div class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm"
         x-init="setTimeout(()=>show=false,2000)"
         x-data="{show:true}"
         x-show="show"
    >
        <p>
            {{session('success')}}
        </p>
    </div>
@endif
