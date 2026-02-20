@extends("layouts.app")

@section("content")
    <h1>Family Page</h1>
    <p>Welcome to the family page! Here you can find information about different families.</p>

    <div class="rounded-lg bg-gray-500 p-5">
        <form action="/family/create" method="POST" onsubmit="formSubmitHandler(event)">
            <!-- csrf token for security -->
            @csrf
            <div class="mb-3">
                <label class="form-label" for="family_name">Family Name</label>
                <input class="form-control" type="text" name="name" id="family_name" placeholder="Family Name" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="memberCount">Number of Members</label>
                <input class="form-control" type="number" name="memberCount" id="member_count" placeholder="Number of Members" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Family</button>
        </form>
    </div>

    <!-- Example of displaying family data -->
    @if(isset($families) && count($families) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Family Name</th>
                    <th>Member Count</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($families as $family)
                    <tr data-family-id="{{ $family->id }}">
                        <td>{{ $family->id }}</td>
                        <td>{{ $family->name }}</td>
                        <td>{{ $family->member_count }}</td>
                        <td class="text-end">
                            <a href="#" onclick="removeFamilyHandler({{ $family->id }})">Delete</a>
                            
                            {{-- Check privileges and authentication for edit link --}}
                            @if(Auth::check() && Gate::allows('update', $family))
                                <a href="#" data-bs-toggle="modal" data-bs-target={{ "#modal-" . $family->id }} >Edit</a>
                                <div class="modal fade" id={{ "modal-" . $family->id }} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action={{ "/family/update/" . $family->id }} method="POST" onsubmit="familyEditedFormSubmitHandler(event)">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="family_name">Family Name</label>
                                                        <input class="form-control" type="text" name="name" id={{ "modal-" . $family->id . '-familyName' }} placeholder="Family Name" value={{ $family->name }} required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="memberCount">Member Count</label>
                                                        <input class="form-control" type="number" name="memberCount" id={{ "modal-" . $family->id . '-memberCount' }} placeholder="Family Name" value={{ $family->member_count }} required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input class="btn btn-primary" type="submit" value="Save changes">
                                                </div>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No families found.</p>
    @endif
@endsection

@stack("scripts")
<script>
    // Example of adding JavaScript for the family page
    console.log("Family page loaded");
</script>
<script>
    async function formSubmitHandler(event) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);
        
        console.log("Form submit form javaScript handler called");

        try {
            const response = await fetch(form.action, {
                method: form.method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').getAttribute('value')
                },
                body: formData
            });
            
            if (response.ok) {
                const result = await response.json();
                console.log("Family created:", result);
                // Optionally, you can update the UI to show the new family without reloading
            } else {
                console.error("Error creating family:", response.statusText);
            }
        } catch (error) {
            console.error("Network error:", error);
        }
    }

    async function familyEditedFormSubmitHandler(event) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);
        
        console.log("Family edit form submit handler called");

        try {
            const response = await fetch(form.action, {
                method: form.method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').getAttribute('value')
                },
                body: formData
            });
            
            if (response.ok) {
                const result = await response.json();
                console.log("Family updated:", result);
                // Optionally, you can update the UI to show the updated family without reloading
            } else {
                console.error("Error updating family:", response.statusText);
            }
        } catch (error) {
            console.error("Network error:", error);
        }
    }

    async function removeFamilyHandler(familyId) {
        try {
            const response = await fetch(`/family/delete/${familyId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').getAttribute('value')
                }
            });
            
            if (response.ok) {
                console.log("Family deleted:", familyId);
                
                const row = document.querySelector(`tr[data-family-id="${familyId}"]`);
                console.log(row);
                if (row) {
                    row.remove();
                }
            } else {
                console.error("Error deleting family:", response.statusText);
            }
        } catch (error) {
            console.error("Network error:", error);
        }
    }
</script>
<script>
    // You can add more JavaScript here if needed
</script>