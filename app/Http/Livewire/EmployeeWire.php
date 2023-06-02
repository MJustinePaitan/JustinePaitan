<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class EmployeeWire extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $CivilStatus, $FirstName, $MiddleName, $LastName, $Suffix, $DOB, $PlaceofBirth, $forUpdate;
    public $searchTerm;
    public $list;
    public $file; // Added property for file upload
    public $progress; // Added property for progress tracking

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $employees = $this->getEmployeeList()->paginate(4);
        return view('livewire.employee-wire', compact('employees'));
    }



    public function delete($id)
    {
        $delete = Employee::where('id', $id)->delete();
        if($delete)
         $this->alert('success','Successfuly deleted!');
    }

    public function update($id)
    {
        $this->forUpdate = $id;
        $employees = Employee::find($id);
        
        if(isset($info)){
            $this->sessionID = $id;
            $this->forUpdate = true;
            $this->FirstName = $info->FirstName;
            $this->MiddleName = $info->MiddleName;
            $this->LastName = $info->LastName;
            $this->Suffix = $info->Suffix;
            $this->DOB = $info->DOB;
            $this->CivilStatus = $info->CivilStatus;
            $this->PlaceOfBirth = $info->PlaceOfBirth;
        }
    }

    public function saveEmployee()
    {
        $validate = $this->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'Suffix' => 'required',
            'DOB' => 'required',
            'PlaceofBirth' => 'required',
            'CivilStatus' => 'required',
        ],[
            'FirstName.required' => 'First Name is required',
            'LastName.required' => 'Last Name is required',
            'Suffix.required' => 'Suffix is required',
            'DOB.required' => 'Date of Birth is required',
            'PlaceofBirth.required' => 'Place of Birth is required',
            'CivilStatus.required' => 'Civil Status is required',
        ]);

        if($validate){
            if($this->forUpdate){
                $data = [
                    'FirstName' => $this->FirstName,
                    'MiddleName' => $this->MiddleName,
                    'LastName' => $this->LastName,
                    'Suffix' => $this->Suffix,
                    'DOB' => $this->DOB,
                    'PlaceofBirth' => $this->PlaceofBirth,
                    'CivilStatus' => $this->CivilStatus,
                ];

                $update = Employee::where('id', $this->sessionID)
                ->update($data);
                if($update){
                    $this->alert('success', $this->FirstName.''.$this->LastName.' has been updated',['toast' => false,'position' => 'center']);
                }

            }else{
                $employee = new Employee();
                $employee->EmployeeNo = strtoupper(uniqid());
                $employee->FirstName = $this->FirstName;
                $employee->MiddleName = $this->MiddleName;
                $employee->LastName = $this->LastName;
                $employee->Suffix = $this->Suffix;
                $employee->DOB = $this->DOB;
                $employee->PlaceofBirth = $this->PlaceofBirth;
                $employee->CivilStatus = $this->CivilStatus;
                $employee->save();

                $this->alert('success', $this->FirstName.''.$this->LastName.' has been added',['toast' => false,'position' => 'center']);
            }

            $this->reset([
                'FirstName',
                'MiddleName',
                'LastName',
                'Suffix',
                'DOB',
                'PlaceofBirth',
                'CivilStatus',
            ]);
        }
    }

    public function getEmployeeList()
    {
        $query = Employee::query();

        if ($this->searchTerm) {
            $query->where(function ($q) {
                $q->where('FirstName', 'LIKE', '%' . $this->searchTerm . '%')
                    ->orWhere('LastName', 'LIKE', '%' . $this->searchTerm . '%');
            });
        }

        return $query->orderBy('id', 'DESC');
    }

    public function updatedFile($file)
    {
        $this->validate([
            'file' => 'required|file|max:10240', // Adjust the maximum file size as needed
        ]);
    }
    public function upload()
    {
        $this->validate([
            'file' => 'required|file|max:10240', // Adjust the maximum file size as needed
        ]);

        $this->progress = 0;

        $path = $this->file->store('link'); // Adjust the storage path as needed

        // Get the absolute path of the uploaded file
        $absolutePath = Storage::path($path);

        // Perform your upload logic here
        // You can use the $path variable to save the file path in the database or perform any other operations

        // Simulating upload progress
        for ($i = 0; $i < 10; $i++) {
            sleep(1);
            $this->progress += 10;
            $this->emit('uploadProgress', $this->progress);
        }

        // Display the absolute path of the uploaded file
        $this->alert('success', 'File uploaded successfully! Path: ' . $absolutePath, ['toast' => false, 'position' => 'center']);
    }

    public function getListeners()
    {
        return [
            'uploadProgress' => 'updateProgress',
        ];
    }

    public function updateProgress($progress)
    {
        $this->progress = $progress;
    }
}
