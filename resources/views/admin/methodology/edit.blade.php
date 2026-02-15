@extends('admin.layouts.app')
@section('title', 'Edit Methodology Step')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.methodology.index') }}" class="text-sm text-accent hover:underline flex items-center gap-1 mb-4">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Back to Methodology
    </a>
    <h1 class="text-2xl font-bold text-slate-900">Edit Methodology Step</h1>
    <p class="text-slate-500 text-sm mt-1">Update "{{ $step->title }}"</p>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8">
    <form action="{{ route('admin.methodology.update', $step) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.methodology._form', ['step' => $step])
        <div class="flex items-center gap-4 pt-6 border-t border-slate-200 mt-8">
            <button type="submit" class="inline-flex items-center gap-2 bg-accent text-white px-6 py-2.5 rounded-lg font-medium hover:bg-accent/90 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-lg">save</span> Update Step
            </button>
            <a href="{{ route('admin.methodology.index') }}" class="text-slate-500 hover:text-slate-700 font-medium">Cancel</a>
        </div>
    </form>
</div>
@endsection
