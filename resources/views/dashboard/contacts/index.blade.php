@extends('dashboard.layouts.master')

@section('title', 'Contacts')

@section('css')
@endsection

@section('content')

    <div class="py-30 px-30 rounded-4 bg-white custom_shadow">

        {{-- Tabs --}}
        <div class="tabs -underline-2">
            {{-- Table --}}
            <div class="pt-30 table_action_icon">
                <div class="overflow-scroll scroll-bar-1">

                    <table class="table-3 -border-bottom col-12">
                        <thead class="bg-light-2">
                            <tr>
                                <th>Sr.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Submitted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($contacts as $contact)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->created_at->format('d M, Y h:i A') }}</td>
                                    <td class="d-flex">
                                        @can('view contact')
                                            <a href="{{ route('dashboard.contacts.show', $contact->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('delete contact')
                                            <form action="{{ route('dashboard.contacts.destroy', $contact->id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <a href="#" type="submit"
                                                    class="btn btn-icon btn-text-danger delete_confirmation"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ __('Delete Contact') }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-20">
                                        No contacts found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($contacts->lastPage() > 1)
            <div class="pt-30">
                <div class="row justify-between">

                    {{-- Previous --}}
                    <div class="col-auto">
                        <a href="{{ $contacts->previousPageUrl() ?? 'javascript:void(0)' }}"
                            class="button -blue-1 size-40 rounded-full border-light
               {{ $contacts->onFirstPage() ? 'disabled opacity-50' : '' }}">
                            <i class="icon-chevron-left text-12"></i>
                        </a>
                    </div>

                    {{-- Pages --}}
                    <div class="col-auto">
                        <div class="row x-gap-20 y-gap-20 items-center">

                            {{-- First Page --}}
                            @if ($contacts->currentPage() > 3)
                                <div class="col-auto">
                                    <a href="{{ $contacts->url(1) }}" class="size-40 flex-center rounded-full">1</a>
                                </div>

                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">...</div>
                                </div>
                            @endif

                            {{-- Page Numbers --}}
                            @for ($i = max(1, $contacts->currentPage() - 2); $i <= min($contacts->lastPage(), $contacts->currentPage() + 2); $i++)
                                <div class="col-auto">
                                    <a href="{{ $contacts->url($i) }}"
                                        class="size-40 flex-center rounded-full
                           {{ $contacts->currentPage() == $i ? 'bg_themes text-white' : '' }}">
                                        {{ $i }}
                                    </a>
                                </div>
                            @endfor

                            {{-- Last Page --}}
                            @if ($contacts->currentPage() < $contacts->lastPage() - 2)
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">...</div>
                                </div>

                                <div class="col-auto">
                                    <a href="{{ $contacts->url($contacts->lastPage()) }}"
                                        class="size-40 flex-center rounded-full">
                                        {{ $contacts->lastPage() }}
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                    {{-- Next --}}
                    <div class="col-auto">
                        <a href="{{ $contacts->nextPageUrl() ?? 'javascript:void(0)' }}"
                            class="button -blue-1 size-40 rounded-full border-light
               {{ !$contacts->hasMorePages() ? 'disabled opacity-50' : '' }}">
                            <i class="icon-chevron-right text-12"></i>
                        </a>
                    </div>

                </div>
            </div>
        @endif


    </div>

@endsection

@section('script')
@endsection
