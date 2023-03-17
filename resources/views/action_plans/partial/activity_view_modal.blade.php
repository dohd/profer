<!-- Modal -->
<div class="modal fade" id="activity_view_modal" tabindex="-1" aria-labelledby="activity_view_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activity_view_modal_label">Action Plan Activity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered activity_view">
                    @php
                        $labels = ['Activity','Period (Start-End)','Regions','Resources','Assigned To',];
                    @endphp
                    @foreach ($labels as $val)
                        <tr>
                            <th width="30%">{{ $val }}</th>
                            <td></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
