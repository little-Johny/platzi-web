<x-forum.layouts.home>
    <ul class="space-y-2">
        @forelse ($questions as $question)
        <li class="flex justify-between gap-4 py-4">
            <div class="flex gap-4">
                <div class="size-8 rounded-full flex items-center justify-center" style="background-color: {{ $question->category->color }};">
                    <x-forum.question-logo class="h-6 w-6 text-white"/>
                </div>
                <div class="flex-auto">
                    <p class="text-sm font-semibold text-gray-900">
                        <a href="{{ route('questions.show', $question) }}" class="hover:underline">{{ $question->title }}</a>
                    </p>
                    <p class="mt-1 text-xs text-gray-500">{{ $question->user->name }}</p>
                </div>
            </div>

            <div class="hidden sm:flex sm:flex-col sm:items-end">
                <p class="text-sm text-white rounded-lg p-1" style="background-color: {{ $question->category->color }}">{{ $question->category->name }}</p>
                <p class="mt-1 text-xs text-gray-500">{{ $question->created_at->diffForHumans() }}</p>
            </div>
        </li>
        @empty
        <li class="text-gray-500">No hay preguntas todavía.</li>
        @endforelse
    </ul>
</x-forum.layouts.home>

