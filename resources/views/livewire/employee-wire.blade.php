
<div class="card-body">
    <div class="bg-primary rounded h-50 p-2">
        <h5>Add New Employee</h5>
    </div>

    <form wire:submit.prevent="saveEmployee">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-label">First Name</div>
                    <input type="" wire:model="FirstName" class="form-control">
                    @error('FirstName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div class="form-label">Middle Name</div>
                    <input type="" wire:model="MiddleName" class="form-control">
                    @error('MiddleName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-label">Last Name</div>
                    <input type="" wire:model="LastName" class="form-control">
                    @error('LastName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div class="form-label">Suffix</div>
                    <input type="" wire:model="Suffix" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-label">Date of Birth</div>
                    <input type="date" wire:model="DOB" class="form-control">
                    @error('DOB')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-label">Civil Status</div>
                    <select wire:model="CivilStatus" class="form-control">
                        <option value="">--Select Status--</option> 
                        <option value="Single">Single</option> 
                        <option value="Married">Married</option> 
                        <option value="Separated">Separated</option> 
                        <option value="Widow">Widow</option> 
                    </select>
                    @error('CivilStatus')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-label">Place of Birth</div>
                    <input type="" wire:model="PlaceofBirth" class="form-control">
                    @error('PlaceofBirth')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end">
                @if($forUpdate)
                    <button class="btn btn-primary" type="submit">Update</button>
                @else
                    <button class="btn btn-primary" type="submit">Save</button>
                @endif
            </div>
        </div>
    </form>
    </div>
 
    <hr>
    <div class="card mb-4">
    <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Employees List
                </div>
                <div>
                    <input type="text" wire:model="searchTerm" placeholder="Search..." class="form-control">
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Suffix</th>
                <th>Date of Birth</th>
                <th>Place of Birth</th>
                <th>Civil Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->FirstName }}</td>
                            <td>{{ $employee->MiddleName }}</td>
                            <td>{{ $employee->LastName }}</td>
                            <td>{{ $employee->Suffix }}</td>
                            <td>{{ $employee->DOB }}</td>
                            <td>{{ $employee->PlaceofBirth }}</td>
                            <td>{{ $employee->CivilStatus }}</td>
                            <td>
                                
                                <button class="btn btn-info btn-sm" wire:click="update('{{ $employee->id }}')">Edit</button>
                                <button class="btn btn-danger btn-sm" wire:click="delete('{{ $employee->id }}')">Remove</button>
                        
                            </td>    
                        </tr>
                    @endforeach
            </tbody>
        </table>

        {{ $employees->links() }}
    </div>    
</div>

<div>
    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div>
            <input type="file" wire:model="file" id="file-input">
            <button wire:click="upload" class="btn btn-primary">Upload</button>
            <div wire:loading wire:target="upload">Uploading...</div>
            <div wire:loading wire:target="upload" wire:poll="upload" class="mt-2">
                <progress max="100" wire:model="progress"></progress>
                {{ $progress }}% Uploaded
            </div>
            @error('file')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </form>
</div>
