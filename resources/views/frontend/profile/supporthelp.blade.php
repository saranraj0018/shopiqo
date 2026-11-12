@php
    $statusLabels = [
        'pending'     => 'Pending',
        'in_progress' => 'In Progress',
        'on_hold'     => 'On Hold',
        'resolved'    => 'Resolved',
        'rejected'    => 'Rejected',
    ];
    $statusColors = [
        'pending'     => 'bg-white text-black',
        'in_progress' => 'bg-[#fff3eb] text-[#f97316]',
        'on_hold'     => 'bg-[#fff1f3] text-[#f43f5e]',
        'resolved'    => 'bg-[#ecfdf3] text-[#22c55e]',
        'rejected'    => 'bg-[#f3f4f6] text-[#6b7280]',
    ];

    $ticketRows = $tickets->map(fn ($t) => [
        'id'            => '#' . $t->id,
        'status'        => $statusLabels[$t->status] ?? ucfirst($t->status),
        'status_color'  => $statusColors[$t->status] ?? 'bg-white text-black',
        'created'       => $t->created_at->format('d/m/Y'),
        'updated'       => $t->updated_at->format('d/m/Y'),
        'description'   => $t->description,
        'attachment'    => $t->image,
    ]);
@endphp
<section >
    <div class="mx-auto">
        <h3 class="mb-3 text-[14px] flex justify-center font-medium text-white lg:hidden">
            Support Tickets
        </h3>

        <!-- Form -->
        <div class="mb-8 w-full lg:w-[55%] px-4 lg:px-0">
            <p id="ticketFormError" class="hidden mb-3 text-[12px] text-red-400"></p>

            <form id="ticketForm">
                @csrf
                <label class="mb-2 block text-[13px] font-medium text-white">
                    Description
                </label>

                <textarea name="description" id="ticket_description" placeholder="Explain About Your Problem"
                    class="h-[90px] w-full rounded-[8px] border border-white/10 bg-white px-4 py-3 text-[13px] text-black outline-none placeholder:text-gray-400"></textarea>

                <p class="mt-3 mb-3 text-[12px] text-white/80">
                    Add An Image To Provide More Details (Optional)
                </p>

                <label
                    class="flex h-[72px] w-full cursor-pointer items-center justify-center rounded-[12px] border border-dashed border-white/30 bg-transparent text-[13px] text-white/80 transition hover:border-white/50">
                    <input type="file" name="image" id="ticket_image" accept="image/*" class="hidden">
                    <span id="ticketImageLabel" class="flex items-center gap-2">
                        Attach Image
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 16V4m0 0l-4 4m4-4l4 4M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1" />
                        </svg>
                    </span>
                </label>

                <button type="submit" id="ticketSubmitBtn"
                    class="mt-4 h-[40px] min-w-[108px] rounded-full bg-white px-6 text-[14px] font-medium text-black transition hover:bg-white/90">
                    Submit
                </button>
            </form>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('ticketForm');
            if (!form) return;

            const errorEl = document.getElementById('ticketFormError');
            const submitBtn = document.getElementById('ticketSubmitBtn');
            const imageInput = document.getElementById('ticket_image');
            const imageLabel = document.getElementById('ticketImageLabel');

            imageInput.addEventListener('change', function () {
                imageLabel.firstChild.textContent = imageInput.files[0] ? imageInput.files[0].name : 'Attach Image';
            });

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                errorEl.classList.add('hidden');

                const description = document.getElementById('ticket_description').value.trim();
                if (!description) {
                    errorEl.textContent = 'Please describe your problem.';
                    errorEl.classList.remove('hidden');
                    return;
                }

                submitBtn.disabled = true;
                showLoader();

                const formData = new FormData(form);
                sendRequest('{{ route('support.ticket.store') }}', formData, 'POST', function (res) {
                    hideLoader();
                    submitBtn.disabled = false;
                    if (res.success) {
                        showToast(res.message, 'success', 2000);
                        setTimeout(() => window.location.reload(), 700);
                    } else {
                        errorEl.textContent = res.message || 'Something went wrong.';
                        errorEl.classList.remove('hidden');
                    }
                }, function (err) {
                    hideLoader();
                    submitBtn.disabled = false;
                    errorEl.textContent = err.errors ? Object.values(err.errors)[0][0] : (err.message || 'Something went wrong.');
                    errorEl.classList.remove('hidden');
                });
            });
        });
        </script>

        <!-- Tickets -->
        <div class="w-full lg:w-[90%]">
            <h3 class="hidden lg:block mb-3 text-[13px] font-medium text-white">
                Support Tickets
            </h3>

            <div class="space-y-3 h-[40vh] overflow-auto custom-scroll">

                @forelse($ticketRows as $ticket)
                <div
                    class="rounded-[14px] border border-white/10 bg-white/[0.04] px-4 py-4 backdrop-blur-md shadow-[inset_0_0_40px_rgba(255,255,255,0.03)]">

                    <!-- Top -->
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-center gap-2">

                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white/80" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 6.75V6A2.25 2.25 0 0014.25 3.75h-4.5A2.25 2.25 0 007.5 6v.75m9 0h1.125A1.875 1.875 0 0119.5 8.625v9.75a1.875 1.875 0 01-1.875 1.875H6.375A1.875 1.875 0 014.5 18.375v-9.75A1.875 1.875 0 016.375 6.75H7.5m9 0h-9" />
                            </svg>

                            <p class="text-[11px] text-white">
                                Ticket ID: {{ $ticket['id'] }}
                            </p>
                        </div>

                        <!-- Status -->
                        <span class="rounded-full px-3 py-[3px] text-[10px] font-medium {{ $ticket['status_color'] }}">
                            {{ $ticket['status'] }}
                        </span>
                    </div>

                    <!-- Dates -->
                    <div class="mt-2 flex items-start justify-between gap-4">
                        <p class="text-[10px] text-white">
                            Created On: {{ $ticket['created'] }}
                        </p>

                        <p class="text-[10px] text-white/80">
                            Last Updated: {{ $ticket['updated'] }}
                        </p>
                    </div>

                    <!-- Description -->
                    <div class="mt-3 flex gap-[10px]">
                        <p class="text-[11px] font-medium text-white">Description:</p>

                        <p class="text-[10px] leading-[1.5] text-white/55">
                            {{ $ticket['description'] }}
                        </p>
                    </div>

                    <!-- Attachment (optional) -->
                    @if(!empty($ticket['attachment']))
                    <div class="mt-3 flex gap-[10px] items-center ">
                        <p class=" text-[11px] font-medium text-white">Attachments:</p>

                        <a href="{{ asset('storage/' . $ticket['attachment']) }}" target="_blank"
                            class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-[4px] text-[10px] text-black hover:bg-white/90">

                            <span
                                class="flex h-4 w-4 items-center justify-center rounded-full bg-blue-600 text-white text-[9px]">
                                📄
                            </span>

                            View Attachment
                        </a>
                    </div>
                    @endif

                </div>
                @empty
                <p class="text-[12px] text-white/50">No support tickets yet.</p>
                @endforelse

            </div>
        </div>
    </div>
</section>
<style>
.custom-scroll::-webkit-scrollbar {
    width: 8px;
}

.custom-scroll::-webkit-scrollbar-track {
    background: black;
}

.custom-scroll::-webkit-scrollbar-thumb {
    background: #616161;
    border-radius: 10px;

    /* THIS creates left space */
    border-left: 5px solid black;
    background-clip: padding-box;
}

.custom-scroll::-webkit-scrollbar-thumb:hover {
    background: #7e7e7e;
}
</style>