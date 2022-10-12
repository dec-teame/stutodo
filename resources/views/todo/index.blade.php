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
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">Todo</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($todos as $todo)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">
                    <h3 class="text-left font-bold text-lg text-grey-dark">Task: {{$todo->task}}</h3>
                    <h3 class="text-left font-bold text-lg text-grey-dark">Importance: {{$todo->importance}}</h3>
                    <h3 class="text-left font-bold text-lg text-grey-dark">Deadline: {{$todo->deadline}}</h3>
                    <a href="{{ route('todo.show',$todo->id) }}">
                      <h3 class="text-left font-bold text-lg text-grey-dark">{{$todo->todo}}</h3>
                    </a>
                  <div class="flex">
                    <!-- 更新ボタン -->
                    <!-- 削除ボタン -->
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>