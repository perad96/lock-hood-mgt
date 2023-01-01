@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Add New Task</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('task-add')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reporter</label>
                                        <select name="reporter" class="form-control @error('reporter')is-invalid @enderror">
                                            <option value="">- Select Reporter -</option>
                                            @foreach($reporterArr as $reporter)
                                                <option @if($reporter['id'] == old('reporter')) selected @endif value="{{$reporter['id']}}">{{$reporter['first_name'].' '.$reporter['last_name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('reporter')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Assignee</label>
                                        <select name="assignee" class="form-control @error('assignee')is-invalid @enderror">
                                            <option value="">- Select Assignee -</option>
                                            @foreach($reporterArr as $assignee)
                                                <option @if($assignee['id'] == old('assignee')) selected @endif value="{{$assignee['id']}}">{{$assignee['first_name'].' '.$assignee['last_name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('assignee')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" rows="4" class="form-control @error('description')is-invalid @enderror">{{old('description')}}</textarea>
                                        @error('description')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Due Date</label>
                                        <input name="due_date" value="{{old('due_date')}}" type="date" class="form-control @error('due_date')is-invalid @enderror">
                                        @error('due_date')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Started At</label>
                                        <input name="start_date" value="{{old('start_date')}}" type="datetime-local" class="form-control @error('start_date')is-invalid @enderror">
                                        @error('start_date')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End At</label>
                                        <input name="end_date" value="{{old('end_date')}}" type="datetime-local" class="form-control @error('end_date')is-invalid @enderror">
                                        @error('end_date')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Spend Hours</label>
                                        <input name="spend_hours" value="{{old('spend_hours')}}" type="number" class="form-control @error('spend_hours')is-invalid @enderror">
                                        @error('spend_hours')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Spend Minutes</label>
                                        <input name="spend_minutes" value="{{old('spend_minutes')}}" type="number" class="form-control @error('spend_minutes')is-invalid @enderror">
                                        @error('spend_minutes')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control @error('status')is-invalid @enderror">
                                            <option value="">- Select Task Status -</option>
                                            @foreach($statusArr as $status)
                                                <option @if($status == old('status')) selected @endif value="{{$status}}">{{$status}}</option>
                                            @endforeach
                                        </select>
                                        @error('status')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <small class="text-muted font-weight-bold">Task Raw Materials</small>
                            <button onclick="addTaskMaterialRow()" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="col-md-7">Description</th>
                                    <th scope="col" class="col-md-3">Qty</th>
                                </tr>
                                </thead>
                                <tbody id="tblTaskMaterial">
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary btn-round">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let tblTaskMaterialRowIndex = 0;
        const tblTaskMaterialRows = [];
        const rawMaterialsArr = @json($rawMaterialsArr)

        function addTaskMaterialRow() {
            let html = "";
            html += '<tr id="task_material_row_' + tblTaskMaterialRowIndex + '">';
            html += '<td>';
            // html += '<input name="description_' + tblTaskMaterialRowIndex + '" id="description_' + tblTaskMaterialRowIndex + '" type="text" class="form-control" required>';
            html += '<select name="raw_material[]" id="raw_material_' + tblTaskMaterialRowIndex + '" class="form-control" required>';
            html += '<option value="">- Select Raw Material -</option>';

            for (let i = 0; i < rawMaterialsArr.length; i++) {
                html += `<option value="${rawMaterialsArr[i]['id']}">${rawMaterialsArr[i]['item_name']}</option>`;
            }

            html += '</select>';
            html += '</td>';
            html += '<td>';
            html += '<input name="qty[]" id="qty_' + tblTaskMaterialRowIndex + '" type="number" step=".01" class="form-control" required>';
            html += '</td>';
            html += '<td class="text-right">'
            html += '<button onclick="removeTaskTblRow(' + tblTaskMaterialRowIndex + ')" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>'
            html += '</td>';
            html += '</tr>';

            $('#tblTaskMaterial').append(html);
            tblTaskMaterialRowIndex++;
        }

        function removeTaskTblRow(id) {
            const row_id = '#task_material_row_' + id;
            $(row_id).remove();
        }
    </script>
@endsection
