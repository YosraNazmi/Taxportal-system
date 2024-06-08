
@if(auth()->user()->role == 'Adminstative' && $user->status == 'pending')
<div class="card mt-4 shadow">
    <div class="card-header bg-success text-white">
        Reason for Approval
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.firstApprove', ['user' => $user->id]) }}">
            @csrf
            <div class="mb-3">
                <label for="approvalComment" class="form-label">Approval Comment:</label>
                <textarea class="form-control" id="approvalComment" name="approval_comment" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Approve</button>
        </form>
    </div>
</div>
@endif

@if(auth()->user()->role == 'Manager' && $user->status == 'pending_second_approval')
    
        <div class="col-md-6 card-header bg-success text-white">
            Assign the Company
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.secondApprove', ['user' => $user->id]) }}" id="approvalForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tax Type:</label>
                    <div>
                        <input type="radio" class="btn-check" name="approval_type" id="approvalTypeLTO" value="LTO" required>
                        <label class="btn btn-outline-success shadow" for="approvalTypeLTO" onclick="submitApprovalForm('LTO')">LTO</label>

                        <input type="radio" class="btn-check" name="approval_type" id="approvalTypePIT" value="PIT" required>
                        <label class="btn btn-outline-success shadow" for="approvalTypePIT" onclick="submitApprovalForm('PIT')">CIT</label>
                    </div>
                </div>
            </form>
        </div>
    

    <script>
        function submitApprovalForm(type) {
            // Set the value of the selected type
            document.getElementById('approvalType' + type).checked = true;

            // Submit the form
            document.getElementById('approvalForm').submit();
        }
    </script>
@endif


@if(auth()->user()->role == 'Adminstative' && $user->status == 'rejected_by_manager')
<div class="card mt-4 shadow">
    <div class="card-header bg-success text-white">
        Reason for Approval
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.firstApprove', ['user' => $user->id]) }}">
            @csrf
            <div class="mb-3">
                <label for="approvalComment" class="form-label"> Approval Comment:</label>
                <textarea class="form-control" id="approvalComment" name="approval_comment" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Approve</button>
        </form>
    </div>
</div>
@endif

<!-- Rejection Form -->
<div class="col-md-6">
    <div class="card-header bg-danger text-white">
        Reject Taxpayer
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.rejectUser', ['user' => $user->id]) }}">
            @csrf
            <div class="mb-3">
                <label for="rejectionComment" class="form-label">Reason for Rejection:</label>
                <textarea class="form-control shadow" id="rejectionComment" name="approval_comment" required></textarea>
            </div>
            <button type="submit" class="btn btn-danger shadow">Reject</button>
        </form>
    </div>
</div>
