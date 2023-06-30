<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            やることリスト
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6" style="width:80%;">
        <div class="text-center" style="width:100%;">
            @if(session('message'))
                <div class="text-red-600 font-bold">
                    {{session('message')}}
                </div>
            @endif

            <div class="mt-4 p-8 bg-white w-full rounded-2xl flex w-full flex" style="width:900px; margin-left:auto; margin-right:auto;">
                <form method="post" action="{{route('post.store')}}" class="flex">
                    @csrf
                    <div class="w-full flex items-center">
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" cols="100" rows="2">{{old('body')}}</textarea>
                        <x-primary-button class="btn ml-2" style="width: 50px; height: 60px;">
                            追加
                        </x-primary-button>
                    </div>
                </form>
            </div>

            @foreach($posts as $post)
                <div class="mt-4 p-8 bg-white w-full rounded-2xl flex w-full flex" style="width: 900px; margin-left:auto; margin-right:auto;">
                    <form method="POST" action="{{ route('post.update', $post) }}" class="flex-1">
                        @csrf
                        @method('PATCH')
                        <div class="flex">
                            <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" cols="100" rows="2">{{ $post->body }}</textarea>
                            <x-primary-button type="submit" class="btn ml-2" style="width: 50px; height: 60px;">
                                編集
                            </x-primary-button>
                        </div>
                    </form>

                    <form method="post" action="{{route('post.destroy',$post)}}" style="width: 50px;">
                        @csrf
                        @method('delete')
                        <x-primary-button class="btn flex" style="width: 50px; height: 60px; background-color: red; color: white;">
                            削除
                        </x-primary-button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
