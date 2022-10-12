<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('common.errors')
                    <form class="mb-6" action="{{ route('todo.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-col mb-4">
                            <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="task">task</label>
                            <input class="border py-2 px-3 text-grey-darkest" type="text" name="task"
                                id="task" value="{{ old('task') }}" placeholder="taskを入力してください。">
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-2 uppercase font-bold text-lg text-grey-darkest"
                                for="deadline">deadline</label>
                            <input class="border py-2 px-3 text-grey-darkest" type="date" name="deadline"
                                id="deadline" value="{{ old('deadline') }}" placeholder="期限を入力してください。">
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-2 uppercase font-bold text-lg text-grey-darkest"
                                for="importance">importance</label>
                            <select name="importance" id="importance">
                                <option hidden>重要度を1~3で入力してください。</option>
                                <option value="1">☆</option>
                                <option value="2">☆☆</option>
                                <option value="3">☆☆☆</option>
                            </select>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="mb-2 uppercase font-bold text-lg text-grey-darkest"
                                for="description">Description</label>
                            <input class="border py-2 px-3 text-grey-darkest" type="text" name="description"
                                id="description" value="{{ old('description') }}" placeholder="詳細を入力してください。">
                        </div>
                        <button type="submit"
                            class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                            送信
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
