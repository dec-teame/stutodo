<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todo Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $todos->links() }}
                    <table class="text-center w-full border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">
                                    Todo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todos as $todo)
                                <tr class="hover:bg-grey-lighter" id="todo{{ $todo->id }}">
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        <a href="{{ route('todo.show', $todo->id) }}">
                                            <h3 class="text-left font-bold text-lg text-grey-dark">Task:
                                                {{ $todo->task }}</h3>
                                            <h3 class="text-left font-bold text-lg text-grey-dark">Importance:
                                                {{ $todo->importance }}</h3>
                                            <h3 class="text-left font-bold text-lg text-grey-dark">Deadline:
                                                {{ $todo->deadline }}</h3>
                                        </a>
                                        <div class="flex">
                                            <!-- 更新ボタン -->
                                            <form action="{{ route('todo.edit', $todo->id) }}" method="GET"
                                                class="text-left">
                                                @csrf
                                                <button type="submit"
                                                    class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                                                    <svg class="h-6 w-6 text-black"  fill="none" viewBox="0 0 24 24" stroke="black">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>

                                                </button>
                                            </form>
                                            <!-- 削除ボタン -->
                                            <form action="{{ route('todo.destroy', $todo->id) }}" method="POST"
                                                class="text-left">
                                                @method('delete')
                                                @csrf
                                                <button type="submit"
                                                    class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline"
                                                    onclick="return window.confirm('本当に削除しますか?')">
                                                    <svg class="h-6 w-6 text-black"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" 
                                                    stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                                                    <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="4" y1="7" x2="20" y2="7" />  
                                                    <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />  
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <!-- 完了ボタン -->
                                            
                                            {{-- <form action="{{ route('todo.finished',$todo) }}" method="POST" class="text-left">
                                            @csrf --}}
                                            
                                            {{-- <button type="submit" id="isFinished" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-red py-1 px-2 focus:outline-none focus:shadow-outline" onclick="isFinished('asdf')"> --}}
                                                <button type="submit" id="isFinished" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-red py-1 px-2 focus:outline-none focus:shadow-outline" onclick="isFinished('{{ route('todo.finished',$todo) }}', 'todo{{ $todo->id }}')">
                                                @if ($todo->finished === 0)
                                                    <svg class="h-6 w-6 text-black"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" 
                                                    stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                                                    <path stroke="none" d="M0 0h24v24H0z"/>  
                                                    <path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2" />  
                                                    <rect x="9" y="3" width="6" height="4" rx="2" />
                                                    </svg>
                                                @else
                                                    <svg class="h-6 w-6 text-green-500"  width="24" height="24" viewBox="0 0 24 24" 
                                                    stroke-width="2" stroke="green" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                                                    <path stroke="none" d="M0 0h24v24H0z"/>  
                                                    <path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2" />  
                                                    <rect x="9" y="3" width="6" height="4" rx="2" />  <path d="M9 14l2 2l4 -4" />
                                                    </svg>
                                                @endif                                               
                                            </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $todos->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-slot name="javascript">
        <script type="text/javascript">
            function isFinished(url, removeId) {
                console.log(url)
            // $('#isFinished').click(function () {

                $.ajaxSetup({
                    headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")}
                });
                $.ajax({
                    url: url,
                    method: "POST",
                    // dataType: "json",
                    data: {},
                })
                .done(function(msg) {
                    let removeRow = '#' + removeId;
                    $(removeRow).remove();
                    console.log(removeId);
                    console.log(msg);
                    
                })
                .fail(function(msg) {
                    console.log('failed');
                    console.log(removeId);
                    console.log(msg.status);
                })
            }
            // });

        </script>
    </x-slot>
</x-app-layout>
