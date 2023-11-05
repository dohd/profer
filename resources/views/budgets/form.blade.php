<div class="row mb-3">
    <div class="col-md-10 col-12">
        <label for="name">Project Name</label>
        {{ Form::text('project_name', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-2 col-12">
        <label for="name">Project Number</label>
        {{ Form::text('project_tid', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6 col-12">
        <label for="name">Project Patner</label>
        {{ Form::text('project_patner', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-3 col-12">
        <label for="name">Project Agreement Period</label>
        {{ Form::text('project_agreement_period', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-3 col-12">
        <label for="name">Project Period</label>
        {{ Form::text('project_period', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table table-cstm" id="objectivesTbl">
        <thead>
            <tr class="table-primary">
                <th width="70%">Description</th>
                <th width="12%">Budget</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Objectives -->
            <tr class="bg-light bg-gradient">
                <td class="p-1" colspan="3"><b>Objective #1:</b></td>
            </tr>
            <tr>
                <td class="p-1">M&E Training</td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value="500,000"></td>
                <td class="p-1"></td>
            </tr>
            <tr>
                <td class="p-1">Activity 1.2</td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value=""></td>
                <td class="p-1"></td>
            </tr>
            <tr class="bg-light bg-gradient">
                <td class="p-1"><b>Subtotal</b></td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value="500,000"></td>
                <td class="p-1"></td>
            </tr>
            <tr class="bg-light bg-gradient">
                <td class="p-1" colspan="3"><b>Objective #2:</b></td>
            </tr>
            <tr>
                <td class="p-1">M&E Training 2</td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value="500,000"></td>
                <td class="p-1"></td>
            </tr>
            <tr>
                <td class="p-1">Activity 1.2</td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value=""></td>
                <td class="p-1"></td>
            </tr>
            <tr class="bg-light bg-gradient">
                <td class="p-1"><b>Subtotal</b></td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value="500,000"></td>
                <td class="p-1"></td>
            </tr>
            <!-- End Objectives -->

            <!-- Personnel Costs -->
            <tr class="bg-info bg-gradient">
                <td class="p-1" colspan="3"><b>Personnel Costs</b></td>
            </tr>
            <tr>
                <td class="p-1">Director</td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value="300,000"></td>
                <td class="p-1"></td>
            </tr>
            <tr>
                <td class="p-1">Programme Officer</td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value="100,000"></td>
                <td class="p-1"></td>
            </tr>
            <tr class="bg-light bg-gradient">
                <td class="p-1"><b>Subtotal</b></td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value="400,000"></td>
                <td class="p-1"></td>
            </tr>
            <!-- End Personnel Costs -->

            <!-- Overhead Costs -->
            <tr class="bg-info bg-gradient">
                <td class="p-1" colspan="3"><b>Overhead Costs</b></td>
            </tr>
            <tr>
                <td class="p-1">Travel Costs</td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value="500,000"></td>
                <td class="p-1"></td>
            </tr>
            <tr>
                <td class="p-1">Rent Contribution</td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value="50,000"></td>
                <td class="p-1"></td>
            </tr>
            <tr class="bg-light bg-gradient">
                <td class="p-1"><b>Subtotal</b></td>
                <td class="p-1"><input type="text" class="form-control p-1" name="" value="550,000"></td>
                <td class="p-1"></td>
            </tr>
            <!-- End Overhead Costs -->
        </tbody>
        <tfoot class="">
            <tr><td colspan="3"></td></tr>
            <tr class="bg-light bg-gradient">
                <td class="p-1"><b>Grand Total</b></td>
                <td class="p-1"><input type="text" class="form-control p-1 bg-light" name="" value="1,950,000" readonly></td>
                <td class="p-1"></td>
            </tr>
        </tfoot>
    </table>
</div>
