@extends('layouts.admin')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')

@section('content')

<div class="admin-page-header">
    <h1>Messages</h1>
    <p>Review contact form submissions from site visitors.</p>
</div>

{{-- ===================== TABLE ===================== --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
        <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
            All Messages
            <span class="badge badge-secondary ml-2" style="font-size:0.75rem;">
                {{ $messages->total() }}
            </span>
        </h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:0.855rem;">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Preview</th>
                    <th class="text-center">Read</th>
                    <th>Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr class="{{ !$message->read ? 'font-weight-bold' : '' }}"
                        style="{{ !$message->read ? 'background: #fffbf0;' : '' }}">
                        <td style="{{ !$message->read ? 'font-weight:700;color:#0f172a;' : 'color:#475569;' }}">
                            {{ $message->name }}
                        </td>
                        <td>
                            <a href="mailto:{{ $message->email }}"
                               class="text-decoration-none text-muted">
                                {{ $message->email }}
                            </a>
                        </td>
                        <td style="max-width:180px;">
                            {{ Str::limit($message->subject ?? '(No subject)', 40) }}
                        </td>
                        <td style="max-width:240px;" class="text-muted">
                            {{ Str::limit($message->message, 80) }}
                        </td>
                        <td class="text-center">
                            @if($message->read)
                                <span class="badge badge-success px-2 py-1">Read</span>
                            @else
                                <span class="badge badge-warning px-2 py-1">Unread</span>
                            @endif
                        </td>
                        <td class="text-muted" style="white-space:nowrap;">
                            {{ $message->created_at->format('d M Y') }}
                            <div style="font-size:0.75rem;">{{ $message->created_at->format('H:i') }}</div>
                        </td>
                        <td class="text-center" style="white-space:nowrap;">
                            {{-- View (expand modal) --}}
                            <button type="button"
                                    class="btn btn-sm btn-outline-primary mr-1"
                                    title="View Message"
                                    data-toggle="modal"
                                    data-target="#messageModal{{ $message->id }}">
                                <i class="fa fa-eye"></i>
                            </button>

                            {{-- Mark Read --}}
                            @if(!$message->read)
                                <form action="{{ route('admin.messages.read', $message) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-info mr-1"
                                            title="Mark as Read">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </form>
                            @endif

                            {{-- Delete --}}
                            <form action="{{ route('admin.messages.destroy', $message) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Delete Message"
                                        onclick="return confirm('Permanently delete this message from {{ addslashes($message->name) }}?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- View Modal --}}
                    <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom">
                                    <h5 class="modal-title" id="messageModalLabel{{ $message->id }}"
                                        style="font-weight:700;color:#0f172a;">
                                        <i class="fa fa-envelope mr-2 text-primary"></i>
                                        {{ $message->subject ?? '(No subject)' }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <dl class="row mb-3" style="font-size:0.875rem;">
                                        <dt class="col-sm-2 text-muted">From</dt>
                                        <dd class="col-sm-10" style="font-weight:600;">{{ $message->name }}</dd>

                                        <dt class="col-sm-2 text-muted">Email</dt>
                                        <dd class="col-sm-10">
                                            <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                        </dd>

                                        <dt class="col-sm-2 text-muted">Date</dt>
                                        <dd class="col-sm-10 text-muted">
                                            {{ $message->created_at->format('d M Y, H:i') }}
                                        </dd>
                                    </dl>
                                    <hr>
                                    <div style="font-size:0.9rem;line-height:1.75;white-space:pre-wrap;color:#334155;">{{ $message->message }}</div>
                                </div>
                                <div class="modal-footer border-top">
                                    @if(!$message->read)
                                        <form action="{{ route('admin.messages.read', $message) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-info">
                                                <i class="fa fa-check mr-1"></i>Mark as Read
                                            </button>
                                        </form>
                                    @endif
                                    <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject ?? '') }}"
                                       class="btn btn-primary">
                                        <i class="fa fa-reply mr-1"></i>Reply via Email
                                    </a>
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- /Modal --}}

                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fa fa-inbox fa-2x mb-2 d-block"></i>
                            No messages yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $messages->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@endsection
